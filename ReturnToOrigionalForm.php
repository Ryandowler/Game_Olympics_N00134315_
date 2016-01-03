
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
        <title>Returning To Original Form</title>
        <style>
            /* this css Will only work internally*/
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
    </head>
    <body onkeydown="checkKeys(event)">	
        <audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
    </body>
    <script>
        document.body.style.background = "#f3f3f3 url('images/char1_Animation_Back_into_char.gif')";
        function beginLevel1() {
            window.location.href = 'Game_Olympics.php';
        }

        //plays the levels soundtrack in a loop
        var myAudio = new Audio('sounds/transformation.mp3');
        myAudio.addEventListener('ended', function () {
            this.currentTime = 0;
            this.play();
        }, false);
        myAudio.play();
        sound = true; //soundtrack is playing


        //retrieving from localstorage
        var character = localStorage.character;

        //load danimation for char 2 if thats the char selected by user
        if (character === "2") {
            document.body.style.background = "#f3f3f3 url('images/char2_Animation_Back_into_char.gif')";
        }
        //retrieving total score from local storage
        var TotalScore = localStorage.TotalScore;
        // convert score to int
        var convertToInt = +TotalScore;
        TotalScore = convertToInt;

        function waitForTransition() {
            if (TotalScore<500) {
                location.href = 'BonusLevel.php';
            }
            else{
                location.href = 'TotalScoreSoFar2.php';
            }

        }
        setTimeout(waitForTransition, 7000);

    </script>
</html>