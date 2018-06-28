var socket = new WebSocket("ws://192.168.0.110:2346");
socket.onopen = function () {
    console.log("Соединение установлено.");
    socket.send(JSON.stringify({method: 'auth', token: auth_token}));
};

socket.onclose = function (event) {
    if (event.wasClean) {
        console.log('Соединение закрыто чисто');
    } else {
        console.log('Обрыв соединения'); // например, "убит" процесс сервера
    }
    console.log('Код: ' + event.code + ' причина: ' + event.reason);
};

socket.onmessage = function (event) {
    console.log("Получены данные: ");
    console.log(event.data);
    console.log(typeof(event.data));
    var data = JSON.parse(event.data);
    if (typeof data.method != 'undefined')
        window[data.method](data);
};
socket.onerror = function (error) {
    console.log("Ошибка " + error.message);
};