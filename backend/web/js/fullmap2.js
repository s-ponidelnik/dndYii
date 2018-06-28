var onDelete = 0;
var dragStartX = null;
var dragStartY = null;
var createMode = 0;
var btnCreateMode = 0;
var scrollActive = 0;
var scrollMovePosX = null;
var ctrl = 0;
var ShiftActive = 0;
var scrollMovePosY = null;
var btnA_active = 0;
var hexGridStatus = 1;
var scrollPos = {top: $('#map_container').scrollTop(), left: $('#map_container').scrollLeft()};
var scrollHold = 0;
var onDrag = null;

function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

var toggleGrid = function (toGridStatus) {
    if (typeof toGridStatus != 'undefined') {
        console.log('to:' + toGridStatus);
        if (toGridStatus == 1)
            $('canvas#grid').show();
        else
            $('canvas#grid').hide();
        setCookie("map-" + $('#map').data("id") + "grid", toGridStatus);
        console.log(toGridStatus);
        return true;
    }

    var gridStatus = $('canvas#grid').is(":visible");
    if (gridStatus) {
        $('canvas#grid').hide();
        gridStatus = 0;
    } else {
        $('canvas#grid').show();
        gridStatus = 1;
    }
    setCookie("map-" + $('#map').data("id") + "grid", gridStatus);
    console.log(gridStatus);
    return true;
};
ScrollFreese = function () {
    scrollPos = {top: $('#map_container').scrollTop(), left: $('#map_container').scrollLeft()};
    scrollHold = 1;
    return true;
};
ScrollUnFreese = function () {
    scrollHold = 0;
    return true;
};
$('#map_container').scroll(function (event) {
    if (scrollHold == 0) {
        window.location.hash = 'x=' + $('#map_container').scrollLeft() + '&y=' + $('#map_container').scrollTop();
        return true;
    }
    $('#map_container').scrollLeft(scrollPos.left);
    $('#map_container').scrollTop(scrollPos.top);
    return false;

});
var gotoMapElem = function (selector) {
    if (typeof($(selector)) != 'object' || !$(selector).length)
        return false;
    var elem_left = $(selector).offset().left;
    var elem_top = $(selector).offset().top;
    var top_offset = -1 * ($('#map_container').height() / 2);
    var left_offset = -1 * ($('#map_container').width() / 2);
    $('#map_container').scrollTo(selector, 800, {offset: {left: left_offset, top: top_offset}});
    return true;
};
$('img').on('dragstart', function (event) {
    event.preventDefault();
});

$('.marker').on('dragstart', function (event) {
    event.preventDefault();
});


