<?php
//require_once 'gameMenu.php'; 
require_once 'Styles.php';
?>

<?php
require 'gameMenu.php';
?>
<html>
    <head>
         <script src="js/gameOlympics.js"></script>


        <SCRIPT LANGUAGE="JavaScript">
            //score gets recieved as a string
            var scoreRecieved = localStorage.score1;
           
            //score is recieved as a String so muct convert back to a number
            var convertToInt = +scoreRecieved;
            scoreRecieved = convertToInt;
            
            
            
            var totalAfter_level2;
            window.onload = play; //start game

            var sound = false; //soundtrack initually set to not playing
            //plays the levels soundtrack in a loop
            myAudio = new Audio('sounds/level2Soundtrack.mp3');
            myAudio.addEventListener('ended', function () {
                this.currentTime = 0;
                this.play();
            }, false);
            myAudio.play();
            sound = true;//soundtrack is playing

            //funnction called when "toggle sound" is clicked. this function pauses/plays soundtrack
            function toggleSound() {
                if (sound === true) {
                    myAudio.pause();
                    sound = false;//soundtrack is paused
                } else {
                    myAudio.play();
                    sound = true;//soundtrack is playing

                }
            }
            


            gamelength = 30; //seconds in game
            timerID = null
            var playing = false;
            var numholes = 5 * 10;
            var currentpos = -1;

            function clrholes() {
                for (var k = 0; k < document.dmz.elements.length; k++)
                    document.dmz.elements[k].checked = false;
            }

            function stoptimer() {
                if (playing)
                    clearTimeout(timerID);
            }
            function showtime(remtime) {
                document.cpanel.timeleft.value = remtime;
                if (playing) {
                    if (remtime == 0) {
                        stopgame();
                        return;
                    } else {
                        temp = remtime - 1;
                        timerID = setTimeout("showtime(temp)", 1000);
                    }
                }
            }









            function stopgame() {
                stoptimer();
                playing = false;
                document.cpanel.timeleft.value = 0;
                clrholes();
                display("Game Over");
                totalAfter_level2 = totalhits +scoreRecieved;   //DDING THE SCORE FROM LEVEL 1 AND 2 TOGeher
                console.log("total after lvl2 "+totalAfter_level2);
                localStorage.setItem("score2", totalAfter_level2); //sending the score on again 
                console.log("scored in LEVEl 2  "+totalhits);
                
                alert('Game Over.\nYour score is:  ' + totalhits + " bleh " + totalAfter_level2 );
            }




            function play() {
                stoptimer();
                if (playing) {
                    stopgame();
                    return;
                }
                playing = true;
                clrholes();
                totalhits = 0; //score this level
                document.cpanel.score.value = totalhits;
                gameScore 
                display("Playing");
                launch();
                showtime(gamelength);
            }
            function display(msg) {
                document.cpanel.state.value = msg;
            }
            function launch() {
                var launched = false;
                while (!launched)
                {
                    mynum = random();
                    if (mynum != currentpos) {
                        document.dmz.elements[mynum].checked = true;
                        currentpos = mynum;
                        launched = true;
                    }
                }
            }





            function hithead(id) {
                if (playing == false) {
                    clrholes();
                    display("Push Start to Play");
                    return;
                }
                if (currentpos != id) {
                    totalhits += -1;
                    document.cpanel.score.value = totalhits;
                    document.dmz.elements[id].checked = false;
                } else {
                    totalhits += 1;
                    document.cpanel.score.value = totalhits;
                    launch();
                    document.dmz.elements[id].checked = false;
                }
            }


            function random() {
                return(Math.floor(Math.random() * 100 % numholes));
            }





        </script>
    </head>

    <body>

        <form name="cpanel">
            <center>
                <table cellspacing=10>
                    <tr>
                        <td><input type="button" name="startstop" value=" Start Game | Stop Game " onClick="play()"></td>
                        <td></td>
                        <td align=right>Time:</td>
                        <td><input type="text" name="timeleft" size="4" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="state" size="20" value="Push Start to Play" onFocus="this.blur()"></td>
                        <td></td>
                        <td align=right>Score:</td>
                        <td><input type="text" name="score" size="4" onFocus="this.blur()"></td>
                    </tr>
                </table>
            </center>
        </form>

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
            </center> <!-- TAKE this out later, use bootrap-->
        </form>



    </body>

</html>