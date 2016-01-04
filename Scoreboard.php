<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <style>
            
            html{   

                width: 100%;
                height: 100%;
                color: white;

            }
            ul {
                /*border: 1px solid black;*/
                display: inline-block;  
                list-style-type: none;

            }  


            #demo{
                font-size: 1.5em;
                display: block;
                position: absolute;
                float: right;  
                margin-left: 50%;
                margin-top: -150px;
                position: absolute;
                
            }
            .gamerScoreStyle{
                color:red;
                font-weight: bold;
            }
            .headingStyle{
                font-size: 2em;
                font-weight: bold;
            }
            /*gamer position (1 or 4 etc) */
            .positionStyle{
                font-size: 9em;
                text-align: center;
                color: gold;
            }
            .scoreboardHeading{
                font-size: 1.4em;
            }
        </style>
    </head>
    <body id="testr">
        <table id="highscoreTable">
           
                    
       
        </table>
        <ul id="demo"></ul>
        <script>
            
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
            var list = document.getElementById('demo');

            var gamerScore = totalScore;
            // var gamerInitials = "RD";




            //  var randomLetter =["a","b","c"];
            var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            //var randomLetter = letters.charAt(Math.floor(Math.random() * letters.length));



            function randomInitials()
            {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

                for (var i = 0; i < 2; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                return text;
            }


            var headings = document.createElement('li');

            headings.appendChild(document.createTextNode("GAMER   |   SCORE"));
            list.appendChild(headings);
             headings.className = headings.className + "scoreboardHeading";

            gamer = document.createElement('li');
            // var level2Score = hignscores[i].name;



            gamer.appendChild(document.createTextNode(gamerInitials + "___________" + gamerScore));
            list.appendChild(gamer);
            gamer.className = gamer.className + "gamerScoreStyle";








            //  for (i = 0; i < hignscores.length; i++) {--------------------------------------------
            //alert("score " + hignscores[i].score + " Name: " + hignscores[i].name);

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
                    console.log("hey " + count);
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
            
            cell2.innerHTML = count +1; 
            cell2.className = cell2.className + "positionStyle";
            
            
            
                

            








        </script>
    </body>
</html>

