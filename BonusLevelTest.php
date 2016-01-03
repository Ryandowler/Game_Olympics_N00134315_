
<html>
    <head>
        <title>Bonus Level</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
        <style>
            html{   
                /* background: url(images/scoreSoFar.gif) no-repeat center center fixed;*/
                width: 100%;
                height: 100%;

            }
            ul {
                /*border: 1px solid black;*/
                display: inline-block;  
                list-style-type: none;


            }   
            #demo{
                font-size: 3em;
                /*color:black;*/
                position: absolute;
                color: white;
            }
            canvas{
                border: 0;
            }
            .bonusText{
                margin-left: 7em;
            }
        </style>
    </head>
    <body onload="init()"   onkeydown="checkKeys(event)">
        <ul id="demo"></ul>
        <canvas id="canvas" width="800" height="500">
            Canvas is not supported
        </canvas>
    </body>
    <script>

        //load danimation for char 2 if thats the char selected by user
        if (true) {
            document.body.style.background = "#f3f3f3 url('images/bonusLevel.gif')";
        }

        var loaded = false;

        var can, ctx;
        var count = 0;
        var count2 = 0;
        //var x, y;
        var dx, dy;
        var dx2, dy2;

        //variables are used to slow down animation
        var sloMoCounter = 0;
        var sloMoRate = 5;

        var motion = "static";
        var motion2 = "static";

        var frameW = 32;
        var frameH = 51;

        var ASSET_MANAGER = new AssetManager();
        ASSET_MANAGER.queueDownload('characters.png');
        ASSET_MANAGER.queueDownload('coin_gold.png');
        ASSET_MANAGER.downloadAll(init);

        var walkImg = new Image();
        var coinImg = new Image();

        //coin variables
        var coinCounter = 0;
        var objPos;	// where our random object will be placed on grid;
        //end coin variables


        var randomDirection;
        // var randomIndex = randomDirection.length -1;
        var randomIndex;

        //walkImg.src =  "characters.png";

        char1Walk = new Object();
        //coordinates for where to cut out the sprite from sprite sheet
        char1Walk.static = {frames: [{x: 32, y: 0}], velocity: {vx: 0, vy: 0}};
        char1Walk.down = {frames: [{x: 0, y: 0}, {x: 32, y: 0}, {x: 64, y: 0}], velocity: {vx: 0, vy: 1}};
        char1Walk.left = {frames: [{x: 0, y: 51}, {x: 32, y: 51}, {x: 64, y: 51}], velocity: {vx: -1, vy: 0}};
        char1Walk.right = {frames: [{x: 0, y: 102}, {x: 32, y: 102}, {x: 64, y: 102}], velocity: {vx: 1, vy: 0}};
        char1Walk.up = {frames: [{x: 0, y: 153}, {x: 32, y: 153}, {x: 64, y: 153}], velocity: {vx: 0, vy: -1}};
        char1Walk.jump = {frames: [{x: 0, y: 153}, {x: 32, y: 153}, {x: 64, y: 153}], velocity: {vx: 5, vy: -5}};
        char1Walk.returnFrames = function (str) {
            return this[str];
        };
        char1Walk.returnVelocity = function (str) {
            return this[str].velocity;
        };

        //char2
        char2Walk = new Object();
        //coordinates for where to cut out the sprite from sprite sheet
        char2Walk.static = {frames: [{x: 96, y: 0}], velocity: {vx: 0, vy: 0}};
        char2Walk.down = {frames: [{x: 128, y: 0}, {x: 32, y: 0}, {x: 64, y: 0}], velocity: {vx: 10, vy: 10}};
        char2Walk.left = {frames: [{x: 0, y: 51}, {x: 32, y: 51}, {x: 64, y: 51}], velocity: {vx: 100, vy: 0}};
        char2Walk.right = {frames: [{x: 0, y: 102}, {x: 32, y: 102}, {x: 64, y: 102}], velocity: {vx: 1, vy: 0}};
        char2Walk.up = {frames: [{x: 0, y: 153}, {x: 32, y: 153}, {x: 64, y: 153}], velocity: {vx: 0, vy: -1}};
        char2Walk.jump = {frames: [{x: 0, y: 153}, {x: 32, y: 153}, {x: 64, y: 153}], velocity: {vx: 5, vy: -5}};
        char2Walk.returnFrames = function (str) {
            return this[str];
        };
        char2Walk.returnVelocity = function (str) {
            return this[str].velocity;
        };
        var curAnim;
        var curVelocity;
        var character1; //will contain the requestAnimationFrame for character1 walking;
        var character2; //will contain the requestAnimationFrame for character1 walking;

        function init() {
            console.log("hello init");
            can = document.getElementById("canvas");
            ctx = can.getContext("2d");

            walkImg = ASSET_MANAGER.getAsset('characters.png');
            coinImg = ASSET_MANAGER.getAsset('coin_gold.png');

            count = 0;
            count2 = 0;
            dx = 20;
            dy = 400;



            dx2 = can.width / 4;
            dy2 = can.height / 2;
            
            objPos = getRandomObjectPos();//coin

            //if the player selected character 2 draw that charater 
            if (character === "2") {
                char2Draw();
            }
        }
        setTimeout(function () {
            loaded = true;
            init();

        }, 2300);

        function char1Draw() {
            //console.log("char1Draw function")
            character1 = requestAnimationFrame(char1Draw);
            curAnim = char1Walk.returnFrames(motion);
            curFrames = curAnim.frames;

            curVelocity = char1Walk.returnVelocity(motion);
            //console.log("count: " + count + "x: " + curFrames[count].x +"y: " +curFrames[count].y);

            ctx.clearRect(dx - 1, dy - 1, frameW + 2, frameH + 2);
            xSource = curAnim.frames[count].x;
            ySource = curAnim.frames[count].y;

            dx = dx + curVelocity.vx;
            dy = dy + curVelocity.vy;
            ctx.drawImage(walkImg, xSource, ySource, frameW, frameH, dx, dy, frameW, frameH);

            if (sloMoCounter === sloMoRate) {
                if (count === curFrames.length - 1) {
                    count = 0;
                } else {
                    count++;
                }
                sloMoCounter = 0;
            }
            sloMoCounter++;
        }

        function char2Draw() {
            //console.log("char1Draw function")
            randomDirection = ["left", "right", "down", "up"];
            randomIndex = Math.floor(Math.random() * (randomDirection.length)) + 0;
            //randomDirection[randomIndex]

            character2 = requestAnimationFrame(char2Draw);
            curAnim = char2Walk.returnFrames(motion2);
            curFrames = curAnim.frames;

            curVelocity = char2Walk.returnVelocity(motion2);
            //console.log("count: " + count + "x: " + curFrames[count].x +"y: " +curFrames[count].y);

            ctx.clearRect(dx2 - 1, dy2 - 1, frameW + 2, frameH + 2);
            xSource2 = curAnim.frames[count2].x;
            //console.log("x: " + xSource2);
            ySource2 = curAnim.frames[count2].y;

            dx2 = dx2 + curVelocity.vx;
            dy2 = dy2 + curVelocity.vy;
            ctx.drawImage(walkImg, xSource2, ySource2, frameW, frameH, dx2, dy2, frameW, frameH);

            if (sloMoCounter === sloMoRate) {
                if (count2 === curFrames.length - 1) {
                    count2 = 0;
                } else {
                    count2++;
                }
                sloMoCounter = 0;
            }

            sloMoCounter++;

            var AABBIntersect = function (ax, ay, aw, ah, bx, by, bw, bh) {
                return ax < bx + bw && ay < by + bh &&
                        bx < ax + aw && by < ay + ah;
            };
        }
        function checkKeys(e) {
            var keyPressed;
            keyPressed = e.keyCode;

            //reset count
            count = 0;
            switch (keyPressed) {
                //left
                case (37):
                    motion = "left";
                    //dx = dx -10;
                    break;
                    //right
                case (39):
                    motion = "right";
                    //dx = dx + 10;
                    break;
                    //up
                case (38):
                    motion = "up";
                    //dy = dy -10;
                    break;
                    //down
                case (40):
                    motion = "down";
                    //dy = dy + 10;
                    break;

                case (87):
                    motion2 = "up";
                    break;

                case (65):
                    motion2 = "left";
                    break;

                case (68):
                    motion2 = "right";
                    break;

                case (83):
                    motion2 = "down";
                    break;

                default:
                    //console.log("key pressed was " + keyPressed);
                    motion = "static";
                    if (keyPressed > 0) {
                        //console.log("works !");
                        keyPressed = 0;

                        if (keyPressed <= 0) {
                            function stopAnim() {
                                cancelAnimationFrame(character1);
                            }
                        }
                    }
            }
        }

        function stopAnim() {
            cancelAnimationFrame(character1);
        }
        function startAnim() {
            requestAnimationFrame(char1Draw);
        }

        //retrieving the score from localstorage
        var scoreRecieved = localStorage.score2;
        var scoreFromLevel2 = localStorage.scoreFromLevel2;
        var scoreFromLevel3 = localStorage.scoreFromLevel3;
        var cheat = localStorage.cheat;//score From cheat
        var character = localStorage.character;

        //check if is Nan, true will mean cheat not activated
        var check = isNaN(cheat);
        if (check) {
            cheat = 0;
        }
        ;

        //-----score is recieved as a String so muct convert back to a number---
        //level 1 and 2 score combined
        var convertToInt = +scoreRecieved;
        scoreRecieved = convertToInt;

        //level 2 score
        var convertToInt2 = +scoreFromLevel2;
        scoreFromLevel2 = convertToInt2;

        //level 3 score
        var convertToInt3 = +scoreFromLevel3;
        scoreFromLevel3 = convertToInt3;

        //cheat code
        var convertToInt3 = +cheat;
        cheat = convertToInt3;

        //------------------disply score------------------

        //getting refference to the list element
        var list = document.getElementById('demo');

        var entry = document.createElement('li');
        var level2Score = scoreFromLevel2;

        var entry3 = document.createElement('li');
        var level3Score = scoreFromLevel3;

        var entry2 = document.createElement('li');
        var totalSofar = scoreRecieved + cheat + level3Score;

        var entry0 = document.createElement('li');
        var level1Score = totalSofar - level2Score - cheat - level3Score;

        entry2.appendChild(document.createTextNode("Your Final Score Was only: " + totalSofar));
        list.appendChild(entry2);

        entry2.className += " " + "bonusText";


        if (character === "1") {
            console.log("char 1");

        }

        function changeBackground() {
            //setting background
            document.body.style.background = " url('images/blankBackground.jpg')";
            console.log("should eb working");
            //if the player selected character 1 draw that charater 
            if (character === "1" && loaded) {
                char1Draw();
            }

        }
        setTimeout(changeBackground, 16000);




    </script>
</html>