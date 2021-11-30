var canvas = document.getElementById("canvas1");
const ctx = canvas.getContext("2d");
var mainBatX = 90;
var mainBatY = 50;


class Area{
    constructor(posX, posY, width, height) {
        this._posX = posX;
        this._posY = posY;
        this._width = width;
        this._height = height;
    }
    get posX() {
        return this._posX;
    }
    get posY() {
        return this._posY;
    }
    get width() {
        return this._width;
    }
    get height() {
        return this._height;
    }
}

class Building extends Area{
    constructor(posX, posY, width, height, zones) {
        super(posX, posY, width, height);
        this._zones = zones;
    }
    get zones() {
        return this._zones;
    }
}

class Zone extends Area {
    constructor(posX, posY, width, height, storages, color) {
        super(posX, posY, width, height);
        this._storages = storages;
        this._color = color;
    }
    get storages() {
        return this._storages;
    }
    get color() {
        return this._color;
    }
    addStorage(storage) {
        this._storages.push(storage);
    }
}

class Storage {
    constructor(posX, posY, masseBois, massePlastique, massePD) {
        this._posX = posX;
        this._posY = posY;
        this._masseBois = masseBois;
        this._massePlastique = massePlastique;
        this._massePD = massePD;
    }
    get posX() {
        return this._posX;
    }
    get posY() {
        return this._posY;
    }
    get masseBois() {
        return this._masseBois;
    }
    get massePlastique() {
        return this._massePlastique;
    }
    get massePD() {
        return this._massePD;
    }
}

var buildings = [
    new Building(mainBatX, mainBatY, 2315, 1040, zones1),
    new Building(60, 1150, 460, 530, zones2),
    new Building(640, 1150, 570, 590, zones3),
    new Building(1335, 1150, 405, 430, zones4),
];

loadImage();

function loadImage() {
    image = new Image();
    image.src = './warehouse_plan.jpg';
    image.onload = function() {
        ctx.drawImage(image, 0, 0, image.width, image.height,
            0, 0, canvas.width, canvas.height);
        draw();
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


/*{id: 4, x: 695, y: 650, width: 21, height: 200, color: "blue", lineWidth: "4"},
{id: 5, x: 760, y: 520, width: 21, height: 200, color: "blue", lineWidth: "4"},
{id: 6, x: 40, y: 915, width: 200, height: 40, color: "blue", lineWidth: "4"},
{id: 7, x: 510, y: 860, width: 60, height: 20, color: "blue", lineWidth: "4"},
{id: 8, x: 490, y: 915, width: 80, height: 10, color: "blue", lineWidth: "4"},
{id: 9, x: 320, y: 915, width: 130, height: 10, color: "blue", lineWidth: "4"},
{id: 10, x: 510, y: 647, width: 60, height: 20, color: "blue", lineWidth: "4"},
{id: 11, x: 510, y: 700, width: 60, height: 20, color: "blue", lineWidth: "4"},
{id: 12, x: 490, y: 750, width: 80, height: 16, color: "blue", lineWidth: "4"},
{id: 13, x: 510, y: 807, width: 60, height: 20, color: "blue", lineWidth: "4"}
{id: 14, x: 320, y: 650, width: 80, height: 20, color: "blue", lineWidth: "4"},
{id: 15, x: 320, y: 700, width: 70, height: 20, color: "blue", lineWidth: "4"},
{id: 16, x: 320, y: 810, width: 110, height: 20, color: "blue", lineWidth: "4"},
{id: 17, x: 320, y: 860, width: 60, height: 20, color: "blue", lineWidth: "4"},,*/
