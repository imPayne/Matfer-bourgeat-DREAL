<@extends('layout')

@section('content')

<div id="app">
    <h1>Liste des zones</h1>
    <h2>Visualisation des stocks</h2>
    <h3>Des différents entrepôts</h3>

    <div class="canvasContainer">
        <div class="styleCanvas">
            <canvas id="canvas1" width="6000" height="12000"></canvas>
        </div>
    </div>

    <script>
    // to retrieve the buildings variable from php view
    var buildings = "{{ $buildings }}";
    buildings = JSON.parse(buildings.replace(/&quot;/g, '"')); // parse JSON buildings php var into understandable for js
    // to retrieve the zones variable from php view
    var zones = "{{ $zones }}";
    zones = JSON.parse(zones.replace(/&quot;/g, '"')); // parse JSON buildings php var into understandable for js
    //to retrieve the storages variable from php view
    var storages = "{{ $storages }}";
    storages = JSON.parse(storages.replace(/&quot;/g, '"')); // parse JSON buildings php var into understandable for js

    var canvas = document.getElementById("canvas1"); //require the canvas HTML tag
    const ctx = canvas.getContext("2d");


    function loadImage(zones,buildings) {
        image = new Image();
        image.src = '../../public/warehouse_plan.jpg';
        image.onload = function() {
            ctx.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);
            draw(buildings);
        }
    }

    function displayBuilding(buildings) {

        //display main buildings
        for (var i = 0; buildings[i]; i++) {
            drawStock(buildings[i].posX, buildings[i].posY, buildings[i].width, buildings[i].height, "black", "7");
            ctx.font = "60px Courier New";
            ctx.fillText(buildings[i].name, buildings[i].posX + 30, buildings[i].posY - 30);
        }
        drawLegend(buildings);
    }

    function drawLegend(buildings) {
        //draw building legend's
        var posX;
        var posY;
        var width;
        var height;
        posX = buildings[0].posX;
        posY = buildings[0].posY;
        width = buildings[0].width;
        height = buildings[0].height;
        drawStock(posX + width + 50, posY, width * 0.52, height * 1 / 4, "black", "7");
        ctx.font = "50px Courier New";
        ctx.fillText("Légende " + buildings[0].name, posX + width + 70, posY - 30);
        ctx.font = "30px Courier New";
        ctx.fillText("Le batiment flo contient une donnée pour le bois 🪵", posX + width + 70, posY + 80);
        ctx.fillText("", posX + width + 70, posY + (2 * 80));
    }

    function displayDataMass(zones, i ,posX, posY, width, height, storages) {

        ctx.font = "30px Courier New";
        var wood = width / 3 * 1.7 - 5; //To place the text in the center of the zone
        var massPallet = 20; //pallet is equal to 20kg
        var dataValue = zones[i].numberStorages * massPallet;

        ctx.fillText(dataValue + "🪵", posX + 10, posY + wood);
        ctx.fillText("kg", posX + 40, posY + width - 15);

    }

    function displayMassCardbroad(zones, i, posX, posY, width, height) {
        ctx.font = "30px Courier New";
        var cardbroad = width / 2;
        var randomValue = Math.floor(Math.random() * (500 - 120)) + 120;

        ctx.fillText(randomValue + "📦", posX + 10, posY + cardbroad);
        ctx.fillText("kg", posX + 40, posY + width - 15);
    }

    function displayMassDangerousProducts(zones, i, posX, posY, width, height) {
        ctx.font = "30px Courier New";
        var dangerousProducts = width / 2;

    }

    function displayZone(zones, buildings, storages) {

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

                //drawByColorCode(posX, posY, width, height, "4", randomValue, 500, randomValue2, 500);
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

                // affichage zones batiment stock produits dangereux
                var switchAlley = zones[i].alley;
                var FE = 78;
                var FD = 70;

                switch (switchAlley) {
                    case "FE2":
                        zones[i].posY = FE;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FE3":
                        zones[i].posY = FE + 1;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FE4":
                        zones[i].posY = FE + 3;
                        canvasPosY = (zones[i].posY) * 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FE5":
                        zones[i].posY = FE + 4;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FE6":
                        zones[i].posY = FE + 6;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;

                    case "FD2":
                        zones[i].posY = FD + 0;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FD3":
                        zones[i].posY = FD + 1;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FD4":
                        zones[i].posY = FD + 3;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FD5":
                        zones[i].posY = FD + 4;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;
                    case "FD6":
                        zones[i].posY = FD + 6;
                        canvasPosY = (zones[i].posY)* 60;
                        drawStock(canvasPosX - 1000, canvasPosY, canvasWidth * 3, canvasHeight / 2, "orange", "4");
                        ctx.fillText(zones[i].alley , canvasPosX - 1070, canvasPosY + 30);
                        break;

                // affichage zones batiment stockage plastique carton
                    case "FF9":
                        displayMassCardbroad(zones, i, canvasPosX + 1900, canvasPosY, canvasWidth, canvasHeight);
                        drawStock(canvasPosX + 1900, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].column, canvasPosX + 1900, canvasPosY - 20);
                        break;
                    case "FF8":
                        displayMassCardbroad(zones, i, canvasPosX + 1675, canvasPosY, canvasWidth, canvasHeight);
                        drawStock(canvasPosX + 1675, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].column, canvasPosX + 1675, canvasPosY - 20);
                        break;
                    case "FF7":
                        displayMassCardbroad(zones, i, canvasPosX + 1550, canvasPosY, canvasWidth, canvasHeight);
                        drawStock(canvasPosX + 1550, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].column, canvasPosX + 1550, canvasPosY - 20);
                        break;
                    case "FF6":
                        displayMassCardbroad(zones, i, canvasPosX + 1325, canvasPosY, canvasWidth, canvasHeight);
                        drawStock(canvasPosX + 1325, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].column, canvasPosX + 1325, canvasPosY - 20);
                        break;
                    case "FF5":
                        displayMassCardbroad(zones, i, canvasPosX + 1200, canvasPosY, canvasWidth, canvasHeight);
                        drawStock(canvasPosX + 1200, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].column, canvasPosX + 1200, canvasPosY - 20);
                        break;
                    case "FF4":
                        displayMassCardbroad(zones, i, canvasPosX + 1000, canvasPosY, canvasWidth, canvasHeight);
                        drawStock(canvasPosX + 1000, canvasPosY, canvasWidth, canvasHeight, "purple", "6");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].column, canvasPosX + 1000, canvasPosY - 20);
                        break;
                    case "FD7":
                        zones[i].posY = FE;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, canvasPosX - 1800, canvasPosY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FD8":
                        zones[i].posY = FE + 1;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FD9":
                        zones[i].posY = FE + 3;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FE1":
                        zones[i].posY = FE + 4;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FE7":
                        zones[i].posY = FE + 7;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FE8":
                        zones[i].posY = FE + 9;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FE9":
                        zones[i].posY = FE + 10;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FF1":
                        zones[i].posY = FE + 13;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FF2":
                        zones[i].posY = FE + 14;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    case "FF3":
                        zones[i].posY = FE + 17;
                        canvasPosY = (zones[i].posY) * 54;
                        drawStock(canvasPosX - 1800, canvasPosY, canvasWidth * 3, canvasHeight / 2, "red", "4");
                        //console.log("id =>", zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        ctx.fillText(zones[i].alley, canvasPosX - 1880, canvasPosY + 35);
                        break;
                    default:
                        console.log("ok");
                        //console.log(zones[i].id, zones[i].alley, zones[i].column, zones[i].posX, zones[i].posY);
                        //drawStock(canvasPosX - 350, canvasPosY, canvasWidth, canvasHeight, "pink", "7");
                        //ctx.fillText(zones[i].column + zones[i].alley, canvasPosX - 350, canvasPosY);
                }
            }
        }
    }


    function draw(buildings, zones, storages) {

        displayBuilding(buildings);
        displayZone(zones, buildings, storages);
    }


    //code couleur par rapport à la masse présente sur une zone
    function drawByColorCode(x, y, width, height, size, massPlastic, massMaxPlastic, massWood, massMaxWood) {
        ctx.linewidth = size;
        if (massPlastic + massWood >= 300) {
            ctx.strokeStyle = "yellow";
            ctx.fillStyle = 'rgba(255, 255, 255, ' + ((massPlastic + massWood) / massMaxPlastic) * 5 + ')';
            ctx.fillRect(x, y, width, height);
        }
        if (massPlastic + massWood >= 500) {
            ctx.strokeStyle = "orange";
            ctx.fillStyle = 'rgba(255, 255, 255, ' + ((massPlastic + massWood) / massMaxPlastic) * 5 + ')';
            ctx.fillRect(x, y, width, height);
        }
        if (massPlastic + massWood >= 800) {
            ctx.strokeStyle = "red";
            ctx.fillStyle = 'rgba(255, 255, 255, ' + ((massPlastic + massWood) / massMaxPlastic) * 5 + ')';
            ctx.fillRect(x, y, width, height);
        }
    }

    function drawStock(x, y, width, height, color, lineWidth) {
        ctx.lineWidth = lineWidth;
        ctx.strokeStyle = color;
        ctx.strokeRect(x, y, width, height, color, lineWidth);
        ctx.stroke();
        return true;
    }


    loadImage(zones, buildings);
    draw(buildings, zones, storages);


    </script>

</div>

@endsection
