 var sound = false;//soundtrack initually set to not playing

            //plays the levels soundtrack in a loop
            myAudio = new Audio('sounds/level1Soundtrack.mp3');
            myAudio.addEventListener('ended', function () {
                this.currentTime = 0;
                this.play();
            }, false);
            myAudio.play();
            sound = true; //soundtrack is playing

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
            scoreSound = new Audio('sounds/scoreSound.mp3');


            //------------------score system------------------
            //getting refference to the table element
            var tableRef = document.getElementById('scoreTable').getElementsByTagName('tbody')[0];

            // Insert a row in the table
            var newRow = tableRef.insertRow(tableRef.rows.length);

            // Insert a cell in the row
            var newCell = newRow.insertCell();

            // Append a text node to the cell
            var newText = document.createTextNode(" Score a Point!");

            newCell.appendChild(newText);

            //called when gamer scores point,   passes point updated variable to the table
            function scoreTesttttttsstd() {
                newText.nodeValue = gameScore;
            }





            //Variables
            var WIDTH = 700, //value for width
                    HEIGHT = 600, //value for height
                    pi = Math.PI, //making it easier to use PI
                    UpArrow = 38, //keycode for up arrow
                    DownArrow = 40; //keycode for down arrow
                    gameScore = 0;
    

            //Game elements
            var canvas, ctx, keystate, player, ai, ball;


            player = {
                x: null,
                y: null,
                width: 20,
                height: 100,
                update: function () {
                    //if up is pressed move up 7 pixels
                    if (keystate[UpArrow])
                        this.y -= 7;

                    //if down is pressed move down 7 pixels
                    if (keystate[DownArrow])
                        this.y += 7;

                    //keeps the paddle from leaving the screen
                    this.y = Math.max(Math.min(this.y, HEIGHT - this.height), 0);
                },
                draw: function () {
                    ctx.fillRect(this.x, this.y, this.width, this.height);
                }
            };

            ai = {
                x: null,
                y: null,
                width: 20,
                height: 100,
                update: function () {
                    var desty = ball.y - (this.height - ball.side) * 0.5;
                    this.y += (desty - this.y) * 0.1;

                    //keeps the paddle from leaving the screen
                    this.y = Math.max(Math.min(this.y, HEIGHT - this.height), 0);


                },
                draw: function () {
                    ctx.fillRect(this.x, this.y, this.width, this.height);
                }
            };

            ball = {
                x: null,
                y: null,
                vel: null, //velocity
                speed: 12,
                side: 20, //ball is a square so only needs one measurement

                update: function () {
                    this.x += this.vel.x;
                    this.y += this.vel.y;

                    //simple hit detection
                    //if(this.y < 0 || this.y + this.side > HEIGHT) {
                    //reverse direction
                    //	this.vel.y *= -1;
                    //}

                    if (0 > this.y || this.y + this.side > HEIGHT) {
                        // calculate and add the right offset, i.e. how far
                        // inside of the canvas the ball is
                        var offset = this.vel.y < 0 ? 0 - this.y : HEIGHT - (this.y + this.side);
                        this.y += 2 * offset;
                        // mirror the y velocity
                        this.vel.y *= -1;
                    }

                    //helper function to check if ball hits paddle.....//if intersect returns true else false
                    var AABBIntersect = function (ax, ay, aw, ah, bx, by, bw, bh) {
                        return ax < bx + bw && ay < by + bh &&
                                bx < ax + aw && by < ay + ah;
                    };
                    var pdle = this.vel.x < 0 ? player : ai;
                    if (AABBIntersect(pdle.x, pdle.y, pdle.width, pdle.height,
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
                    /*if (0 > this.x+this.side || this.x > WIDTH){ //Ball reapears !!!!!!!!!!!!!!!!!!!1
                     
                     ball.x = (WIDTH - ball.side)/2;			//
                     ball.y = (HEIGHT - ball.side)/2;
                     
                     ball.vel = {
                     x: ball.speed,
                     y: 0
                     
                     }
                     }
                     */




                    var test = 32;
                    //if i get a point scored on me level 1 is over
                    if (this.x + this.side < 0) {
                        localStorage.setItem("score1", test);


                        console.log("game over");
                        location.href = 'TransitionToLevel2.php';

                    }

                    //if i score a point
                    if (this.x > WIDTH) {

                        gameScore++;
                        console.log(gameScore);

                    }


                    //player scored replace the ball on the canvas
                    if (this.x > WIDTH) {
                        scoreSound.play();
                        scoreTesttttttsstd();


                        ball.x = (WIDTH - ball.side) / 2;
                        ball.y = (HEIGHT - ball.side) / 2;

                        ball.vel = {
                            x: ball.speed,
                            y: 0

                        }

                        console.log("You Scored");


                    }






                },
                draw: function () {
                    ctx.fillRect(this.x, this.y, this.side, this.side);
                }
            };


            //Starts the game
            function main() {
                canvas = document.createElement("canvas"); //creating the canvas
                canvas.width = WIDTH; //assigning width of canvas to be the constant
                canvas.height = HEIGHT; //assigning height of canvas to be the constant
                ctx = canvas.getContext("2d");
                document.body.appendChild(canvas);

                //capturing the keystate
                keystate = {};
                //pressed
                document.addEventListener("keydown", function (evt) {
                    keystate[evt.keyCode] = true;
                });
                //released
                document.addEventListener("keyup", function (evt) {
                    delete keystate[evt.keyCode];
                });


                init();

                var loop = function () {
                    update();
                    draw();

                    window.requestAnimationFrame(loop, canvas);
                };
                window.requestAnimationFrame(loop, canvas);
            }

            //Initatite game objects and set start positions
            function init() {
                //set starting positions
                player.x = player.width;
                player.y = (HEIGHT - player.height) / 2;

                ai.x = WIDTH - (player.width + ai.width);
                ai.y = (HEIGHT - ai.height) / 2;

                ball.x = (WIDTH - ball.side) / 2;
                ball.y = (HEIGHT - ball.side) / 2;

                ball.vel = {
                    x: ball.speed,
                    y: 0

                }









            }

            //Update all game objects
            function update() {
                ball.update();
                player.update();
                ai.update();
            }

            //Clear canvas and draw all game objects and net
            function draw() {
                ctx.fillRect(0, 0, WIDTH, HEIGHT);

                ctx.save();
                ctx.fillStyle = "#fff";

                ball.draw();
                player.draw();
                ai.draw();


                //The net down the centre of the screeen
                var w = 4;
                var x = (WIDTH - w) * 0.5;
                var y = 0;
                var step = HEIGHT / 50; //the step, the higher the number the more dots in the net
                while (y < HEIGHT) {
                    ctx.fillRect(x, y + step * 0.25, w, step * 0.5);
                    y += step;
                }

                ctx.restore();
            }

            //start and run the game
            main();

