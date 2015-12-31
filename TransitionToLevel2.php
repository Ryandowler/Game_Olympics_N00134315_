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
       
        <audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
    </body>
    <script>
        document.body.style.background = "#f3f3f3 url('images/trransitionToLevel2.gif')";
        
        
        
        
        function transformation() {
            document.body.style.background = "#f3f3f3 url('images/char1_Animation_into_spotChaser.gif')";
        }
        setTimeout(transformation, 6000);
        
        
        
        
        function waitForTransition() {
            location.href = 'Game_Olympics_level_2.php';
        }
        setTimeout(waitForTransition, 17000);
    </script>
</html>