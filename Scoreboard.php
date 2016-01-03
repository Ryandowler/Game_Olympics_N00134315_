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
        </style>
    </head>
    <body id="testr">
        <ul id="demo"></ul>
        <script>
            
            var name = prompt("What is your name");
            
            var hignscores = [];
            hignscores.push({score: 1200, name: name});
           

            for (i = 0; i < hignscores.length; i++) {
                //alert("score " + hignscores[i].score + " Name: " + hignscores[i].name);
                
                   //------------------disply High score------------------

            //getting refference to the list element
            var list = document.getElementById('demo');

            //level 2
            var entry = document.createElement('li');
            var level2Score = hignscores[i].name;


            entry.appendChild(document.createTextNode("->>" + level2Score));
            list.appendChild(entry);
            }


         








        </script>
    </body>
</html>

