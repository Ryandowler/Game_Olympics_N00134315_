<html>
    <head>
        <style>
            html{   
                /* background: url(images/scoreSoFar.gif) no-repeat center center fixed;*/
                width: 100%;
                height: 100%;

            }
            ul {
                /*border: 1px solid black;*/
                display: inline-block;  
                list-style-type: none;

            }   
            #demo{
                font-size: 3em;
                color:black;
                position: absolute;
            }
            .fontWhite{
                color:white;
            }
        </style>
    </head>
    <body onkeydown="checkKeys(event)">
        <ul id="demo"></ul>
        <script>
            document.body.style.background = " url('images/animatingScoreSoFar2.gif')";
            
            
            //retrieving the score from localstorage
            var scoreRecieved = localStorage.score2;
            var scoreFromLevel2 = localStorage.scoreFromLevel2;
            var scoreFromLevel3 = localStorage.scoreFromLevel3;
            var cheat = localStorage.cheat;//score From cheat
            var character = localStorage.character;

            //check if is Nan, true will mean cheat not activated
            var check = isNaN(cheat);
            if (check) {
                cheat = 0;
            }
            ;

            //-----score is recieved as a String so muct convert back to a number---
            //level 1 and 2 score combined
            var convertToInt = +scoreRecieved;
            scoreRecieved = convertToInt;

            //level 2 score
            var convertToInt2 = +scoreFromLevel2;
            scoreFromLevel2 = convertToInt2;

            //level 3 score
            var convertToInt3 = +scoreFromLevel3;
            scoreFromLevel3 = convertToInt3;

            //cheat code
            var convertToInt3 = +cheat;
            cheat = convertToInt3;






            //------------------disply score------------------

            //getting refference to the list element
            var list = document.getElementById('demo');

            var entry = document.createElement('li');
            var level2Score = scoreFromLevel2;

            var entry3 = document.createElement('li');
            var level3Score = scoreFromLevel3;

            var entry2 = document.createElement('li');
            var totalSofar = scoreRecieved + cheat + level3Score;
            localStorage.setItem("TotalScore", totalSofar); //adds overall score into storage to be used by BonusLevel

            var entry0 = document.createElement('li');
            var level1Score = totalSofar - level2Score - cheat - level3Score;



            //cheat code
            var entryCheat = document.createElement('li');
            var cheatScore = cheat;

            entry0.appendChild(document.createTextNode("Level 1 Score: " + level1Score));
            list.appendChild(entry0);

            entry.appendChild(document.createTextNode("Level 2 Score: " + level2Score));
            list.appendChild(entry);

            entry3.appendChild(document.createTextNode("Level 3 Score: " + level3Score));
            list.appendChild(entry3);

            entryCheat.appendChild(document.createTextNode("Cheat Code: " + cheatScore));
            //wont display on screen unless the cheat has actually been activated
            if (cheatScore > 0) {
                list.appendChild(entryCheat);
            }

            //\xa0 creates a space in javascript
            entry2.appendChild(document.createTextNode("Overal \xa0Score: " + totalSofar));
            list.appendChild(entry2);

            //if player didnt get score of 500 or more redirect to bonus level
            if (totalSofar < 500) {
                location.href = 'BonusLevel.php';
            }
            
            
            entry0.className = entry0.className + "fontWhite";
            entry.className = entry.className + "fontWhite";
            entry2.className = entry2.className + "fontWhite";
            entry3.className = entry3.className + "fontWhite";
            entryCheat.className = entryCheat.className + "fontWhite";
            
            

            // checkKeys function
            function checkKeys(e) {
                var keyPressed = e.keyCode;

                if (keyPressed === 32)
                {
                    window.location.href = 'Scoreboard.php';
                }

                //reset count
                count = 0;
                switch (keyPressed) {
                    //left
                    case (32):
                        motion = "space";
                        break;
                }
            }

            if (character === "1") {
                console.log("char 1");

            }







        </script>
    </body>
</html>

