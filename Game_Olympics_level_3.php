<html>
    <head>
        <title>Level 3: Snake</title>
        <!--requires here ryan -->
        <style>
        </style>
        <script>
            //constants
            var COlS = 26, ROWS = 26;
            //IDs
            var EMPTY = 0, SNAKE = 1, FOOD = 2;
            //Directions
            var LEFT=0, UP=1, RIGHT=2, DOWN=3;
            
            
            // -------- GRID -------- //
            var grid = {

            width:null,
            height:null,
            _grid:null,
            
                //---FUNCTIONS---//
            
                //direction, columns, rows 
                init: function(d, c, r){
                    this.width= c;
                    this.height= r;
                    
                    this._grid= [];
                    
                    for(var x = 0; x<c; x++){
                        //push empty array
                        this._grid.push([]);
                        for(var y = 0; y<r; y++){
                            //push a the new value for each colum
                            this._grid[x].push(d);
                            
                        }
                    }


                },
                // val, x position, y position
                set: function(val, x, y){
                    this._grid[x][y] = val;
                },
                
                get: function(x,y){
                    return this._grid[x][y];
                }
            }
            
            //----------SNAKE----------//
            
            var snake = {
                
                direction:null,
                last:null,
                _queue:null,
                
                
                //---FUNCTIONS---//
                
                 //direction, x position, y position
                init: function(d,x,y){
                    this.direction = d;
                    
                    this._queue=[];
                    this.insert(x,y);
                },
                
                //x position, y position
                insert: function(x,y){
                    
                    this._queue.unshift({x:x, y:y});
                    this.last =this._que[0];   
                    
                },
                
                remove: function(){
                    
                }
            }
            
            function setFood(){
                var empty = [];
                for(var x=0; x< grid.width; x++){
                    for(var y =0; y< grid.height; y++){
                        if(grid.get(x,y) === EMPTY){
                            empty.push({x:x, y:y});
                            
                        }
                    }
                } 
                //gives a random empty element
                var randpos = empty[Math.floor(Math.random()*empty.length)];
                grid.set(FRUIT, randpos.x, randpos.y);
            }
            
            
            //Game Objects
            
            var canvas, ctx, keystate, frames;
            
            
            // ------ GAME FUNTIONS ------//
            
            function main(){
                canvas = document.createElement("canvas");
                canvas.width = COLS*20;
                canvas.height = ROWS*20;
                ctx = canvas.getContext("2d");
                document.body.appendChild(canvas);
                
                frames = 0;
                keystate={};
                
                init();
                loop();
                
            }
            function init(){
                grid.init(EMPTY, COLS, ROWS);
                
                var sp = {x:Math.floor(COLS/2), y:ROWS-1};
                snake.init(UP, sp.x, sp.y);
                grid.set(SNAKE, sp.x, sp.y);
                
                setFood();    
            }
            function loop(){
                update();
                draw();
                
                window.requestAnimationFrame(loop, canvas);
                
            }
            function update(){
                frames++;
                
            }
            
            function draw(){
                var tw = canvas.width/grid.width;
                var th = canvas.height/grid.height;
                
                
                   for(var x=0; x< grid.width; x++){
                    for(var y =0; y< grid.height; y++){
                        
                       switch(grid.get(x,y)){
                           
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
                        ctx.fillRect(x*tw, y*th, tw, th);
                    }
                } 
                
                
            }
            
            //calling main function
            main();


        </script>
    </head>
    <body>



    </body>
</html>