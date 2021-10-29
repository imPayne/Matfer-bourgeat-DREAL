var canvas = document.getElementById("canvas1");
const ctx = canvas.getContext("2d");
var mainBatX = 43;
var mainBatY = 25;


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

var storages1 = [
    new Storage(40, 49 * 2, 300, 23, 32),
    new Storage(85, 70 + (60 * 5), 100, 20, 39),
]

var storages2 = [
    new Storage(85, 70 + (60 * 2), 100, 20, 39),
]

var storages3 = [
    new Storage(299, 299, 299, 100, 100, "orange"),
]

var storages4 = [
    new Storage(499, 299, 299, 100, 100, "yellow"),
]


var storages5 = [
    new Storage(299, 599, 299, 100, 100, "pink"),
]

var zones1 = [
    new Zone(85, 72 + (60 * 0), 20, 20, storages1,"blue"),
    new Zone(85, 70 + (60 * 1), 20, 20, storages2,"blue"),
]

var zones2 = [
    new Zone(320, 700, 80, 20, storages3,"green"),
]

var zones3 = [
    new Zone(40, 150, 20, 20, storages4, "green"),
]

var zones4 = [
    new Zone(500, 150, 20, 20, storages5, "blue"),
]

var buildings = [
    new Building(mainBatX, mainBatY, 1110, 563, zones1),
    new Building(30, 620, 220, 290, zones2),
    new Building(305, 620, 275, 320, zones3),
    new Building(640, 620, 200, 235, zones4),
];
draw();


function draw() {
    console.log(buildings);
    buildings.forEach(function(building) {
        drawStock(building.posX, building.posY, building.width, building.height, building.color, "4");
        building.zones.forEach(function(zone) {
            drawStock(zone.posX, zone.posY, zone.width, zone.height, zone.color, "4");
            zone.storages.forEach(function(storage) {
                let sumMass = storage.masseBois + storage.massePlastique + storage.massePD;
                ctx.fillText(sumMass.toString(), zone.posX, zone.posY, 1080);
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


/*class Zone{
    constructor(posX, posY, width, height, color, lineWidth) {
        this._color = color;
        this._lineWidth = lineWidth;
        this._posX = posX;
        this._posY = posY;
        this._width = width;
        this._height = height;
        this._sites = sites;
    }
    get color() {
        return this._color;
    }
    get lineWidth() {
        return this._lineWidth;
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

    draw() {
        drawStock(posX, posY, width, height, color, lineWidth);
        return
    }
}*/