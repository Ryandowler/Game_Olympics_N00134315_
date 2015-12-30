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
            
            // -------- GRID -------- //
            VAR grid = {

            width:null;
            height:null;
            _grid:null;
            
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
                    this.[x][y] = val;
                },
                
                get: function(x,y){
                    return this._grid[x][y];
                }
            }
            
            //----------SNAKE----------//
            
            var snake = {
                
                direction:null;
                last:null;
                _queue:null;
                
                
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
            
            // ------ GAME FUNTIONS ------//
            
            function main(){
                
            }
            function init(){
                
            }
            function loop(){
                
            }
            function update(){
                
            }
            
            function draw(){
                
            }
            
            //calling main function
            main();


        </script>
    </head>
    <body>



    </body>
</html>