<@extends('layout')

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

    var buildings = "{{ $buildingtest }}";
    buildings = JSON.parse(buildings.replace(/&quot;/g, '"'));

    var zones = "{{ $zonetest }}";
    zones = JSON.parse(zones.replace(/&quot;/g, '"'));
    //console.log(buildings.zones[0].posX);

    var canvas = document.getElementById("canvas1");
    const ctx = canvas.getContext("2d");

    
    //loadImage(zones, buildings);
    draw(buildings, zones);

    
    function loadImage(zones,buildings) {
        image = new Image();
        image.src = '../../storage/image/warehouse_plan.jpg';
        image.onload = function() {
            ctx.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);
            draw(buildings);
        }
    }

    function displayBuilding(buildings) {

        //display main buildings
        for (var i = 0; buildings[i]; i++) {
            drawStock(buildings[i].posX, buildings[i].posY, buildings[i].width, buildings[i].height, "orange", "5");
            ctx.font = "60px Courier New";
            ctx.fillText(buildings[i].name, buildings[i].posX + 30, buildings[i].posY - 30);
            console.log(buildings[i].name, buildings[i].posX + 30, buildings[i].posY - 30);
        }
    }

    function displayDataMass(zones, i ,posX, posY, width, height) {

        ctx.font = "30px Courier New";
        var wood = width / 3 * 1 - 5;
        var plastic = width / 3 * 2 - 5;

        ctx.fillText(zones[i].massWood + "🪵", posX + 10, posY + wood);
        ctx.fillText(zones[i].massPlastic + "🚮", posX + 10, posY + plastic);
        ctx.fillText("kg", posX + 40, posY + width - 15);
    }

    function displayZone(zones, buildings) {

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
            var alleyChar = checkFirstChar + checkSecondChar;

            if ((checkFirstChar == 'F' && checkSecondChar == 'B') || (checkFirstChar == 'F' && checkSecondChar == 'C')
            || zones[i].alley == "FD1") {

                drawStock(canvasPosX, canvasPosY, canvasWidth, canvasHeight, "black", "3");
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

                // affichage zones batiment stockage plastique carton
                if (zones[i].alley == "FF4") {

                    drawStock(canvasPosX + 1000, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                    //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                    ctx.fillText(zones[i].column, canvasPosX + 1000, canvasPosY - 20);
                }
                if (zones[i].alley == "FF5") {

                    drawStock(canvasPosX + 1200, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                    //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                    ctx.fillText(zones[i].column, canvasPosX + 1200, canvasPosY - 20);
                }
                if (zones[i].alley == "FF6") {

                    drawStock(canvasPosX + 1325, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                    //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                    ctx.fillText(zones[i].column, canvasPosX + 1325, canvasPosY - 20);
                }
                if (zones[i].alley == "FF7") {

                    drawStock(canvasPosX + 1550, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                    //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                    ctx.fillText(zones[i].column, canvasPosX + 1550, canvasPosY - 20);
                }
                if (zones[i].alley == "FF8") {

                    drawStock(canvasPosX + 1675, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                    //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                    ctx.fillText(zones[i].column, canvasPosX + 1675, canvasPosY - 20);
                }
                if (zones[i].alley == "FF9") {

                    drawStock(canvasPosX + 1900, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                    //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                    ctx.fillText(zones[i].column, canvasPosX + 1900, canvasPosY - 20);
                }

                

                // affichage zones batiment stock produits dangereux

                var switchAlley = zones[i].alley;
                var FE = 78;
                var FD = 70;

                switch (switchAlley) {
                    case "FE2":
                        zones[i].posY = FE;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FE3":
                        zones[i].posY = FE + 1;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FE4":
                        zones[i].posY = FE + 3;
                        canvasPosY = (zones[i].posY) * 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FE5":
                        zones[i].posY = FE + 4;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FE6":
                        zones[i].posY = FE + 6;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    
                    case "FD2":
                        zones[i].posY = FD + 0;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FD3":
                        zones[i].posY = FD + 1;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FD4":
                        zones[i].posY = FD + 3;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FD5":
                        zones[i].posY = FD + 4;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    case "FD6":
                        zones[i].posY = FD + 6;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1000, canvasPosY + 30);
                        break;
                    default: 
                        console.log("Ne rien faire");
                }
            }
        }
    }

    function draw(buildings, zones) {

        displayBuilding(buildings);
        displayZone(zones, buildings);
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