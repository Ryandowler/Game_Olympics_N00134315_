<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
        <title>Select Character</title>
        <style>
            /* this css Will only work internally*/
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
    </head>
    <body onkeydown="checkKeys(event)">	
       <!-- <img class="transition" src="images/characterSelect.gif">-->
        <audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
    </body>
    <script>
        document.body.style.background = "#f3f3f3 url('images/characterSelect.gif')";
        function beginLevel1() {
            window.location.href = 'Game_Olympics.php';
        }
        
        //plays the levels soundtrack in a loop
        var myAudio = new Audio('sounds/selectCharacter.mp3');
        myAudio.addEventListener('ended', function () {
            this.currentTime = 0;
            this.play();
        }, false);
        myAudio.play();
        sound = true; //soundtrack is playing


        var motion = "static";

        // checkKeys function
        function checkKeys(e) {
            var keyPressed = e.keyCode;
            console.log(keyPressed);
            var selected; //holds url for selected level to go to

            //char 1
            if (keyPressed === 49)
            {
                document.body.style.background = "#f3f3f3 url('images/char1_Animation_into_pong.gif')";
                function waitForTransition() {
                    location.href = 'Game_Olympics.php';
                }
                setTimeout(waitForTransition, 12000);
                localStorage.setItem("character", 1);

            }
            //char 2
            else if (keyPressed === 50)
            {
                document.body.style.background = "#f3f3f3 url('images/char2_Animation_into_pong.gif')";
                function waitForTransition() {
                    location.href = 'Game_Olympics.php';
                }
                setTimeout(waitForTransition, 12000);

                localStorage.setItem("character", 2);

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