$(document).ready(function () {

    var socket = new WebSocket("ws://0.0.0.0:2346");

    socket.onopen = function() {
        console.log("Соединение установлено.");
        socket.send(JSON.stringify({method:'game/start',data:{hash:1231}}));
    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log('Соединение закрыто чисто');
        } else {
            console.log('Обрыв соединения'); // например, "убит" процесс сервера
        }
        console.log('Код: ' + event.code + ' причина: ' + event.reason);
    };

    socket.onmessage = function(event) {
        console.log("Получены данные " + event.data);
    };

    socket.onerror = function(error) {
        console.log("Ошибка " + error.message);
    };

    var gridStatus = getCookie("map-" + $('#map').data("id") + "grid");
    console.log('get:' + gridStatus);
    if (gridStatus != null)
        hexGridStatus = gridStatus;
    var spl = window.location.hash.split('#');
    if (typeof spl[1] != 'undefined') {
        var x = null;
        var y = null;
        var selector = null;
        window.location.hash.split('#')[1].split('&');

        window.location.hash.split('#')[1].split('&').forEach(function (item, i, arr) {
            if (item.split('=')[0] == 'x')
                x = item.split('=')[1];
            if (item.split('=')[0] == 'y')
                y = item.split('=')[1];
        });
        if (x == null && y == null) {
            gotoMapElem('#marker-' + spl[1]);
            window.location.hash = '';
        } else {
            $('#map_container').scrollTo({left: x + 'px', top: y + 'px'}, 800);
        }

    }
    $('#map_container').focus();


    var canvas = document.getElementById('grid');
    console.log('hex:' + hexGridStatus);
    if (hexGridStatus == 0) {
        $(canvas).hide();
    } else {
        $(canvas).show();
    }
    var hexHeight,
        hexRadius,
        hexRectangleHeight,
        hexRectangleWidth,
        hexagonAngle = 0.523598776, // 30 degrees in radians
        sideLength = 38,
        boardWidth = 10,
        boardHeight = 10;

    hexHeight = Math.sin(hexagonAngle) * sideLength;
    hexRadius = Math.cos(hexagonAngle) * sideLength;
    hexRectangleHeight = sideLength + 2 * hexHeight;
    hexRectangleWidth = 2 * hexRadius;
    boardWidth = $('#map').width() / hexRectangleWidth;
    boardHeight = $('#map').height() / hexHeight;

    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');

        ctx.fillStyle = "#000000";
        ctx.strokeStyle = "#CCCCCC";
        ctx.strokeStyle = "#ebebe0";
        ctx.lineWidth = 1;

        drawBoard(ctx, boardWidth, boardHeight);

        /*canvas.addEventListener("mousemove", function(eventInfo) {
            var x,
                y,
                hexX,
                hexY,
                screenX,
                screenY;

            x = eventInfo.offsetX || eventInfo.layerX;
            y = eventInfo.offsetY || eventInfo.layerY;


            hexY = Math.floor(y / (hexHeight + sideLength));
            hexX = Math.floor((x - (hexY % 2) * hexRadius) / hexRectangleWidth);

            screenX = hexX * hexRectangleWidth + ((hexY % 2) * hexRadius);
            screenY = hexY * (hexHeight + sideLength);

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            drawBoard(ctx, boardWidth, boardHeight);

            // Check if the mouse's coords are on the board
            if(hexX >= 0 && hexX < boardWidth) {
                if(hexY >= 0 && hexY < boardHeight) {
                    ctx.fillStyle = "#000000";
                    drawHexagon(ctx, screenX, screenY, true);
                }
            }
        });*/
    }

    function drawBoard(canvasContext, width, height) {
        var i,
            j;

        for (i = 0; i < width; ++i) {
            for (j = 0; j < height; ++j) {
                drawHexagon(
                    ctx,
                    i * hexRectangleWidth + ((j % 2) * hexRadius),
                    j * (sideLength + hexHeight),
                    false
                );
            }
        }
    }

    function drawHexagon(canvasContext, x, y, fill) {
        var fill = fill || false;

        canvasContext.beginPath();
        canvasContext.moveTo(x + hexRadius, y);
        canvasContext.lineTo(x + hexRectangleWidth, y + hexHeight);
        canvasContext.lineTo(x + hexRectangleWidth, y + hexHeight + sideLength);
        canvasContext.lineTo(x + hexRadius, y + hexRectangleHeight);
        canvasContext.lineTo(x, y + sideLength + hexHeight);
        canvasContext.lineTo(x, y + hexHeight);
        canvasContext.closePath();

        if (fill) {
            canvasContext.fill();
        } else {
            canvasContext.stroke();
        }
    }


    //Firefox
    $('#map_container').bind('DOMMouseScroll', function (e) {
        if (e.originalEvent.detail > 0) {
            //scroll down
            console.log('Down');
        } else {
            //scroll up
            console.log('Up');
        }

        //prevent page fom scrolling
        return false;
    });

    //IE, Opera, Safari
    $('#map_container').bind('mousewheel', function (e) {
        if (e.originalEvent.wheelDelta < 0) {
            //scroll down
            console.log('Down');
        } else {
            //scroll up
            console.log('Up');
        }

        //prevent page fom scrolling
        return false;
    });

    var grid = document.getElementById('grid');
    var context = grid.getContext('2d');

    $('.debug-ctrl').click(function () {
        $('#labels').toggle();
    });


    $('.grid-ctrl').click(function () {
        toggleGrid();
    });
    $('.grab-ctrl').click(function () {
        g2p.toggle();
    });

    var map = document.getElementById('map');
    var g2p = new GrabToPan({
        element: document.getElementById('map_container'),         // required
        onActiveChanged: function (isActive) { // optional
            if (isActive)
                $('#map_container').css('cursor', 'grab');
            else
                $('#map_container').css('cursor', 'default');
        }
    });

    function findPos(obj) {
        var curleft = 0, curtop = 0;
        if (obj.offsetParent) {
            do {
                curleft += obj.offsetLeft;
                curtop += obj.offsetTop;
            } while (obj = obj.offsetParent);
            return {x: curleft, y: curtop};
        }
        return undefined;
    }

    $('.add-balloon').click(function () {
        createMode = 1;
    });
    $('#map_container').click(function (e) {
        if (createMode == 1 || btnCreateMode == 1) {
            var pos = findPos(this);

            var x = e.pageX - pos.x + $(this).scrollLeft() - 20;
            var y = e.pageY - pos.y + $(this).scrollTop() - 40;
            var img = $('<img />', {
                id: '',
                src: 'http://uploads.dnd/cavern.png',
                alt: '',
                width: '40px',
                class: 'nodraggable'
            });
            var div = $('<div>', {
                    class: 'marker test-marker'
                }
            ).css({
                position: 'absolute',
                top: y,
                left: x,
                'z-index': 100

            });
            img.on('dragstart', function (event) {
                event.preventDefault();
            });

            img.appendTo(div);
            div.appendTo($('#map_container'));
            createMode = 0;
            $('#mapmarkers-pos_x').val(x);
            $('#mapmarkers-pos_y').val(y);
            $('#add-marker-modal').modal();
        }

    });
    $('#add-marker-modal').on('shown.bs.modal', function () {
        $('#mapmarkers-name').focus();
    });

    /*$('#map_container').click(function (e) {
        console.log(createMode);
        if (createMode == 1) {
            console.log(createMode);
        var pos = findPos(this);
        console.log(pos);
        var x = e.pageX - pos.x + $(this).scrollLeft();
        var y = e.pageY - pos.y + $(this).scrollTop();
        var coord = 'x=' + x + ', y=' + y;

            var img = $('<img />', {
                id: '',
                src: 'http://uploads.dnd/cavern.png',
                alt: '',
                width:'40px'
            });
            var div = $('<div>',{
                class:'marker test-marker'
            }
            ).css({
                position:'relative',
                top:y,
                left:x,
                'z-index':100
            });

            console.log('ok');
            img.appendTo(div);
            div.appendTo($('#map_container'));
            createMode = 0;
        }
    });*/

    $('#map_container').mousemove(function (e) {
        if (scrollActive == 1 && scrollMovePosX != null && scrollMovePosY != null) {
            var x = e.pageX;
            var y = e.pageY;
            var speed = 1;
            var max_speed = 10;
            if (x < scrollMovePosX) {
                speed = (scrollMovePosX - x) / 40;
                if (speed > max_speed) speed = max_speed;
                $('#map_container').scrollLeft($('#map_container').scrollLeft() - speed);
            } else {
                speed = (x - scrollMovePosX) / 40;
                if (speed > max_speed) speed = max_speed;
                $('#map_container').scrollLeft($('#map_container').scrollLeft() + speed);
            }
            if (y < scrollMovePosY) {
                speed = (scrollMovePosY - y) / 40;
                if (speed > max_speed) speed = max_speed;
                $('#map_container').scrollTop($('#map_container').scrollTop() - speed);

            } else {
                speed = (y - scrollMovePosY) / 40;
                if (speed > max_speed) speed = max_speed;
                $('#map_container').scrollTop($('#map_container').scrollTop() + speed);
                //scroll down
            }
        }
        if (onDrag != null) {
            var pos = findPos(this);
            var x = e.pageX - pos.x + $(this).scrollLeft() - 20;
            var y = e.pageY - pos.y + $(this).scrollTop() - 40;
            $(onDrag).css('left', x + 'px');
            $(onDrag).css('top', y + 'px');
        }

        //var coord = 'x=' + x + ', y=' + y;
        //console.clear();
        //console.log(coord);
    });

    deleteMarker = function (marker) {
        if (ctrl == 1) {
            var onDelete = 1;
            if (confirm("Удалить?")) {
                onDelete = 0;
                $.ajax({
                    url: $('#marker_delete_url').val(),
                    data: {id: $(marker).attr('data-id')}
                }).done(function () {
                    $($(marker).attr('data-target')).remove();
                    $(marker).remove();
                });
            } else {
                setTimeout(function () {
                    $(marker).attr('data-toggle', 'modal');
                }, 100);
                onDelete = 0;
                ctrl = 0;//bugfix
            }
        }
    };
    DropDrag = function () {
        if (onDrag != null) {
            var pMarkerId = $(onDrag);
            $.ajax({
                url: $('#marker_pos_update_url').val(),
                data: {
                    id: $(onDrag).attr('data-id'),
                    pos_x: $(onDrag).css('left').split('px')[0],
                    pos_y: $(onDrag).css('top').split('px')[0]
                }
            }).done(function () {
                $(pMarkerId).data('toggle', 'modal');
                $(pMarkerId).attr('data-toggle', 'modal');
            });


        }
        onDrag = null;
    };
    $('.marker').mousedown(function (event) {
        if (event.which == 1 && onDelete == 0) {
            if (ctrl == 1) {
                console.log('down');
                $(this).data('toggle', '');
                $(this).attr('data-toggle', '');
                onDrag = $(this);
                dragStartX = $(onDrag).css('left');
                dragStartY = $(onDrag).css('top');
                event.preventDefault();
            }
        }
    });

    $('.marker').mouseup(function (event) {
        if (event.which == 1 && onDelete == 0) {
            if (dragStartX == $(onDrag).css('left') && dragStartY == $(onDrag).css('top')) {
                deleteMarker($(onDrag));
            } else {
                DropDrag();
            }
            event.preventDefault();
        }
    });
    $(document).mousedown(function (e) {

        if (e.which == 2) {
            $('#map_container').css('cursor', 'move');
            scrollActive = 1;
            scrollMovePosX = e.pageX;
            scrollMovePosY = e.pageY;

        }
        return true;// to allow the browser to know that we handled it.
    });
    $(document).mouseup(function (e) {
        if (e.which == 1) {

            DropDrag();
            e.preventDefault();

        }
        if (e.which == 2) {
            $('#map_container').css('cursor', 'default');
            scrollActive = 0;
        }
        return true;// to allow the browser to know that we handled it.
    });
    $(document).keypress(function (event) {
        if (event.which == 116)//"t" for test
            console.log(gotoMapElem('#marker-55'));
        if (event.which == 72 && ShiftActive == 1)
            toggleGrid();
    });
    $(document).keydown(function (event) {
        if (event.which == 65) {
            btnA_active = 1;
            if (ShiftActive == 1) {
                btnCreateMode = 1;
                g2p.deactivate();
            }
        }

        if (event.which == 16) {
            ShiftActive = 1;
            if (btnA_active == 0)
                g2p.activate();
            else if (btnA_active == 1)
                btnCreateMode = 1;
        }
        if (event.which == 17) {
            ctrl = 1;
            console.log('ctrl:active');
        }
    });
    $(document).keyup(function (event) {
        if (event.which == 65) {
            btnA_active = 0;
            if (ShiftActive == 1) {
                btnCreateMode = 0;
                g2p.activate();
            }
        }
        if (event.which == 16) {
            ShiftActive = 0;
            btnCreateMode = 0;
            g2p.deactivate();
        }
        if (event.which == 17) {
            ctrl = 0;
            console.log('ctrl:disable');
        }
    });


});