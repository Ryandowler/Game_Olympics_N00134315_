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
                font-size: 1.5em;

                position: absolute;
            }
            .gamerScoreStyle{
                color:red;
            }
        </style>
    </head>
    <body id="testr">
        <ul id="demo"></ul>
        <script>

            //var name = prompt("Please Enter Your Initials");

            //highscore array
            var hignscores = [];
            // hignscores.push(2,3,6);
            //hignscores.sort();      // sorts array from lowest to highest
            //console.log(hignscores[3]);

            //the list element
            var list = document.getElementById('demo');

            var gamerScore = 9001;
            var gamerInitials = "RD";




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

            gamer = document.createElement('li');
            // var level2Score = hignscores[i].name;



            gamer.appendChild(document.createTextNode(gamerInitials + "_____" + gamerScore));
            list.appendChild(gamer);
            gamer.className = gamer.className + "gamerScoreStyle";








            //  for (i = 0; i < hignscores.length; i++) {--------------------------------------------
            //alert("score " + hignscores[i].score + " Name: " + hignscores[i].name);

            //------------------disply High score------------------

            //getting refference to the list element
            var randomScore;
            var randVar;
            //add some phony random scores to scoreboard
            for (var i = 0; i < 5; i++) {
                //random score between 769 and 521
                randomScore = Math.floor(Math.random() * 769) + 521;

                hignscores.push(randomScore);







            }
            //sorts the score array in decending order
            hignscores.sort(function (a, b) {
                return b - a;
            });

            //  }                                 -----------------------------------------   
            for (var i = 0; i < 5; i++) {
                randVar = i;
                randVar = document.createElement('li');
                // var level2Score = hignscores[i].name;



                randVar.appendChild(document.createTextNode(randomInitials() + "______" + hignscores[i]));
                list.appendChild(randVar);





            }














        </script>
    </body>
</html>

