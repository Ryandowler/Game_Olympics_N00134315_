<html>
    <head>
        <?php
        require_once 'Styles.php';          //requiring in all stylesheets 
        ?>
    </head>
    <body id="whiteFont">
        <table id="highscoreTable"></table>
        <ul id="scoreboardList"></ul>
        <script>
            localStorage.setItem("cheat", 0);                        // reset cheat for second player
            //---reieve gamer score---
            var totalScore = localStorage.TotalScore;
            //-----score is recieved as a String so muct convert back to a number---
            var convertToInt = +totalScore;
            totalScore = convertToInt;

            //---prompt for name---
            var gamerInitialsRecieved = prompt("Please Enter Your Initials");
            //if they dont put an answer in,
            if (gamerInitialsRecieved === null) {
                gamerInitialsRecieved = "AH";
            }
            if (gamerInitialsRecieved.length > 2) {
                var gamerInitialsRecieved = prompt("Please Only Enter 2 Letters");

                //if they dont put an answer in,
                if (gamerInitialsRecieved === null || gamerInitialsRecieved.length > 2) {
                    gamerInitialsRecieved = "AH";
                }
            }
            var gamerInitials = gamerInitialsRecieved.toUpperCase();        //changing input to uppercase   

            //highscore array
            var hignscores = [];
            // hignscores.push(2,3,6);
            //hignscores.sort();      // sorts array from lowest to highest
            //console.log(hignscores[3]);

            //the list element
            var list = document.getElementById('scoreboardList');


            // var gamerInitials = "RD";
            var gamerScore = totalScore;

            if (localStorage.Two_Player_Entered === "false") {
                localStorage.setItem("Player_One_Final_Score", gamerScore);     //player 1 score saved to localStorage
                localStorage.setItem("Player_One_Initials", gamerInitials);     //player 1 initials saved 
            } else {
                localStorage.setItem("Player_Two_Final_Score", gamerScore);     //player 2 score saved to localStorage
                localStorage.setItem("Player_Two_Initials", gamerInitials);     //player 2 initials saved
            }

            
            // gets 2 random initials
            function randomInitials()
            {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

                for (var i = 0; i < 2; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                return text;
            }

            //-------------------- Creating list to append scores to ---------------------------
            var headings = document.createElement('li');
            headings.appendChild(document.createTextNode("GAMER   |   SCORE"));
            list.appendChild(headings);
            headings.className = headings.className + "scoreboardHeading";

            gamer = document.createElement('li');
            gamer2 = document.createElement('li');
            // var level2Score = hignscores[i].name;

            gamer.appendChild(document.createTextNode(localStorage.Player_One_Initials + "____________" + localStorage.Player_One_Final_Score));

            if (localStorage.Two_Player_Entered === "true") {
                gamer2.appendChild(document.createTextNode(localStorage.Player_Two_Initials + "____________" + localStorage.Player_Two_Final_Score));
            }

            list.appendChild(gamer);
            list.appendChild(gamer2);
            gamer.className = gamer.className + "gamerScoreStyle";
            gamer2.className = gamer2.className + "gamer2ScoreStyle";



            //------------------disply High score------------------

            //getting refference to the list element
            var randomScore;
            var randVar;
            //add some phony random scores to scoreboard
            for (var i = 0; i < 16; i++) {
                //random score between 769 and 521
                randomScore = Math.floor(Math.random() * 769) + 521;

                hignscores.push(randomScore);

            }
            //sorts the score array in decending order
            hignscores.sort(function (a, b) {
                return b - a;
            });

            //  }                                 -----------------------------------------   
            for (var i = 0; i < 16; i++) {
                randVar = i;
                randVar = document.createElement('li');
                // var level2Score = hignscores[i].name;

                randVar.appendChild(document.createTextNode(randomInitials() + "___________" + hignscores[i]));
                list.appendChild(randVar);
            }

            //copy highscore array to compare gamer score to it all without adding gamer score to screen with rand initials
            var copyHignscores = [];
            copyHignscores = hignscores;

            //copyHignscores.push(gamerScore)
            var count = 0;

            for (var i = 0; i < hignscores.length; i++) {
                if (hignscores[i] > gamerScore) {
                    count++;
                }
                //if count == 3 that means there is 3 scores better than the gamers one
            }



            var table = document.getElementById("highscoreTable");
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);

            cell1.innerHTML = "Your Position In This Game Olympics:";
            cell1.className = cell1.className + "headingStyle";


            var row2 = table.insertRow(1);
            var cell2 = row2.insertCell(0);

            cell2.innerHTML = count + 1;
            cell2.className = cell2.className + "positionStyle";




            //----------------------------------second player -------------------------------
            //prompt gamer to start secod player to play and challenge their score
            function secondPlayer() {
                if (confirm('Start Second Player Challenge ?')) {
                    localStorage.setItem("Two_Player_Entered", true); //setting to true to use when goes to char select
                    location.href = 'CharacterSelect.php';
                } else {
                    // Do nothing!
                }
            }
            if (localStorage.Two_Player_Entered === "false") {          //only prompt for second player challege if one hasnt happened already
                setTimeout(secondPlayer, 3000);
            }










        </script>
    </body>
</html>

