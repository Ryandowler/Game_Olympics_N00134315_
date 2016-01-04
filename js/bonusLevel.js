     //-----asset managing------
            var ASSET_MANAGER = new AssetManager();
            ASSET_MANAGER.queueDownload('characters.png');
            ASSET_MANAGER.queueDownload('tiles32x32.png');
            ASSET_MANAGER.queueDownload('coin_gold.png');
            ASSET_MANAGER.downloadAll(init);


            var gamelength = 3000; //seconds in game
            var timerID = null;
            var character = localStorage.character;                     //retrieving character selectd from local storage
            var coinAudio = new Audio('sounds/coin.mp3');               // audio that plays when coin is collected
            var sound = false;                                          //soundtrack initually set to not playing
            var playing = false;                                        // game is not started
            var myAudio = new Audio('sounds/bonusLevelSoundtrack.mp3'); //This levels (Bonus Level)soundtrack

            //-------------canvas and game variables---------------
            var can, ctx;                           //canvas and context
            var count = 0;
            var dx, dy;                             //var position of character x, y;
            var sloMoCounter = 0;                   //used to slow down animation
            var sloMoRate = 5;                      //used to slow down animation
            var motion = "static";                  //this variable is the key for changing the animation
            var walkImg = new Image();              //initialise image for walking (char)
            var tileImg = new Image();              //initialise image for the (backround)
            var coinImg = new Image();              //initialise image for coin
            var frameW = 32;                        //size of the cut ouut for the sprites Width
            var frameH = 51;                        //size of the cut ouut for the sprites Height
            var curAnim;
            var curVelocity;
            var character1;                         //will contain the requestAnimationFrame for character1 walking;
            var levelCols = 20;                     // x axis: level width, in tiles
            var levelRows = 13;                     // y axis: level height, in tiles
            var tileSize = 32;                      //tsize of the tiles
            var coinCounter = 0;                    //hold the total amount of coins
            var objPos;                             // where our random object will be placed on grid;  (coin 2)
            var objPos2;                            // where our random object will be placed on grid; (coin 2, the decoy)

            //positioning of what goes where by its code (1,0) ....columns and rows
            var level = [// the 11x9 level - 1=wall, 0=empty space
                [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
                [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
            ];





            //------plays the levels soundtrack in a loop------
            myAudio.addEventListener('ended', function () {
                this.currentTime = 0;
                this.play();
            }, false);
            myAudio.play();
            sound = true;//soundtrack is playing

            //------funnction called when "toggle sound" is clicked. this function pauses/plays soundtrack-----
            function toggleSound() {
                if (sound === true) {
                    myAudio.pause();
                    sound = false;//soundtrack is paused
                } else {
                    myAudio.play();
                    sound = true;//soundtrack is playing
                }
            }
            //---stops the onscreen timer----
            function stoptimer() {
                if (playing)
                    clearTimeout(timerID);
            }
            //------Displays time on screen ------
            function showtime(remtime) {
                newText2.nodeValue = remtime;   //updating the node that actually shows the time
                if (playing) {
                    if (remtime === 0) {
                        stopgame();             //stops game if time runs out
                        return;
                    } else {
                        temp = remtime - 1;
                        timerID = setTimeout("showtime(temp)", 1000);
                    }
                }
            }

            //---Stops game its called if time runs out-----
            function stopgame() {
                stoptimer();                                //call function to stop timer
                playing = false;                            //playing set back to false
                newText2.nodeValue = 0;                     //sets the value of the onscreen timer to 0
                window.location.href = 'Scoreboard.php';    //game is over so head on to scoreboard
            }

            //------------ draws the character selected by gamer at start of game (CharacterSelect.php)------------------------
            if (character === "2") {
                var char1Walk = new Object();
                char1Walk.static = {frames: [{x: 128, y: 0}], velocity: {vx: 0, vy: 0}};
                char1Walk.down = {frames: [{x: 96, y: 0}, {x: 128, y: 0}, {x: 160, y: 0}], velocity: {vx: 0, vy: 6}};
                char1Walk.left = {frames: [{x: 96, y: 51}, {x: 128, y: 51}, {x: 160, y: 51}], velocity: {vx: -6, vy: 0}};
                char1Walk.right = {frames: [{x: 96, y: 153}, {x: 128, y: 153}, {x: 160, y: 153}], velocity: {vx: 6, vy: 0}};
                char1Walk.up = {frames: [{x: 96, y: 153}, {x: 128, y: 153}, {x: 160, y: 153}], velocity: {vx: 0, vy: -6}};
            } else {
                var char1Walk = new Object();
                char1Walk.static = {frames: [{x: 32, y: 0}], velocity: {vx: 0, vy: 0}};
                char1Walk.down = {frames: [{x: 0, y: 0}, {x: 32, y: 0}, {x: 64, y: 0}], velocity: {vx: 0, vy: 6}};
                char1Walk.left = {frames: [{x: 0, y: 51}, {x: 32, y: 51}, {x: 64, y: 51}], velocity: {vx: -6, vy: 0}};
                char1Walk.right = {frames: [{x: 0, y: 102}, {x: 32, y: 102}, {x: 64, y: 102}], velocity: {vx: 6, vy: 0}};
                char1Walk.up = {frames: [{x: 0, y: 153}, {x: 32, y: 153}, {x: 64, y: 153}], velocity: {vx: 0, vy: -6}};
            }

            char1Walk.returnFrames = function (str) {
                return this[str].frames;
            };

            char1Walk.returnVelocity = function (str) {
                return this[str].velocity;
            };

            // --------------------Init function----------------------------
            function init() {
                playing = true;                                         //Now the game starts, in here along with everythinng else
                showtime(gamelength);                                   //show time onscreen
                can = document.getElementById("canvas");                //making refference to the canvas
                ctx = can.getContext("2d");                             //returns a drawing context on the canvas, or null if not supported.
                can.width = tileSize * levelCols;	                // canvas width in respect to the size of tiles and amount of columns
                can.height = tileSize * levelRows;                      // canvas height in respect to the size of tiles and amount of rows
                walkImg = ASSET_MANAGER.getAsset('characters.png');     //retrieving image from the AssetManager
                tileImg = ASSET_MANAGER.getAsset('tiles32x32.png');     //retrieving image from the AssetManager
                coinImg = ASSET_MANAGER.getAsset('coin_gold.png');      //retrieving image from the AssetManager

                count = 0;                                              //setting count to start from 0
                dx = can.width / 2 - tileSize / 2;                      //center the characters x
                dy = can.height / 2 - tileSize / 2;                     //center the characters y
                objPos = getRandomObjectPos();                          //giving coin random position on canvas
                objPos2 = getRandomObjectPos2();                        //giving coin random position on canvas

                render();                                               //Finally Render to screen
            }

            //  -------------utility function to populate objPos ----------
            function getRandomObjectPos() {
                var randomXpos = 0;                                     //new random position for object's x
                var randomYpos = 0;                                     //new random position for object's y

                // loop that gets a random Xpos, Ypos and Tile code(where to put coin)
                while (level[randomYpos][randomXpos] !== 0) {
                    randomYpos = Math.floor(Math.random() * levelRows);
                    randomXpos = Math.floor(Math.random() * levelCols);
                }
                return {x: randomXpos, y: randomYpos};
            }
            //  -------------utility function to populate objPos2 ----------
            function getRandomObjectPos2() {
                //new random position of our object
                var randomXpos = 0;                                     //new random position for object's x
                var randomYpos = 0;                                     //new random position for object's y

                // loop that gets a random Xpos, Ypos and Tile code(where to put coin)
                while (level[randomYpos][randomXpos] !== 0) {
                    randomYpos = Math.floor(Math.random() * levelRows);
                    randomXpos = Math.floor(Math.random() * levelCols);
                }
                return {x: randomXpos, y: randomYpos};
            }

            // --------------------------render function---------------------------
            function render() {
                character1 = requestAnimationFrame(render);             //perform an animation for the character
                curAnim = char1Walk.returnFrames(motion);               //frames for the character to walk
                curVeloc = char1Walk.returnVelocity(motion);            //velocity for the charater
                ctx.clearRect(dx, dy, frameW, frameH);                  //clears the canvas

                renderBg();                                             //renders the background
                renderObject();                                         //renders coin1
                renderObject2();                                        //renders coin2							
                xSource = curAnim[count].x;                             //get the cutout Coordinates from the curAnim object
                ySource = curAnim[count].y;                             //get the cutout Coordinates from the curAnim object

                dx += curVeloc.vx;                                      //update character x position
                dy += curVeloc.vy;                                      //update character y position

                //-----------------------------------------collision detection-------------------------------------------

                // ------------check for horizontal collisions----------------
                //Variables
                var baseCol = Math.floor(dx / tileSize);
                var baseRow = Math.floor(dy / tileSize);
                var colOverlap = dx % tileSize;
                var rowOverlap = dy % tileSize;

                if (curVeloc.vx > 0) {
                    if ((level[baseRow][baseCol + 1] && !level[baseRow][baseCol]) || (level[baseRow + 1][baseCol + 1] && !level[baseRow + 1][baseCol] && rowOverlap)) {
                        dx = baseCol * tileSize + tileSize / 2;
                    }
                }
                if (curVeloc.vx < 0) {
                    if ((!level[baseRow][baseCol + 1] && level[baseRow][baseCol]) || (!level[baseRow + 1][baseCol + 1] && level[baseRow + 1][baseCol] && rowOverlap)) {
                        dx = (baseCol + 1) * tileSize;
                    }
                }


                // -----------check for vertical collisions------------------
                //variables
                baseCol = Math.floor(dx / tileSize);
                baseRow = Math.floor(dy / tileSize);
                colOverlap = dx % tileSize;
                rowOverlap = dy % tileSize;

                if (curVeloc.vy > 0) {
                    if ((level[baseRow + 1][baseCol] && !level[baseRow][baseCol]) || (level[baseRow + 1][baseCol + 1] && !level[baseRow][baseCol + 1] && colOverlap)) {
                        dy = baseRow * tileSize + tileSize / 4;
                    }
                }

                if (curVeloc.vy < 0) {
                    if ((!level[baseRow + 1][baseCol] && level[baseRow][baseCol]) || (!level[baseRow + 1][baseCol + 1] && level[baseRow][baseCol + 1] && colOverlap)) {
                        dy = (baseRow + 1) * tileSize;
                    }
                }


                //---------------coin collection----------------------------
                if (baseCol === objPos.x && baseRow === objPos.y) {
                    coinCounter += 20;                                 //increase coinCounter
                    coinCollet();                                     // coinCollect function call
                    objPos = getRandomObjectPos();                   //get a new position for the next coin;
                    objPos2 = getRandomObjectPos2();                //get a new position for the next coin;

                }

                //drawing the characterspritesheet	
                ctx.drawImage(walkImg, xSource, ySource, frameW, frameH, dx, dy, frameW * 1.3, frameH * 1.3);
                if (sloMoCounter === sloMoRate) {
                    if (count === curAnim.length - 1) {
                        count = 0;
                    } else {
                        count++;
                    }
                    sloMoCounter = 0;       // set sloMoCounter to 0
                }
                sloMoCounter++;             //increase sloMoCounter
            }


            // --------------------draw coins --------------------
            function renderObject() {
                ctx.drawImage(coinImg, 64, 0, 32, 32, tileSize * objPos.x, tileSize * objPos.y, tileSize * 2, tileSize * 2);
            }

            function renderObject2() {
                ctx.drawImage(coinImg, 32, 0, 32, 32, 384, tileSize * objPos.y + 7, tileSize * 2 + 9, tileSize * 2 + 9);
            }

// render background
function renderBg() {
    ctx.clearRect(0, 0, can.width, can.height);         // clear the canvas
    for (i = 0; i < levelRows; i++) {
        for (j = 0; j < levelCols; j++) {
            if (level[i][j] === 0) {
                //draw the grass
                ctx.drawImage(tileImg, 5 + (32 * 6), 5, tileSize, tileSize, j * tileSize, i * tileSize, tileSize, tileSize);
            }
            if (level[i][j] === 1) {
                //draw the wall
                ctx.drawImage(tileImg, 5, 5, tileSize, tileSize, j * tileSize, i * tileSize, tileSize, tileSize);
            }
            if (level[i][j] === 2) {
                //draw the tiles
                ctx.drawImage(tileImg, 5 + 32, 5 + 32, tileSize, tileSize, j * tileSize, i * tileSize, tileSize, tileSize);
            }
        }
    }
}

// ------ checkKeys function for detecting keystrokes -------
function checkKeys(e) {
    var keyPressed = e.keyCode;
    count = 0;                      //reset count
    switch (keyPressed) {
        //left
        case (37):
            motion = "left";        //left key
            break;
            //right
        case (39):
            motion = "right";       //right key
            break;
            //up
        case (38):
            motion = "up";          //up key
            break;
            //down
        case (40):
            motion = "down";       //down key
            break;
        default:
            motion = "static";     //standing still by default
    }
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
function coinCollet() {
    newText.nodeValue = coinCounter;
}

//adding a class to the cell to later style
newCell2.className = newCell2.className + "timeRemaining";
newCell.className = newCell.className + "scoreCount";
