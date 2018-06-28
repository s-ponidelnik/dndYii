
var places = {};



$(document).ready(function () {
    $(document).on("show.bs.modal",".modal.main",function() {
        alert(1);
    });
    var createMode = 0;
    var submapgo_active = 0;
    var cur_map_id = $('#map').data('id');
    var townIcon = new Image();  // Создание нового объекта изображения
    townIcon.src = 'http://uploads.dnd/cavern.png';

    townIcon.onload = function () {
        var cavernIcon = new Image();  // Создание нового объекта изображения
        cavernIcon.src = 'http://uploads.dnd/cavern.ico';
        cavernIcon.onload = function () {
            function drawPoint(ctx, posX, posY, color, rad) {
                ctx.beginPath();
                if (typeof(rad) == 'undefined')
                    rad = 0;
                ctx.arc(posX, posY, rad + 20, 0, 2 * Math.PI, false);
                ctx.fillStyle = '#' + color;
                ctx.fill();
                ctx.stroke();
            }


            $('.add-balloon').click(function () {
                createMode = 1;
            });

            $('.debug-ctrl').click(function () {
                $('#labels').toggle();
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

            var ic = document.getElementById('icons');
            var c = document.getElementById('labels');
            var ctx = c.getContext('2d');

            var icons = ic.getContext('2d');

            function rgbToHex(r, g, b) {
                if (r > 255 || g > 255 || b > 255)
                    throw 'Invalid color component';
                return ((r << 16) | (g << 8) | b).toString(16);
            }
            $(document).keydown(function(event) {
                if ( event.which == 16 ) {
                    g2p.activate();
                }else if ( event.which == 17 ) {
                    submapgo_active = 1;
                }
            });
            $(document).keyup(function(event) {
                if ( event.which == 16 ) {
                    g2p.deactivate();
                }else if ( event.which == 17 ) {
                    submapgo_active = 0;
                }
            });
            $('#map_container').mousemove(function (e) {
                var pos = findPos(this);

                var x = e.pageX - pos.x + $(this).scrollLeft();
                var y = e.pageY - pos.y + $(this).scrollTop();
                var coord = 'x=' + x + ', y=' + y;
                //console.clear();
                //console.log(coord);
            });
            $('#map_container').click(function (e) {
                var pos = findPos(this);

                var x = e.pageX - pos.x + $(this).scrollLeft();
                var y = e.pageY - pos.y + $(this).scrollTop();
                var coord = 'x=' + x + ', y=' + y;
                if (createMode == 0) {
                    var c = ctx;
                    var p = c.getImageData(x, y, 1, 1).data;
                    var hex = '' + ('000000' + rgbToHex(p[0], p[1], p[2])).slice(-6);
                    if (typeof places[hex] != 'undefined') {
                        if (submapgo_active==1 && typeof places[hex].subMapId != 'undefined'){
                            window.location = 'http://backend.dnd/index.php?r=map%2Fview&id=' + places[hex].subMapId;
                        }else {
                            $('#modal-title').text(places[hex].name);
                            $('#modal-body').html(places[hex].info);
                            if (typeof places[hex].subMapId != 'undefined') {
                                $('#modal-submap-item').show();
                                $('#modal-submap-link').text('http://backend.dnd/index.php?r=map%2Fview&id=' + places[hex].subMapId);
                                $('#modal-submap-link').attr('href', 'http://backend.dnd/index.php?r=map%2Fview&id=' + places[hex].subMapId);
                                console.log($('#modal-submap-link').text());
                            } else {
                                $('#modal-submap-item').hide();
                            }
                            $('#infoModal').modal();
                        }
                    }
                } else {
                    createMode = 0;
                    $('#mapmarkers-pos_x').val(x);
                    $('#mapmarkers-pos_y').val(y);
                    $('#mapmarkers-map_id').val(cur_map_id);
                    $('#addBalloonModal').modal();
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
            $.ajax({
                url: $('#get-ajax-balloons-url').val(),
                context: document.body,
                dateType:'json'
            }).done(function(data) {
                places = JSON.parse(data);
                for (var place in places) {
                    console.log(places[place].posX + ' ' + places[place].posY);
                    drawPoint(ctx, places[place].posX, places[place].posY, place, places[place].rad);
                    var size = 40;
                    if (places[place].type == 'town')
                        icons.drawImage(townIcon, places[place].posX - size / 2 + 5, places[place].posY - size + 5, size, size);
                    if (places[place].type == 'cavern')
                        icons.drawImage(cavernIcon, places[place].posX - size / 2 + 5, places[place].posY - size + 5, size, size);
                }
            });
        }
    }
});