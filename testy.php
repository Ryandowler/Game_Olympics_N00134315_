<!doctype html>
<html lang="en">

    <head>

        <title>Lab08 Solution: Spritesheet Walking NO.1</title>

        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
        <script type="text/javascript">
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
            ASSET_MANAGER.downloadAll(init);
            var walkImg = new Image();

            var randomDirection;
            // var randomIndex = randomDirection.length -1;
            var randomIndex;



            //NOTE:
            //don't use img.onload events to start animation
            //because local images load before the canvas and context is created.
            //image is 194 h & 204 w

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
            char2Walk.static = {frames: [{x: 32, y: 0}], velocity: {vx: 0, vy: 0}};
            char2Walk.down = {frames: [{x: 0, y: 0}, {x: 32, y: 0}, {x: 64, y: 0}], velocity: {vx: 0, vy: 1}};
            char2Walk.left = {frames: [{x: 0, y: 51}, {x: 32, y: 51}, {x: 64, y: 51}], velocity: {vx: -1, vy: 0}};
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

                count = 0;
                count2 = 0;
                dx = can.width / 2;
                dy = can.height / 2;
                char1Draw();

                dx2 = can.width / 3;
                dy2 = can.height / 3;
                char2Draw();
            }

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

                if (sloMoCounter == sloMoRate) {
                    if (count == curFrames.length - 1) {
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

               // var char1 = this.vel.x < 0 ? player : ai;
               /* if (AABBIntersect(pdle.x, pdle.y, pdle.width, pdle.height,
                        this.x, this.y, this.side, this.side)
                        )
                {
                    this.x = pdle === player ? player.x + player.width : ai.x - this.side;
                    var n = (this.y + this.side - pdle.y) / (pdle.height + this.side);
                    var phi = 0.25 * pi * (2 * n - 1);

                    var smash = Math.abs(phi) > 0.2 * pi ? 1.5 : 1;
                    this.vel.x = smash * (pdle === player ? 1 : -1) * this.speed * Math.cos(phi);
                    this.vel.y = smash * (this.speed * Math.sin(phi));
                }
        */


            }


            function checkKeys(e) {
                var keyPressed;
                keyPressed = e.keyCode;
                //console.log(keyPressed);


                /*
                 Keycode for arrow keys are. You need to listen to the
                 onkeydown event.
                 left = 37
                 up = 38
                 right = 39
                 down = 40
                 */

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



        </script>
        <style>
            canvas{ background:url(background.jpg)}
        </style>
    </head>

    <body onload="init()"   onkeydown="checkKeys(event)">
        <h2>Game character version 1.</h2>
        <canvas id="canvas" width="800" height="500">
            Canvas is not supported
        </canvas>
        <br>
        <button id="Stop_Moving">Stop Moving</button>
        <button id="Start_Moving">Start Moving</button>

        <script>
            function stopAnim() {
                cancelAnimationFrame(character1);
            }
            function startAnim() {
                requestAnimationFrame(char1Draw);
            }
            window.document.getElementById("Stop_Moving").addEventListener("click", stopAnim);
            window.document.getElementById("Start_Moving").addEventListener("click", startAnim);




        </script>

    </body>

</html>