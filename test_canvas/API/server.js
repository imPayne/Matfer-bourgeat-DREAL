const express = require('express');
const app = express();
const port = 8080;
const csvFile = "../csv/storages.csv";
const mysql = require('mysql');
const csv = require('csv-parser');
const fs = require('fs');
const { CLIENT_RENEG_WINDOW } = require('tls');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'MatferDreal61',
  database: 'epytodo'
});

var zones = [];

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

class Zone extends Area {
  constructor(posX, posY, width, height, storages, alley, column) {
      super(posX, posY, width, height);
      this.storages = storages;
      this.alley = alley;
      this.column = column;
  }
  // faire les Get manquants
  addStorage(storage) {
    var index = this.storages.findIndex(function (s) {
      return(s.level === storage.level && s.storage === storage.storage);
    });
    if (index == -1) 
      this.storages.push(storage);
  }
}

class Storage {
  constructor(level, storage, posX, posY, masseBois, massePlastique, massePD) {
      this.posX = posX;
      this.posY = posY;
      this.masseBois = masseBois;
      this.massePlastique = massePlastique;
      this.massePD = massePD;
      this.level = level;
      this.storage = storage;
  }
}

function GetPreciseLocationY(row) {
  var alleyNumber = +row.alley.match(/\d+/g);//.join('');
  //console.log(row.alley + " = " + alleyNumber);
  if (alleyNumber % 2 == 0) {
    var preciseY = parseFloat(row.Y, 10) + 20;
    //console.log("La je additionne car " + alleyNumber + " est pair donc " + row.Y + " + 20 = " + preciseY);
  }
  else {
    var preciseY = parseFloat(row.Y, 10) - 20;
    //console.log("La je soustrait car " + alleyNumber + " est impair donc " + row.Y + " - 20 = " + preciseY);
  }
  return(preciseY);
}


fs.createReadStream(csvFile)
  .pipe(csv())
  .on("data", (row) => {


    var preciseY =  GetPreciseLocationY(row);
    var rowX = parseInt(row.X, 10);
    //console.log("Zone(row.X = " + rowX + ", preciseY = " + preciseY + ", 20, 20, row.alley = " + row.alley + ", row.column = " + row.column);
    var zone = new Zone(rowX, preciseY, 20, 20, [], row.alley, row.column);
    var storage = new Storage(row.level, row.storage, 0, 0, 0, 0, 0);
    var paramsZone = {zone_posX: rowX, zone_posY: preciseY, zone_width: 20, zone_height: 20};
    var queryZone = "INSERT INTO Zone SET ?";
    var queryStorage = "INSERT INTO Storage SET ?";
    var paramsStorage = {level: row.level, storage: row.storage};


    //console.log("Params(zone_posX = " + zone._posX + ", zone_posY = " + zone._posY);
    var index = zones.findIndex(function (z) {
      //creer un storage si pas deja créer(le storage)
      return z.alley === zone.alley && z.column === zone.column;
    });
    //si index pas trouvé (donc output == -1) => on push ds zones
    if (index == -1) {
      //creer un storage si pas deja créer(le storage)
      zone.addStorage(storage);
      zones.push(zone)
    }
    else {
      zones[index].addStorage(storage);
    }
    console.log("number = " + row.number + " | row.level = " + row.level + " | row.storage = " + row.storage);
    //Insert en base
    connection.query(queryStorage, paramsStorage);
    //connection.query(queryZone, paramsZone);
  })
  .on("end", () => {
    console.log("CSV file successfully processed");
    //console.log(zones);
  });


app.get("/", (req, res) => {
  res.json({message: 'Root page ready'})
})

app.listen(port, () => {
  console.log(`Running at port ${port}`);
})
