<html>
    <head>
        <style>
            html{   
                background: url(images/scoreSoFar.gif) no-repeat center center fixed;
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
                color:white;
                position: absolute;
            }
        </style>
    </head>
    <body onkeydown="checkKeys(event)">
        <ul id="demo"></ul>
        <script>
            //retrieving the score from localstorage
            var scoreRecieved = localStorage.score2;
            var scoreFromLevel2 = localStorage.scoreFromLevel2;

            //-----score is recieved as a String so muct convert back to a number---
            //level 1 and 2 score combined
            var convertToInt = +scoreRecieved;
            scoreRecieved = convertToInt;

            //level 2 score
            var convertToInt2 = +scoreFromLevel2;
            scoreFromLevel2 = convertToInt2;

            //------------------disply score------------------

            //getting refference to the list element
            var list = document.getElementById('demo');

            var entry = document.createElement('li');
            var level2Score = scoreFromLevel2;

            var entry2 = document.createElement('li');
            var totalSofar = scoreRecieved;

            var entry0 = document.createElement('li');
            var level1Score = totalSofar - level2Score;

            entry0.appendChild(document.createTextNode("Level 1 Score: " + level1Score));
            list.appendChild(entry0);

            entry.appendChild(document.createTextNode("Level 2 Score: " + level2Score));
            list.appendChild(entry);

            //\xa0 creates a space in javascript
            entry2.appendChild(document.createTextNode("Overal \xa0Score: " + totalSofar));
            list.appendChild(entry2);


            // checkKeys function
            function checkKeys(e) {
                var keyPressed = e.keyCode;

                if (keyPressed == 32)
                {
                    window.location.href = 'Game_Olympics_level_3.php';
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
