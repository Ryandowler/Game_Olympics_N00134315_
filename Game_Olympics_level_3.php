<!doctype html>
<html lang="en">
    <head>
        <title>Level 3: Snake</title>

        <!-- Basic styling, centering of the canvas. -->
        <style>
            canvas{
                display: block;
                position: absolute;
                border: 1px solid #000;
                margin: auto;
                top: 0;
                bottom: 0;
                right: 0;
                left: 0;
            }
        </style>
    </head>
    <body>
        <script>
            var
                    //constants
                    COLS = 26,
                    ROWS = 26,
                    EMPTY = 0,
                    SNAKE = 1,
                    FRUIT = 2,
                    LEFT = 0,
                    UP = 1,
                    RIGHT = 2,
                    DOWN = 3,
                    KEY_LEFT = 37,
                    KEY_UP = 38,
                    KEY_RIGHT = 39,
                    KEY_DOWN = 40,
                    //Game Objects
                    canvas, /* HTMLCanvas */
                    ctx, /* CanvasRenderingContext2d */
                    keystate, /* Object, used for keyboard inputs */
                    frames, /* number, used for animation */
                    score;	  /* number, keep track of the player score */

            // -------- GRID -------- //
            grid = {
                width: null,
                height: null,
                _grid: null,
                init: function (d, c, r) {
                    this.width = c;
                    this.height = r;

                    this._grid = [];

                    for (var x = 0; x < c; x++) {
                        //push empty array
                        this._grid.push([]);
                        for (var y = 0; y < r; y++) {
                            //push a the new value for each colum
                            this._grid[x].push(d);
                        }
                    }
                },
                // val, x position, y position
                set: function (val, x, y) {
                    this._grid[x][y] = val;
                },
                /**
                 * Get the value of the cell at (x, y)
                 * 
                 * @param  {number} x the x-coordinate
                 * @param  {number} y the y-coordinate
                 * @return {any}   the value at the cell
                 */
                get: function (x, y) {
                    return this._grid[x][y];
                }
            }
            //----------SNAKE----------//
            snake = {
                direction: null, /* number, the direction */
                last: null, /* Object, pointer to the last element in
                 the queue */
                _queue: null, /* Array<number>, data representation*/

                //---FUNCTIONS---//


                //direction, x position, y position
                init: function (d, x, y) {
                    this.direction = d;

                    this._queue = [];
                    this.insert(x, y);
                },
                //x position, y position
                insert: function (x, y) {
                    // unshift prepends an element to an array
                    this._queue.unshift({x: x, y: y});
                    this.last = this._queue[0];
                },
                //Removes and returns the first element in the queue
                remove: function () {
                    //  return the first element
                    return this._queue.pop();
                }
            };


            //Set a food id at a random free cell in the grid 
            function setFood() {
                var empty = [];
                // iterate through the grid and find all empty cells
                for (var x = 0; x < grid.width; x++) {
                    for (var y = 0; y < grid.height; y++) {
                        if (grid.get(x, y) === EMPTY) {
                            empty.push({x: x, y: y});
                        }
                    }
                }
                // chooses a random cell
                var randpos = empty[Math.round(Math.random() * (empty.length - 1))];
                grid.set(FRUIT, randpos.x, randpos.y);
            }

            // ------ GAME FUNTIONS ------//


            //Starts the game
            function main() {
                // create and initiate the canvas element
                canvas = document.createElement("canvas");
                canvas.width = COLS * 20;
                canvas.height = ROWS * 20;
                ctx = canvas.getContext("2d");
                // add the canvas element to the body of the document instead of the long way(html and refer to it)
                document.body.appendChild(canvas);




                frames = 0;
                keystate = {};
                document.addEventListener("keydown", function (evt) {
                    keystate[evt.keyCode] = true;
                });
                document.addEventListener("keyup", function (evt) {
                    delete keystate[evt.keyCode];
                });

                // intatiate game objects and starts the game loop
                init();
                loop();
            }


            //Resets and inits game objects
            function init() {
                score = 0;

                grid.init(EMPTY, COLS, ROWS);

                var sp = {x: Math.floor(COLS / 2), y: ROWS - 1};
                snake.init(UP, sp.x, sp.y);
                grid.set(SNAKE, sp.x, sp.y);

                setFood();
            }


            //The game loop function, used for game updates and rendering

            function loop() {
                update();
                draw();

                window.requestAnimationFrame(loop, canvas);
            }

            /**
             * Updates the game logic
             */
            function update() {
                frames++;

                if (keystate[KEY_LEFT])
                    snake.direction = LEFT;
                if (keystate[KEY_UP])
                    snake.direction = UP;
                if (keystate[KEY_RIGHT])
                    snake.direction = RIGHT;
                if (keystate[KEY_DOWN])
                    snake.direction = DOWN;

                //every 5 frames
                if (frames % 5 === 0) {
                    var nx = snake.last.x;
                    var ny = snake.last.y;

                    switch (snake.direction) {
                        case LEFT:
                            nx--;
                            break;
                        case UP:
                            ny--;
                            break;
                        case RIGHT:
                            nx++;
                            break;
                        case DOWN:
                            ny++;
                            break;
                    }

                    //if snake hits any walls it dies and restart by calling init()
                    if (0 > nx || nx > grid.width - 1 ||
                            0 > ny || ny > grid.height - 1) {

                        return init();
                    }

                    if (grid.get(nx, ny) === FRUIT) {
                        var tail = {x: nx, y: ny};
                        setFood();
                    } else {

                        var tail = snake.remove();
                        grid.set(EMPTY, tail.x, tail.y);
                        tail.x = nx;
                        tail.y = ny;

                    }
                    grid.set(SNAKE, tail.x, tail.y);

                    snake.insert(tail.x, tail.y);



                }


            }


            /**
             * Render the grid to the canvas.
             */
            function draw() {
                // calculate tile-width and -height
                var tw = canvas.width / grid.width;
                var th = canvas.height / grid.height;


                // iterate through the grid and draw all cells
                for (var x = 0; x < grid.width; x++) {
                    for (var y = 0; y < grid.height; y++) {

                        // each cell
                        switch (grid.get(x, y)) {
                            case EMPTY:
                                ctx.fillStyle = "#fff";
                                break;
                            case SNAKE:
                                ctx.fillStyle = "#0ff";
                                break;
                            case FRUIT:
                                ctx.fillStyle = "#f00";
                                break;
                        }
                        ctx.fillRect(x * tw, y * th, tw, th);
                    }
                }
            }

            // start and run the game
            main();




        </script>
    </body>

</html>