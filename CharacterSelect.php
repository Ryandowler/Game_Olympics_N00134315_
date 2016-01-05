<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
        <title>Select Character</title>
    </head>
    <body onkeydown="checkKeys(event)">	
       <!-- <img class="transition" src="images/characterSelect.gif">-->
        <audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
    </body>
    <script>
        document.body.style.background = "url('images/characterSelect.gif')";   //setting background image
        
        //------plays the levels soundtrack in a loop----
        var myAudio = new Audio('sounds/selectCharacter.mp3');
        myAudio.addEventListener('ended', function () {
            this.currentTime = 0;
            this.play();
        }, false);
        myAudio.play();
        sound = true; //soundtrack is playing

        // checkKeys function
        function checkKeys(e) {
            var keyPressed = e.keyCode;
            console.log(keyPressed);
            var selected; //holds url for selected level to go to

            //char 1
            if (keyPressed === 49)
            {
                document.body.style.background = "#f3f3f3 url('images/char1_Animation_into_pong.gif')"; //changes bg to the animation for char 1
                function waitForTransition() {
                    location.href = 'Game_Olympics.php';
                }
                setTimeout(waitForTransition, 12000);                                                   //when animation is over go to level1
                localStorage.setItem("character", 1);                                                   //saves the chosen char into local storage

            }
            //char 2
            else if (keyPressed === 50)
            {
                document.body.style.background = "#f3f3f3 url('images/char2_Animation_into_pong.gif')";//changes bg to the animation for char 2
                function waitForTransition() {
                    location.href = 'Game_Olympics.php';
                }
                setTimeout(waitForTransition, 12000);                                                   //when animation is over go to level1
                localStorage.setItem("character", 2);                                                   //saves the chosen char into local storage
            }
            switch (keyPressed) {    
                case (49):
                    motion = "one";     //character 1
                    break;
                case (50):
                    motion = "two";     //character 2
                    break;
            }
        }
    </script>
</html>