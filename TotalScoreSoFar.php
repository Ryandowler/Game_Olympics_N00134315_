<html>
    <head>
        <style>
            html{   

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
               
                position: absolute;
            }
        </style>
    </head>
    <body onkeydown="checkKeys(event)" id="testr">
        <ul id="demo"></ul>
        <script>
            //setting background
            document.body.style.background = " url('images/scoreSoFar.gif')";
            //retrieving the score from localstorage
            var scoreRecieved = localStorage.score2; //level 1 and 2 added together
            var scoreFromLevel2 = localStorage.scoreFromLevel2;//score FromLevel 2
            var cheat = localStorage.cheat;//score From cheat
            
            var scoreHidden=false;
            document.getElementById("testr").style.color = 'white';


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

            //cheat code
            var convertToInt3 = +cheat;
            cheat = convertToInt3;

            //------------------disply score------------------

            //getting refference to the list element
            var list = document.getElementById('demo');

            //level 2
            var entry = document.createElement('li');
            var level2Score = scoreFromLevel2;

            //level level 1 and 2 added together
            var entry2 = document.createElement('li');
            var totalSofar = scoreRecieved + cheat;

            //level 1
            var entry0 = document.createElement('li');
            var level1Score = totalSofar - level2Score - cheat;

            //cheat code
            var entryCheat = document.createElement('li');
            var cheatScore = cheat;

            entry0.appendChild(document.createTextNode("Level 1 Score: " + level1Score));
            
            
            //hide score when space pressed to view transformation into snake 
            if(scoreHidden ===  false){
                 list.appendChild(entry0);
            }
           

            entry.appendChild(document.createTextNode("Level 2 Score: " + level2Score));
            list.appendChild(entry);

            entryCheat.appendChild(document.createTextNode("Cheat Code: " + cheatScore));
            //wont display on screen unless the cheat has actually been activated
            if (cheatScore > 0) {
                list.appendChild(entryCheat);
            }

            //\xa0 creates a space in javascript
            entry2.appendChild(document.createTextNode("Overal \xa0Score: " + totalSofar));
            list.appendChild(entry2);


            // checkKeys function
            function checkKeys(e) {
                var keyPressed = e.keyCode;

                if (keyPressed === 32)
                {
                    //invisible scores
                    document.getElementById("testr").style.color = 'rgba(0,0,0,0.01)';
                    scoreHidden = true;
                    document.body.style.background = "#f3f3f3 url('images/char1_Animation_into_snake.gif')";

                    function waitForTransition() {
                        window.location.href = 'Game_Olympics_level_3.php';
                    }
                    setTimeout(waitForTransition, 9000);


                    
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







        </script>
    </body>
</html>

