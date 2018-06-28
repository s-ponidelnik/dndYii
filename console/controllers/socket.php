<?php
require_once __DIR__ . './../../vendor/autoload.php';

use Workerman\Worker;

$connections = [];
// Create a Websocket server
$ws_worker = new Worker("websocket://192.168.0.110:2346");
// 4 processes
$ws_worker->count = 4;

// Emitted when new connection come
$ws_worker->onConnect = function ($connection) {
    global $connections;
    $connection->id = rand(0, 100);
    $connections[$connection->id] = $connection;
    foreach ($connections as $c) {
        print $c->id . "\n";
    }
    print '---------'."\n";
};

// Emitted when data received
$ws_worker->onMessage = function ($connection, $request) {
    /*$request = json_decode($request, false);
    $c = explode('/', $request->method);
    $controller = $c[0];
    $method = $c[1];
    $data = $request->data;
    // Send hello $data
    $connection->send('hello ' . 'ok');*/
};

// Emitted when connection closed
$ws_worker->onClose = function ($connection) {
    echo "Connection closed#".$connection->id."\n";
};

// Run worker
Worker::runAll();