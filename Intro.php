<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <style>
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
        <title>Game Olympics Loading</title>

        <script>
            //variables
            var audio = new Audio('sounds/start.mp3');			//sound effect for spacebar pressed
            var audio1 = new Audio('sounds/startUpMusic.mp3');	//start up music


            //on window load calls function that plays start up music
            window.onload = startUpMusoc;

            //plays start up music
            function startUpMusoc() {
                audio1.play();
            }
        </script>	
    </head>
    <body onkeydown="checkKeys(event)">
        <div style="display:none;">
            <audio id="audio1" src="sounds/start.mp3" controls preload="auto" autobuffer></audio>
        </div>

        <img class="transition" src="images/intro.gif">


    </body>


    <script>
        var motion = "static"; //this variable is the key for changing our animations

        // checkKeys function
        function checkKeys(e) {
            var keyPressed = e.keyCode;
            //console.log(keyPressed);

            if (keyPressed == 32)
            {
                StartSound('audio1'); //calls function that plays start sound and level 1
            }

            //plays start music and delays the href by enough time to finish the sound clip
            function StartSound(soundobj)
            {
                var thissound = document.getElementById(soundobj);
                thissound.play();
                setTimeout(function () {
                    window.location.href = 'Game_Olympics.php';
                }, 1300);
            }








            //game Cheat         <moving mouse while pressing SHIFT ALT CTRL       
            window.onmousemove = function (e) {
                if (!e)
                    e = window.event;
                if (e.shiftKey)
                {
                    console.log("shift");/*shift is down*/
                    if (e.altKey)
                    {
                        console.log("alt");/*alt is down*/

                        if (e.ctrlKey) {
                            console.log("ctrlllll");/*ctrl is down*/
                            //alert("CHEAT UNLOCLED");
                            window.location.href = 'CheatCodeActivated.php';

                        }
                    }
                }
               };


            //reset count
            count = 0;
            switch (keyPressed) {
                //left
                case (32):
                    motion = "space";
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
                    //console.log("default key");
                    motion = "static";

            }
        }
    </script>









</html>