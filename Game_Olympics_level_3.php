<!doctype html>
<?php
require 'gameMenu.php';             //requiring in the game menu
require_once 'Styles.php';         //requiring in all stylesheets 
?>
<html lang="en">
    <head>
        <title>Level 3: Snake</title>
        <style>
            canvas{border: 3px solid red;}                                          /* This is the only level that used red border, so its inline*/
        </style>
        <script src="js/gameOlympics_level_3.js"></script>                           <!-- Link in the rest of the javascript -->
    </head>
    <body>
        <table id="scoreTable" >
            <tbody>
                <tr>
                    <td><center>POINTS</center> </td>
                </tr>
            </tbody>
        </table>
        <script>
            //--------------------------------score system---------------------------------------
            
            var tableRef = document.getElementById('scoreTable').getElementsByTagName('tbody')[0];      //getting refference to the table element
            var newRow = tableRef.insertRow(tableRef.rows.length);                                      // Insert a row in the table
            var newCell = newRow.insertCell();                                                          // Insert a cell in the row
            var newText = document.createTextNode("0");                                                 //creating text node and appending 0 as its initial value
            newCell.appendChild(newText);                                                               // Append a text node to the cell

            //called when gamer scores point,   passes point updated variable to the table
            function scoreBoard() {
                newText.nodeValue = score;
            }
            newCell.className = newCell.className + "scoreCountCenter";                                 //giving the cell a class so it can be styled
            main();                                                                                     // start and run the game
        </script>
    </body>
</html>