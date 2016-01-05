<html>
    <head>
        <?php
             require_once 'Styles.php';          //requiring in all stylesheets 
        ?>
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