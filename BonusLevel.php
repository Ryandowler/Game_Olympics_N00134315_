<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
    </head>
    <body  onkeydown="checkKeys(event)">
        <?php
        require_once 'Styles.php';          //requiring in all stylesheets
        require 'gameMenu.php';            //requiring in the game menu
        ?>
        <!-- table that holds the score and time (scoreboard)-->
        <table id="scoreTable">
            <tbody>
                <tr>
                    <td><center>Points | Time </center> </td>
                </tr>
            </tbody>
        </table>
<!-- Hint to gamer that there is a decoy coin-->
<div>
    <h1 class="decoyCoin"><center>Watch Out For The <br>Decoy Coin!</center></h1>
</div>
<canvas id="canvas">
    <!--Displays onscreen if canvas doesnt -->
    Canvas is not supported
</canvas>
<script src="js/bonuslevel.js"></script>
</body>
</html>