require('./bootstrap');

var canvas = document.getElementById("canvas1");
const ctx = canvas.getContext("2d");
var mainBatX = 90;
var mainBatY = 50;

loadImage();

function loadImage(zones) {
    image = new Image();
    image.src = './warehouse_plan.jpg';
    image.onload = function() {
        ctx.drawImage(image, 0, 0, image.width, image.height,
            0, 0, canvas.width, canvas.height);
        draw(zones);
    }
}

function draw() {
    let sumMass;
    ctx.font = "25px monospace";
    console.log(buildings);

    
    buildings.forEach(function(building) {
        drawStock(building.posX, building.posY, building.width, building.height, building.color, "4");
        building.zones.forEach(function(zone) {
            drawStock(zone.posX, zone.posY, zone.width, zone.height, zone.color, "4");
            zone.storages.forEach(function(storage) {
                sumMass = storage.masseBois + storage.massePlastique + storage.massePD;
                ctx.fillText(sumMass.toString() + "kg", zone.posX + 20, zone.posY + 20, 500);
            })
        })
    });
}

function drawStock(x, y, width, height, color, lineWidth) {
    ctx.lineWidth = lineWidth;
    ctx.strokeStyle = color;
    ctx.strokeRect(x, y, width, height, color, lineWidth);
    ctx.stroke();
}