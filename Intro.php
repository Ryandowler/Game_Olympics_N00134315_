<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
         <script type="text/javascript" src="js/AssetManager.js"></script>
        <style>
            /* this css Will only work internally*/
            .transition{
                width: 100%;
                height: 100%;	
            }
        </style>
        <title>Game Olympics Loading</title>	
    </head>
    <body onkeydown="checkKeys(event)">
        <div style="display:none;">
            <audio id="audio1" src="sounds/start.mp3" controls preload="auto" autobuffer></audio>
        </div>
        <img class="transition" src="images/intro.gif">
    </body>
    <script src="js/intro.js"></script>
</html>