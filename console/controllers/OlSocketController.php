<?php

namespace console\controllers;

use common\models\Character;
use common\models\User;
use Yii;
use yii\console\Controller;
use Workerman\Worker;

/**
 * Site controller
 */
class OlSocketController extends Controller
{
    public $connections = [];

    public function actionStart()
    {
        $addr = '192.168.0.110:2346';
        print 'Start' . "\n";
        $socket = stream_socket_server("tcp://" . $addr, $errno, $errstr);

        if (!$socket) {
            die("$errstr ($errno)\n");
        }

        $connects = array();
        while (true) {
            //формируем массив прослушиваемых сокетов:
            $read = $connects;
            $read [] = $socket;
            $write = $except = null;

            if (!stream_select($read, $write, $except, null)) {//ожидаем сокеты доступные для чтения (без таймаута)
                break;
            }

            if (in_array($socket, $read)) {//есть новое соединение
                //принимаем новое соединение и производим рукопожатие:
                if (($connect = stream_socket_accept($socket, -1)) && $info = $this->handshake($connect)) {
                    $connects[] = $connect;//добавляем его в список необходимых для обработки
                    $this->onOpen($connect, $info);//вызываем пользовательский сценарий
                }
                unset($read[array_search($socket, $read)]);
            }

            foreach ($read as $connect) {//обрабатываем все соединения
                $data = fread($connect, 100000);

                if (!$data) { //соединение было закрыто
                    fclose($connect);
                    unset($connects[array_search($connect, $connects)]);
                    $this->onClose($connect);//вызываем пользовательский сценарий
                    continue;
                }

                $this->onMessage($connect, $data);//вызываем пользовательский сценарий
            }
        }

        //fclose($server);


    }

    function handshake($connect)
    {
        $info = array();

        $line = fgets($connect);
        $header = explode(' ', $line);
        $info['method'] = $header[0];
        $info['uri'] = $header[1];

        //считываем заголовки из соединения
        while ($line = rtrim(fgets($connect))) {
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $info[$matches[1]] = $matches[2];
            } else {
                break;
            }
        }

        $address = explode(':', stream_socket_get_name($connect, true)); //получаем адрес клиента
        $info['ip'] = $address[0];
        $info['port'] = $address[1];

        if (empty($info['Sec-WebSocket-Key'])) {
            return false;
        }

