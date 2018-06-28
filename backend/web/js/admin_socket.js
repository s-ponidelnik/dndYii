
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}
var socket = new WebSocket("ws://192.168.0.110:2346");
socket.onopen = function () {
    console.log("Соединение установлено.");
    socket.send(JSON.stringify({method:'auth',token:auth_token}));
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
    console.log("Получены данные " + event.data);
};
socket.onerror = function (error) {
    console.log("Ошибка " + error.message);
};