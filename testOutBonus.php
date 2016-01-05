<!doctype html>
<html lang="en">

	<head>

		<title>Our Game: Spritesheet  Walking</title>

		<script type="text/javascript" src="js/raf.js"></script>
		<script type="text/javascript" src="js/AssetManager.js"></script>
		
		<script type="text/javascript">
		
			//////////////////////////////////
			// AssetManager stuff			//////////////////////////////////	
			
			var ASSET_MANAGER = new AssetManager();
			
			ASSET_MANAGER.queueDownload('characters.png');
			ASSET_MANAGER.queueDownload('tiles32x32.png');
			ASSET_MANAGER.queueDownload('coin_gold.png');
			
			ASSET_MANAGER.downloadAll(init); 
			
		
			var can, ctx;
			var count = 0;
	
			//var position of character x, y;
			var dx, dy;

			//variables are used to slow down animation
			var sloMoCounter = 0;
			var sloMoRate = 5;
			
			var motion="static"; //this variable is the key for changing our animations
			
			var walkImg = new Image();
			var tileImg = new Image();
			var coinImg = new Image();

			var frameW = 32;
			var frameH = 51;

			//NOTE:
			//don't use img.onload events to start animation
			//because local images load before the canvas and context is created.
			//image is 194 h & 204 w
			
			//////////////////////////////////
			// Image objects
			//////////////////////////////////
			
			/*walkImg.src =  "characters.png";
			tileImg.src =  "tiles32x32.png";  //tileart taken from http://opengameart.org/content/top-down-2d-rpg
			coinImg.src =  "coin_gold.png"; //coinart from http://opengameart.org/content/animated-coins-0
		    */
			
			//////////////////////////////////
			// char1Walk object
			//////////////////////////////////

			var char1Walk = new Object();
			char1Walk.static = {frames: [{x:128,y:0}], velocity : {vx:0, vy: 0}};
			char1Walk.down = {frames: [{x:96,y:0},{x:128,y:0},{x:160,y:0}], velocity : {vx:0, vy: 1}};
			char1Walk.left = {frames: [{x:96,y:51},{x:128,y:51},{x:160,y:51}], velocity : {vx:-1, vy: 0}};
			char1Walk.right = {frames: [{x:96,y:153},{x:128,y:153},{x:160,y:153}], velocity : {vx:1, vy: 0}};
			char1Walk.up =  {frames: [{x:96,y:153},{x:128,y:153},{x:160,y:153}], velocity : {vx:0, vy: -1}};
			
                        
                        if(false){
                            
                            var char1Walk = new Object();
			char1Walk.static = {frames: [{x:32,y:0}], velocity : {vx:0, vy: 0}};
			char1Walk.down = {frames: [{x:0,y:0},{x:32,y:0},{x:64,y:0}], velocity : {vx:0, vy: 1}};
			char1Walk.left = {frames: [{x:0,y:51},{x:32,y:51},{x:64,y:51}], velocity : {vx:-1, vy: 0}};
			char1Walk.right = {frames: [{x:0,y:102},{x:32,y:102},{x:64,y:102}], velocity : {vx:1, vy: 0}};
			char1Walk.up =  {frames: [{x:0,y:153},{x:32,y:153},{x:64,y:153}], velocity : {vx:0, vy: -1}};
                            
                            
                        }
                            
                        
                        
                        
			char1Walk.returnFrames =  function(str) {
				return this[str].frames;
			};

			char1Walk.returnVelocity =  function(str) {
				return this[str].velocity;
			};
			
			var curAnim;
			var character1; //will contain the requestAnimationFrame for character1 walking;
			
			//////////////////////////////////
			//terrain render variables
			//////////////////////////////////


			var levelCols=11;							// x axis: level width, in tiles
			var levelRows=9;							// y axis: level height, in tiles
			var tileSize=32;

			var level = [        						// the 11x9 level - 1=wall, 0=empty space
				[1,1,1,1,1,1,1,1,1,1,1],
				[1,1,0,0,0,0,0,0,0,1,1],
				[1,2,0,0,0,0,0,0,0,0,1],
				[1,0,0,2,0,0,0,0,0,0,1],
				[1,0,0,0,0,0,0,0,0,0,1],
				[1,0,0,2,0,0,0,0,0,0,1],
				[1,0,0,0,0,0,0,0,0,0,1],
				[1,1,0,0,0,0,0,0,0,1,1],
				[1,1,1,1,1,1,1,1,1,1,1]
			];

			//////////////////////////////////
			//Coin variables
			//////////////////////////////////
			var coinCounter =0;
			var objPos;	// where our random object will be placed on grid;
			
			//////////////////////////////////
			// Init function
			//////////////////////////////////	
			function init() {
				console.log("hello from the init function");
				can =  document.getElementById("canvas");
				ctx =  can.getContext("2d");
				can.width=tileSize*levelCols;	                    // canvas width. 
				can.height=tileSize*levelRows;              		// canvas height. Same as before
			
				//getting our image from the AssetManager
				walkImg = ASSET_MANAGER.getAsset('characters.png');
				tileImg = ASSET_MANAGER.getAsset('tiles32x32.png');
				coinImg = ASSET_MANAGER.getAsset('coin_gold.png');
								
				count = 0;
				dx = can.width/2 - tileSize/2; 						//center the character
				dy = can.height/2 -tileSize/2;
				
				objPos = getRandomObjectPos();
				//get the position of first object
				
				
				render();
			}


			//////////////////////////////////
			//  utility function to populate objPos 
			//////////////////////////////////

			function getRandomObjectPos() {
				//new random position of our object
				var randomXpos = 0; 
				var randomYpos = 0; 
				
				//make sure random object only gets placed on walkable area
				//carful now:
				//accessing the 2D array means that Ypos is BEFORE Xpos
				//i.e. level[randomYpos][randomXpos]
				
				while (level[randomYpos][randomXpos]!=0){
					randomYpos = Math.floor(Math.random()*levelRows);
					randomXpos = Math.floor(Math.random()*levelCols);
					console.log("Xpos: " + randomXpos +  " Ypos: " + randomYpos + " Tile code: " + level[randomYpos][randomXpos]);
				}
				return {x:randomXpos, y:randomYpos};
			}

			//////////////////////////////////
			// render function
			//////////////////////////////////
			function render() {
				   
				//console.log("render function");
				character1 = requestAnimationFrame(render);
                curAnim = char1Walk.returnFrames(motion);
                curVeloc = char1Walk.returnVelocity(motion);
				
				//console.log(curAnim);
				ctx.clearRect(dx,dy,frameW,frameH);
				renderBg();
				//draws the coin
				renderObject();
				
				//get the cutout Coordinates from the curAnim object							
				xSource = curAnim[count].x;
				ySource = curAnim[count].y;

				//update character position
				dx += curVeloc.vx ;
				dy += curVeloc.vy ;
				
				///////////////////////
				//collision detection
				////////////////////////

				// check for horizontal collisions
		
				var baseCol = Math.floor(dx/tileSize);
				var baseRow = Math.floor(dy/tileSize);
				var colOverlap = dx%tileSize;
				var rowOverlap = dy%tileSize;
					
				if(curVeloc.vx>0){
					if((level[baseRow][baseCol+1] && !level[baseRow][baseCol]) || (level[baseRow+1][baseCol+1] && !level[baseRow+1][baseCol] && rowOverlap)){
						dx=baseCol*tileSize + tileSize/2; //+tileSize/2 is a hack
					}	
				}
				
				if(curVeloc.vx<0){
					if((!level[baseRow][baseCol+1] && level[baseRow][baseCol]) || (!level[baseRow+1][baseCol+1] && level[baseRow+1][baseCol] && rowOverlap)){
						dx=(baseCol+1)*tileSize;
					}	
				}
				
				// check for vertical collisions
				
				baseCol = Math.floor(dx/tileSize);
				baseRow = Math.floor(dy/tileSize);
				colOverlap = dx%tileSize;
				rowOverlap = dy%tileSize;
						
				if(curVeloc.vy>0){
					if((level[baseRow+1][baseCol] && !level[baseRow][baseCol]) || (level[baseRow+1][baseCol+1] && !level[baseRow][baseCol+1] && colOverlap)){
						dy = baseRow*tileSize + tileSize/4; //+tileSize/4 is a hack
					}	
				}
				
				if(curVeloc.vy<0){
					if((!level[baseRow+1][baseCol] && level[baseRow][baseCol]) || (!level[baseRow+1][baseCol+1] && level[baseRow][baseCol+1] && colOverlap)){
						dy = (baseRow+1)*tileSize;
					}		
				}	

				///////////////////////
				//coin collection
				////////////////////////
				
				if (baseCol == objPos.x && baseRow == objPos.y) {
					console.log("===coins collected:===" + coinCounter);
					//increase coinCounter
					coinCounter++;
					//get a new position for the next coin;
					objPos = getRandomObjectPos();
				}
				

				//translating character and drawing to context
				//ctx.save();	
				//ctx.translate(-tileSize/2,-tileSize/2); //center the character
				//drawing the characterspritesheet	
				ctx.drawImage(walkImg, xSource,ySource, frameW,frameH, dx ,dy, frameW/2, frameH/2);
				//ctx.restore();

				if (sloMoCounter == sloMoRate) {
					if(count== curAnim.length-1){
						count= 0;
					 } else {
						count++;
					}
					sloMoCounter = 0;
				}

				sloMoCounter++;
			}

			//////////////////////////////////
			// renderObject draws the object - in this case a coin
			//////////////////////////////////	
			function renderObject(){
				ctx.drawImage(coinImg, 64,0,32,32, tileSize* objPos.x, tileSize * objPos.y, tileSize, tileSize );
			}	

			//////////////////////////////////
			// renderBg function
			//////////////////////////////////	
			
			function renderBg(){
				// clear the canvas
				ctx.clearRect(0, 0, can.width, can.height);
				
				for(i=0;i<levelRows;i++){
					for(j=0;j<levelCols;j++){
						if(level[i][j]==0){
							//draw the grass
							ctx.drawImage(tileImg,5 + (32*6),5, tileSize,tileSize,j*tileSize,i*tileSize,tileSize,tileSize);
						}
						
						if(level[i][j]==1){
							//draw the wall
							ctx.drawImage(tileImg,5,5, tileSize,tileSize,j*tileSize,i*tileSize,tileSize,tileSize);
						}
						if(level[i][j]==2){
							//draw the tiles
							ctx.drawImage(tileImg,5+32,5+32, tileSize,tileSize,j*tileSize,i*tileSize,tileSize,tileSize);
						}
					}
				}
			}

			//////////////////////////////////
			// checkKeys function
			//////////////////////////////////
			function checkKeys(e) {
				var keyPressed = e.keyCode;
				console.log(keyPressed);

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
						break;
					//right
					case (39):
						motion = "right";
						break;
					//up
					case (38):
						motion = "up";
						break;
					//down
					case (40):
						motion = "down";
						break;
					default:
						console.log("default key");
						motion = "static";

				}
			}


		</script>

	</head>


	<body  onkeydown="checkKeys(event)">
		<h2>Game character version. Drawing a Tilemap in the background
		Assetmanager used to load assets.
		</h2>
		<canvas id="canvas">
			Canvas is not supported
		</canvas>

	</body>

</html>