        //отправляем заголовок согласно протоколу вебсокета
        $SecWebSocketAccept = base64_encode(pack('H*', sha1($info['Sec-WebSocket-Key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept:$SecWebSocketAccept\r\n\r\n";
        fwrite($connect, $upgrade);

        return $info;
    }

    function encode($payload, $type = 'text', $masked = false)
    {
        $frameHead = array();
        $payloadLength = strlen($payload);

        switch ($type) {
            case 'text':
                // first byte indicates FIN, Text-Frame (10000001):
                $frameHead[0] = 129;
                break;

            case 'close':
                // first byte indicates FIN, Close Frame(10001000):
                $frameHead[0] = 136;
                break;

            case 'ping':
                // first byte indicates FIN, Ping frame (10001001):
                $frameHead[0] = 137;
                break;

            case 'pong':
                // first byte indicates FIN, Pong frame (10001010):
                $frameHead[0] = 138;
                break;
        }

        // set mask and payload length (using 1, 3 or 9 bytes)
        if ($payloadLength > 65535) {
            $payloadLengthBin = str_split(sprintf('%064b', $payloadLength), 8);
            $frameHead[1] = ($masked === true) ? 255 : 127;
            for ($i = 0; $i < 8; $i++) {
                $frameHead[$i + 2] = bindec($payloadLengthBin[$i]);
            }
            // most significant bit MUST be 0
            if ($frameHead[2] > 127) {
                return array('type' => '', 'payload' => '', 'error' => 'frame too large (1004)');
            }
        } elseif ($payloadLength > 125) {
            $payloadLengthBin = str_split(sprintf('%016b', $payloadLength), 8);
            $frameHead[1] = ($masked === true) ? 254 : 126;
            $frameHead[2] = bindec($payloadLengthBin[0]);
            $frameHead[3] = bindec($payloadLengthBin[1]);
        } else {
            $frameHead[1] = ($masked === true) ? $payloadLength + 128 : $payloadLength;
        }

        // convert frame-head to string:
        foreach (array_keys($frameHead) as $i) {
            $frameHead[$i] = chr($frameHead[$i]);
        }
        if ($masked === true) {
            // generate a random mask:
            $mask = array();
            for ($i = 0; $i < 4; $i++) {
                $mask[$i] = chr(rand(0, 255));
            }

            $frameHead = array_merge($frameHead, $mask);
        }
        $frame = implode('', $frameHead);

        // append payload to frame:
        for ($i = 0; $i < $payloadLength; $i++) {
            $frame .= ($masked === true) ? $payload[$i] ^ $mask[$i % 4] : $payload[$i];
        }

        return $frame;
    }

    function decode($data)
    {
        $unmaskedPayload = '';
        $decodedData = array();

        // estimate frame type:
        $firstByteBinary = sprintf('%08b', ord($data[0]));
        $secondByteBinary = sprintf('%08b', ord($data[1]));
        $opcode = bindec(substr($firstByteBinary, 4, 4));
        $isMasked = ($secondByteBinary[0] == '1') ? true : false;
        $payloadLength = ord($data[1]) & 127;

        // unmasked frame is received:
        if (!$isMasked) {
            return array('type' => '', 'payload' => '', 'error' => 'protocol error (1002)');
        }

        switch ($opcode) {
            // text frame:
            case 1:
                $decodedData['type'] = 'text';
                break;

            case 2:
                $decodedData['type'] = 'binary';
                break;

            // connection close frame:
            case 8:
                $decodedData['type'] = 'close';
                break;

            // ping frame:
            case 9:
                $decodedData['type'] = 'ping';
                break;

            // pong frame:
            case 10:
                $decodedData['type'] = 'pong';
                break;

            default:
                return array('type' => '', 'payload' => '', 'error' => 'unknown opcode (1003)');
        }

        if ($payloadLength === 126) {
            $mask = substr($data, 4, 4);
            $payloadOffset = 8;
            $dataLength = bindec(sprintf('%08b', ord($data[2])) . sprintf('%08b', ord($data[3]))) + $payloadOffset;
        } elseif ($payloadLength === 127) {
            $mask = substr($data, 10, 4);
            $payloadOffset = 14;
            $tmp = '';
            for ($i = 0; $i < 8; $i++) {
                $tmp .= sprintf('%08b', ord($data[$i + 2]));
            }
            $dataLength = bindec($tmp) + $payloadOffset;
            unset($tmp);
        } else {
            $mask = substr($data, 2, 4);
            $payloadOffset = 6;
            $dataLength = $payloadLength + $payloadOffset;
        }

        /**
         * We have to check for large frames here. socket_recv cuts at 1024 bytes
         * so if websocket-frame is > 1024 bytes we have to wait until whole
         * data is transferd.
         */
        if (strlen($data) < $dataLength) {
            return false;
        }

        if ($isMasked) {
            for ($i = $payloadOffset; $i < $dataLength; $i++) {
                $j = $i - $payloadOffset;
                if (isset($data[$i])) {
                    $unmaskedPayload .= $data[$i] ^ $mask[$j % 4];
                }
            }
            $decodedData['payload'] = $unmaskedPayload;
        } else {
            $payloadOffset = $payloadOffset - 4;
            $decodedData['payload'] = substr($data, $payloadOffset);
        }

        return $decodedData;
    }

//пользовательские сценарии:
    function getUniqId()
    {
        $id = rand(0, count($this->connections)) + rand(0, 100);
        if (!isset($this->connections[$id]))
            return $id;
        else
            return $this->getUniqId($id);
    }

    function send($connect, $data)
    {
        $msg = json_encode($data);
        fwrite($connect, $this->encode($msg));
    }

    function onOpen($connect, $info)
    {
        echo "open\n";
        $id = $this->getUniqId();
        $this->connections[$id] = ['conn' => $connect, 'user_id' => null];
        $this->send($connect, ['test' => $id]);
        var_dump($connect);
    }

    function onClose($connect)
    {
        echo "close\n";
    }

    function onMessage($connect, $data)
    {
        foreach ($this->connections as $id => $connData) {
            print $id . "\n";
        }
        $data = json_decode($this->decode($data)['payload']);
        if (isset($data->method)) {
            if ($data->method == 'auth') {
                $user = $this->auth($data->token);

            }
        }

    }

    private function auth($token)
    {
        return User::findIdentityByAccessToken($token);
    }
    /*
    public $connections_count=0;
    public $test=[];

    public function setConnection($connection, $data)
    {
        if (empty(Yii::$app->socket->connections))
            Yii::$app->socket->connections = [];
        Yii::$app->socket->connections[$connection->id] = $data;
    }

    public function getConnections()
    {
        if (empty(Yii::$app->socket->connections))
            Yii::$app->socket->connections = [];
        return Yii::$app->socket->connections;
    }



    private function getJsonRequert($request)
    {
        return json_decode($request, false);
    }

    public function uniqConnectionId($id)
    {
        $inArray = false;
        foreach (Yii::$app->socket->connections as $c) {
            if ($id == $c['con']->id)
                $inArray = true;
        }
        if ($inArray)
            return $this->uniqConnectionId(rand(0, count(Yii::$app->socket->connections) + 100));
        else
            return $id;
    }

    public function actionStart()
    {
        global $test;
        $test = 0;
        global $argv;
        array_shift($argv);

        $ws_worker = new Worker("websocket://192.168.0.110:2346");

// 4 processes
        $ws_worker->count = 16;

// Emitted when new connection come

        $ws_worker->onConnect = function ($connection) {
            global $test;
            $test++;
            $connection->id = $this->uniqConnectionId(rand(0, 1000));
            $this->setConnection($connection, ['user_id' => null, 'con' => $connection]);
            $connection->send(json_encode(['id' => $connection->id]));
            print "\n";
            print "\n";
            var_dump($this->connections_count);
            $this->connections_count=$this->connections_count+1;
            print 'connections:';
            print $test;
            print "\n";
            print "\n";
        };
        $ws_worker->onClose = function ($connection){
            print 'close!!';
        };
// Emitted when data received

        $ws_worker->onMessage = function ($connection, $request) {
            $req = json_decode($request, false);
            if (isset($req->method)) {
                if ($req->method == 'auth') {
                    //print 'auth in connection#' . $connection->id . "\n";
                    $user = $this->auth($req->token);
                    $this->setConnection($connection, ['user_id' => $user->id, 'con' => $connection]);
                    //print 'new connection: '.$user->id.' :: '.$connection->id;
                    foreach (Yii::$app->socket->connections as $c) {
                        print $c['con']->id . "\n";
                    }
                } elseif ($req->method == 'change_hp') {
                    $character = Character::find()->where(['id' => $req->character_id])->one();
                    foreach (Yii::$app->socket->connections as $c) {
                        print $c['con']->id . "\n";
                        $c['con']->send(
                            json_encode(
                                [
                                    'method' => '_change_hp',
                                    'hp' => $req->new_hp,
                                    'hpStatusText' => $character->getHpStatusText(),
                                    'character_id' => $req->character_id,
                                    'percHp' => $character->percHp
                                ]
                            )
                        );
                    }

                }
            }
            //$c = explode('/', $request->method);
            //$controller = $c[0];
            //$method = $c[1];
            //$data = $request->data;
            // Send hello $data


        };

// Emitted when connection closed
        $ws_worker->onClose = function ($connection) {
            //echo "Connection closed\n";
        };

// Run worker
        Worker::runAll();
    }*/
}
