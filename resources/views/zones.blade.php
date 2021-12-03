@extends('layout')

@section('content')

<div id="app">
    <h1>Liste des zones</h1>
    <h2>Visualisation des stocks</h2>

    <div class="canvasContainer">
        <div class="styleCanvas">
            <canvas id="canvas1" width="4000" height="2000"></canvas>
        </div>
    </div>

    <script>

    var zones = "{{ $zones }}";
    zones = JSON.parse(zones.replace(/&quot;/g, '"'));

    //console.log(zones);

    var canvas = document.getElementById("canvas1");
    const ctx = canvas.getContext("2d");
    var mainBatX = 90;
    var mainBatY = 50;

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

    function draw(zones) {
        let sumMass;
        ctx.font = "25px monospace";
        zones.forEach(function(zone) {
            drawStock(zone.posX, zone.posY, zone.width, zone.height, zone.color, "1");
        });
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