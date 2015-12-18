//score gets recieved as a string
var scoreRecieved = localStorage.score1;

//score is recieved as a String so muct convert back to a number
var convertToInt = +scoreRecieved;
scoreRecieved = convertToInt;



var totalAfter_level2;
window.onload = play; //start game

var sound = false; //soundtrack initually set to not playing
//plays the levels soundtrack in a loop
var myAudio = new Audio('sounds/level2Soundtrack.mp3');
myAudio.addEventListener('ended', function () {
    this.currentTime = 0;
    this.play();
}, false);
myAudio.play();
sound = true;//soundtrack is playing

//funnction called when "toggle sound" is clicked. this function pauses/plays soundtrack
function toggleSound() {
    if (sound === true) {
        myAudio.pause();
        sound = false;//soundtrack is paused
    } else {
        myAudio.play();
        sound = true;//soundtrack is playing

    }
}


gamelength = 30; //seconds in game
timerID = null;
var playing = false;
var numholes = 5 * 10;
var currentpos = -1;
var gameScore;

function clrholes() {
    for (var k = 0; k < document.dmz.elements.length; k++)
        document.dmz.elements[k].checked = false;
}

function stoptimer() {
    if (playing)
        clearTimeout(timerID);
}
function showtime(remtime) {
    newText2.nodeValue = remtime;
   
    if (playing) {
        if (remtime === 0) {
            stopgame();
            return;
        } else {
            temp = remtime - 1;
            timerID = setTimeout("showtime(temp)", 1000);
        }
    }
}

function stopgame() {
    stoptimer();
    playing = false;
    newText2.nodeValue = 0;
    clrholes();
    totalAfter_level2 = totalhits + scoreRecieved;   //DDING THE SCORE FROM LEVEL 1 AND 2 TOGeher
    console.log("total after lvl2 " + totalAfter_level2);
    localStorage.setItem("score2", totalAfter_level2); //sending the score on again 
    console.log("scored in LEVEl 2  " + totalhits);

    alert('Game Over.\nYour score is:  ' + totalhits + " Total " + totalAfter_level2);
}

function play() {
    stoptimer();
    if (playing) {
        stopgame();
        return;
    }
    playing = true;
    clrholes();
    totalhits = 0; //score this level

    launch();
    showtime(gamelength);
    
}



function launch() {
    var launched = false;
    while (!launched)
    {
        mynum = random();
        if (mynum !== currentpos) {
            document.dmz.elements[mynum].checked = true;
            currentpos = mynum;
            launched = true;
        }
    }
}

function hithead(id) {
    if (playing === false) {
        clrholes();
        return;
    }
    if (currentpos !== id) {
        totalhits += -1;
        newText.nodeValue = totalhits;
        document.dmz.elements[id].checked = false; //doesnt allow to press in wrong radio button
    } else {
        totalhits += 1;
        scoreTesttttttsstd();
        launch();
        document.dmz.elements[id].checked = false;
    }
}
function random() {
    return(Math.floor(Math.random() * 100 % numholes));
}


//------------------score system------------------
//getting refference to the table element
var tableRef = document.getElementById('scoreTable').getElementsByTagName('tbody')[0];

// Insert a row in the table
var newRow = tableRef.insertRow(tableRef.rows.length);
var newRow2 = tableRef.insertRow(tableRef.rows.length);

// Insert a cell in the row
var newCell = newRow.insertCell();
var newCell2 = newRow.insertCell();

// Append a text node to the cell
var newText = document.createTextNode("0");
var newText2 = document.createTextNode("");

newCell.appendChild(newText);
newCell2.appendChild(newText2);

//called when gamer scores point,   passes point updated variable to the table
function scoreTesttttttsstd() {
    newText.nodeValue = totalhits;
}

//destststs
newCell2.className = newCell2.className + "timeRemaining";
newCell.className = newCell.className + "scoreCount";
    