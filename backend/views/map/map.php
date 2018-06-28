
<html>
<meta charset='utf-8'>
<head>
        <title>imgExample</title>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</head>
<body>
<div id="infoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Modal Header</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id='modal-body'>
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id='map_container' class='noselect' style='position: relative;display:block;overflow:scroll;width:100%;height:100%;'>
    <div id='ctrl-buttons' style='z-index:50;position:fixed;margin-top:20%;padding:10px;'>
        <div style='background-image: url(back.png);text-align:center;padding:10px;border-radius:25px;margin:5px;padding-top:15px;padding-bottom:20px;'>
            <i class="ctr-btn search-ctrl glyphicon glyphicon glyphicon glyphicon-search"></i></br></br></br>
            <i class="ctr-btn glyphicon glyphicon glyphicon-plus"></i></br></br></br>
            <i class="ctr-btn glyphicon glyphicon-exclamation-sign"></i></br></br></br>
            <i class="ctr-btn debug-ctrl glyphicon glyphicon glyphicon-cog"></i></br></br></br>
            <i class="ctr-btn grab-ctrl glyphicon glyphicon glyphicon-cog"></i>
        </div>
    </div>
    <img id='map' class='noselect' src='map.jpg' width='4763px' height='3185px' style='position:absolute;top:0px;z-index:1;'>
    <canvas id='labels' width='4763px' height='3185px' style='position:absolute;top:0px;z-index:2;display:none;'></canvas>
    <canvas id='icons' width='4763px' height='3185px' style='position:absolute;top:0px;z-index:3;'></canvas>
</div>

<script>
    var places = {
        100011:{
            id:100011,
            posX:413,
            posY:313,
            type:'city',
            name:'Лускан',
            info:'test info'
        },
        111555:{
            id:111555,
            posX:632,
            posY:165,
            type:'city',
            name:'Мирабар',
            info:'test2 info'
        },
        666333:{
            id:666333,
            posX:497,
            posY:450,
            type:'city',
            name:'Невервинтер',
            info:"Невервинтер насчитывает, по последним подсчётам, 23192 жителей.<br><br>Город был назван так (название «Невервинтер» образовано от англ. слов «never» — «никогда» и «winter» — «зима») из-за никогда не замерзающей реки Невервинтер, на которой стоит город, хотя расположен он на холодном севере. Происходит это по вине огненных элементалей, живущих под горой Хоутенау в Невервинтерском лесу. Жар, исходящий от реки, поддерживает постоянную тёплую температуру в окрестностях. Без элементалей река замёрзнет, и, соответственно, источник воды города иссякнет."
        },
        666111:{
            id:666111,
            posX:525,
            posY:347,
            rad:10,
            type:'cavern',
            name:'Пещера',
            info:'test3 info'
        },
    };
    $(document).ready(function(){

        var townIcon = new Image();  // Создание нового объекта изображения
        townIcon.src = 'town.png';

        townIcon.onload = function() {
            var cavernIcon = new Image();  // Создание нового объекта изображения
            cavernIcon.src = 'cavern.png';
            cavernIcon.onload = function() {
                function drawPoint(ctx,posX,posY,color,rad){
                    ctx.beginPath();
                    if (typeof(rad)=='undefined')
                        rad = 0;
                    ctx.arc(posX, posY, rad+20, 0, 2 * Math.PI,false);
                    ctx.fillStyle = '#'+color;
                    ctx.fill();
                    ctx.stroke();
                }


                $('.debug-ctrl').click(function(){
                    $('#labels').toggle();
                });
                $('.grab-ctrl').click(function(){
                    g2p.toggle();
                });

                var map = document.getElementById("map");
                var g2p = new GrabToPan({
                    element: document.getElementById('map_container'),         // required
                    onActiveChanged: function(isActive) { // optional
                        console.log('Grab-to-pan is ' + (isActive ? 'activated' : 'deactivated'));
                    }
                });
                g2p.activate();
                var c = document.getElementById("labels");
                var ic = document.getElementById("icons");

                var ctx = c.getContext("2d");

                var icons = ic.getContext("2d");

                function rgbToHex(r, g, b) {
                    if (r > 255 || g > 255 || b > 255)
                        throw "Invalid color component";
                    return ((r << 16) | (g << 8) | b).toString(16);
                }
                $('#map_container').click(function(e) {
                    var pos = findPos(this);
                    var x = e.pageX - pos.x;
                    var y = e.pageY - pos.y;
                    var coord = "x=" + x + ", y=" + y;
                    var c = ctx;
                    var p = c.getImageData(x, y, 1, 1).data;
                    var hex = "" + ("000000" + rgbToHex(p[0], p[1], p[2])).slice(-6);
                    console.log(hex);
                    if (typeof places[hex]!='undefined'){
                        $('#modal-title').text(places[hex].name);
                        $('#modal-body').html(places[hex].info);
                        $("#infoModal").modal();
                    }
                });
                function findPos(obj) {
                    var curleft = 0, curtop = 0;
                    if (obj.offsetParent) {
                        do {
                            curleft += obj.offsetLeft;
                            curtop += obj.offsetTop;
                        } while (obj = obj.offsetParent);
                        return { x: curleft, y: curtop };
                    }
                    return undefined;
                }
                for (var place in places) {
                    drawPoint(ctx,places[place].posX,places[place].posY,places[place].id,places[place].rad);
                    var size=30;
                    if (places[place].type=='city')
                        icons.drawImage(townIcon, places[place].posX-size/2+5, places[place].posY-size+5,size,size);
                    if (places[place].type=='cavern')
                        icons.drawImage(cavernIcon, places[place].posX-size/2+5, places[place].posY-size+5,size,size);


                }
                var c = ctx.getImageData(413, 313, 1, 1).data;

                document.body.addEventListener('click',function(e)
                {

                    //console.log("cursor-location: " + e.clientX + ',' + e.clientY);
                });

                /*pic       = new Image();              // "Создаём" изображение
              pic.src    = 'export.jpg';  // Источник изображения, позаимствовано на хабре
              pic.onload = function() {    // Событие onLoad, ждём момента пока загрузится изображение
                ctx.drawImage(pic, 0, 0);  // Рисуем изображение от точки с координатами 0, 0
              }*/
            }
        }
    });
</script>

</body>
</html>