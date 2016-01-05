<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <style>
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
        <title>Cheat Code</title>

        <script>
            //---variables---
            var audio1 = new Audio('sounds/cheat.mp3');                 //option selected sound
            var audio2 = new Audio('sounds/cheatCodeActivated.mp3');	//sound for when page loads

            //on window load calls function that plays start up music
            window.onload = startUpMusoc;

            //plays start up music
            function startUpMusoc() {
                audio2.play();
            }  
            localStorage.setItem("cheat", 500);                        //saves 500 points into storage because cheat used
        </script>	
    </head>
    <body onkeydown="checkKeys(event)">
        <div style="display:none;">
            <audio id="audio1" src="sounds/cheat.mp3" controls preload="auto" autobuffer></audio>
        </div>
        <img class="transition" src="images/cheatActivated.gif  ">
    </body>
    <script>
        var motion = "static"; //this variable is the key for changing our animations
        
        // -------checkKeys function-----
        function checkKeys(e) {
            var keyPressed = e.keyCode;
            var selected;                                   //holds url for selected level to go to

            //option 1
            if (keyPressed === 49)                          // if "1" button pressed
            {
                StartSound('audio1');                       //calls function that plays start sound  
                selected = 'Game_Olympics.php';             //level 1 url added to selected variable
            }
            //option 2
            else if (keyPressed === 50)                     // if "2" button pressed
            {
                StartSound('audio1');                       //calls function that plays start sound  
                selected = 'Game_Olympics_level_2.php';     //level 2 url added to selected variable
            }
            //option 3
            else if (keyPressed === 51)                     // if "3" button pressed
            {
                StartSound('audio1');                       //calls function that plays start sound  
                selected = 'Game_Olympics_level_3.php';     //level 3 url added to selected variable
            }
            
            //plays start music and delays the href by enough time to finish the sound clip
            function StartSound(soundobj)
            {
                var thissound = document.getElementById(soundobj);
                thissound.play();
                setTimeout(function () {
                    window.location.href = selected;
                }, 2800);
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
            }
        }
    </script>









</html>