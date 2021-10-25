
var canvas = document.getElementById("canvas1");
const ctx = canvas.getContext("2d");

var wrhStock = [];

var mainBatX = 43;
var mainBatY = 25;

Main();

function drawStock(x, y, width, height, color, lineWidth) {

    ctx.lineWidth = lineWidth;
    ctx.strokeStyle = color;
    ctx.strokeRect(x, y, width, height, color, lineWidth);
    ctx.stroke();
}

function drawRack() {
    //var rack_number = 1;
    var size_x = 32;
    var borderline_size = "2";
    var color_rack = "blue";
    var y = 75;
    var size_y = 20;
    for (z = 0; z <= 2; z++) {
        for (i = 0, x = 85; i < 26; i++) { // first line site rack
            drawStock(x, y, size_x, size_y, color_rack, borderline_size); //draw rack site
            x = x + size_x + 2;
        }
        //ctx.fillText(rack_number.toString(base));
        //rack_number++;
        y += 55;
    }
    //rack emplacement
    for (i = 0, x = 86, y  = 242; i < 26; i++) {
        drawStock(x, y, size_x, size_y, color_rack, borderline_size);
        x = x + size_x + 2;
    } 
    for (i = 0, x = 87, y  = 299; i < 26; i++) {
        drawStock(x, y, size_x, size_y, color_rack, borderline_size);
        x = x + size_x + 2;
    }
 
    for (i = 0, x = 87, y  = 353; i < 26; i++) {
        drawStock(x, y, size_x, size_y, color_rack, borderline_size);
        x = x + size_x + 2;
    }

    for (i = 0, x = 87, y  = 410; i < 26; i++) {
        drawStock(x, y, size_x, size_y, color_rack, borderline_size);
        x = x + size_x + 2;
    }
    for (i = 0, x = 87, y  = 464; i < 26; i++) {
        drawStock(x, y, size_x, size_y, color_rack, borderline_size);
        x = x + size_x + 2;
    }
    for (i = 0, x = 87, y  = 521; i < 26; i++) {
        drawStock(x, y, size_x, size_y, color_rack, borderline_size);
        x = x + size_x + 2;
    }
}

function Main(){
    drawStock(mainBatX, mainBatY, 1110, 563, "red", "4"); //main bat
    drawRack();// draw the 9 rack of the warehouse
}



console.log(wrhStock);

