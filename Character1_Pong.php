<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
        <title>Level 2 Loading</title>
        <style>
            /* this css Will only work internally*/
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
    </head>
    <body onkeydown="checkKeys(event)">	
        <img class="transition" src="images/char1_Animation_into_pong.gif">
        <audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
    </body>
    <script>
        
        function beginLevel1() {
           window.location.href = 'Game_Olympics.php';
        }
        
        var motion = "static";
        
             // checkKeys function
        function checkKeys(e) {
            var keyPressed = e.keyCode;
            console.log(keyPressed);
            var selected; //holds url for selected level to go to

            //char 1
            if (keyPressed === 49)
            {
               
            }
            //char 2
            else if (keyPressed === 50)
            {
               
            }
            
            //reset count
            count = 0;
            switch (keyPressed) {
                //left
                case (49):
                    motion = "one";
                    break;
                    //right
                case (50):
                    motion = "two";
                    break;
                    //up
                case (51):
                    motion = "three";
                    break;
                    //down
                case (40):
                    motion = "down";
                    break;
                default:
                    //console.log("default key");
                    motion = "static";

            }
        }
       
    </script>
</html>