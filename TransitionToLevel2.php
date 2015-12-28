<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Level 2 Loading</title>
        <style>
            /* this css Will only work internally*/
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
    </head>
    <body>	
        <img class="transition" src="images/trransitionToLevel2.gif">
        <audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
    </body>
    <script>
        function waitForTransition() {
            location.href = 'Game_Olympics_level_2.php';
        }
        setTimeout(waitForTransition, 6000);
    </script>
</html>