
<html>
    <head>
        <?php
        //requiring in all stylesheets
        require_once 'Styles.php';
        //requiring in the game menu
        require 'gameMenu.php';
        ?>
        <style>

            .timeRemaining{
                color: red;
                font-size: 200%;
            }
            .scoreCount{
                color: green;
                font-size: 200%;
                width:100px;
                
            }
            
              .scoreTable{
            float: left;
            clear:left;
        }
        </style>
    </head>
 
    <body>
        <table id="scoreTable">
            <tbody>
                <tr>
                    <td>Points | Time </td>
                </tr>

            </tbody>
        </table>


        <form name="dmz">
            <center> <!-- TAKE this out later, use bootrap-->
                <table cellspacing=30>	
                    <tr>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(0)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(1)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(2)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(3)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(4)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(5)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(6)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(7)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(8)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(9)"></td>
                    </tr>
                    <tr>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(10)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(11)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(12)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(13)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(14)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(15)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(16)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(17)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(18)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(19)"></td>
                    </tr>
                    <tr>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(20)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(21)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(22)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(23)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(24)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(25)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(26)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(27)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(28)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(29)"></td>
                    </tr>
                    <tr>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(30)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(31)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(32)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(33)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(34)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(35)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(36)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(37)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(38)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(39)"></td>
                    </tr>
                    <tr>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(40)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(41)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(42)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(43)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(44)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(45)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(46)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(47)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(48)"></td>
                        <td align="center" valign="center"><input type="radio" onClick="hithead(49)"></td>
                    </tr>
                </table>
            </center> <!-- TAKE this out later, use bootrap-->
        </form>
    </body>
    <script src="js/gameOlympics_level_2.js"></script>
</html>