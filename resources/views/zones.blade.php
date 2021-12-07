@extends('layout')

@section('content')

<div id="app">
    <h1>Liste des zones</h1>
    <h2>Visualisation des stocks</h2>
    <h3>Des différents entrepôts</h3>

    <div class="canvasContainer">
        <div class="styleCanvas">
            <canvas id="canvas1" width="12000" height="8000"></canvas>
        </div>
    </div>

    <script>

    var zones = "{{ $zones }}";
    zones = JSON.parse(zones.replace(/&quot;/g, '"'));

    //console.log(zones);

    var canvas = document.getElementById("canvas1");
    const ctx = canvas.getContext("2d");

    //loadImage();
    draw(zones);

    function loadImage() {
        image = new Image();
        image.src = '../../storage/image/warehouse_plan.jpg';
        image.onload = function() {
            ctx.drawImage(image, 0, 0, image.width, image.height,
                0, 0, canvas.width, canvas.height);
            draw();
        }
    }

    function displayBuilding(width, height) {
        var x = 30;
        var y = 300;

        drawStock(x, y, width * 28, 29 * height, "red", "3");
        ctx.font = "50px Courier New";
        ctx.fillText("Building FLO",x - 10, y - 20);
    }

    function displayDataMass(zones, i ,posX, posY, width, height) {

        ctx.font = "30px Courier New";
        var wood = width / 3 * 1 - 5;
        var plastic = width / 3 * 2 - 5;

        ctx.fillText(zones[i].massWood + "🪵", posX + 10, posY + wood);
        ctx.fillText(zones[i].massPlastic + "🚮", posX + 10, posY + plastic);
        ctx.fillText("kg", posX + 40, posY + width - 15);
    }

    function displayZone(zones) {

        let sumMass;
        ctx.font = "20px monospace";
        var i;

        for (i = 0; zones[i]; i++) {
            var canvasPosX = (zones[i].posX - 70) * 40;
            var canvasPosY = (zones[i].posY)* 60;
            var canvasWidth = 6 * zones[i].width;
            var canvasHeight = 6 * zones[i].height;
            var checkFirstChar = zones[i].alley.charAt(0);
            var checkSecondChar = zones[i].alley.charAt(1);

            if ((checkFirstChar == 'F' && checkSecondChar == 'B') || (checkFirstChar == 'F' && checkSecondChar == 'C')
            || zones[i].alley == "FD1") {

                drawStock(canvasPosX, canvasPosY, canvasWidth, canvasHeight, "black", "2");
                if (zones[i].alley == "FB1")
                    ctx.fillText(zones[i].column, canvasPosX + 20, canvasPosY - 20);
                if (zones[i].column == "001") {
                    ctx.fillText(zones[i].alley, (zones[i].posX - 73) * 40, (zones[i].posY + 1.3) * 60);
                }
                displayDataMass(zones, i, canvasPosX, canvasPosY, canvasWidth, canvasHeight);
                //console.log("id", zones[i].id, "posX:", zones[i].posX, "posY:",zones[i].posY, "width:", zones[i].width,"height:", zones[i].height, "alley", zones[i].alley, "column", zones[i].column);
            }
            else {
                //console.log("🆕id", zones[i].id, "posX:", zones[i].posX, "posY:",zones[i].posY, "width:", zones[i].width,"height:", zones[i].height, "alley", zones[i].alley, "column", zones[i].column);
                drawStock(canvasPosX, canvasPosY, canvasWidth * 2, canvasHeight, "red", "2");
                console.log(zones[i]);
                ctx.fillText(zones[i].id, canvasPosX, canvasPosY);

            }
        }
    }

    function draw(zones) {
        
        var width = 6 * zones[0].width;
        var height = 6 * zones[0].height;

        displayBuilding(width, height);
        displayZone(zones);
       
        /*zones.forEach(function(zone) {
            console.log("id", zone.id, "posX:", zone.posX, "posY:",zone.posY, "width:", zone.width,"height:", zone.height);
            drawStock(zone.posX, zone.posY, 100, 100, "blue", "1");
        });*/
        /*buildings.forEach(function(building) {
            drawStock(building.posX, building.posY, building.width, building.height, building.color, "4");
            building.zones.forEach(function(zone) {
                drawStock(zone.posX, zone.posY, zone.width, zone.height, zone.color, "4");
                zone.storages.forEach(function(storage) {
                    sumMass = storage.masseBois + storage.massePlastique + storage.massePD;
                    ctx.fillText(sumMass.toString() + "kg", zone.posX + 20, zone.posY + 20, 500);
                })
            })
        });*/
    }

    function drawStock(x, y, width, height, color, lineWidth) {
        ctx.lineWidth = lineWidth;
        ctx.strokeStyle = color;
        ctx.strokeRect(x, y, width, height, color, lineWidth);
        ctx.stroke();
    }
    </script>

</div>

@endsection