
<html>
    <head>
        <title>Bonus Level</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/raf.js"></script>
        <script type="text/javascript" src="js/AssetManager.js"></script>
    </head>
    <body>
        <ul id="finalScoreWas"></ul>
        <canvas id="canvas" width="800" height="500">
            Canvas is not supported
        </canvas>
    </body>
    <script>

        //load animation for char 2 if thats the char selected by user
        if (true) {
            document.body.style.background = "#f3f3f3 url('images/bonusLevel.gif')";
        }

        function transformation() {
            location.href = 'BonusLevel.php';   //go to bonusLevel
        }
        setTimeout(transformation, 17000);      //activate the above function in 17sec


        //-------------------------disply score-------------------------

        var totalScore = localStorage.TotalScore;                    //retrieving the score from localstorage
        var convertToInt = +totalScore;                              //score is recieved as a String so muct convert back to an int
        totalScore = convertToInt;
        var entry2 = document.createElement('li');                   //create the list element
        var list = document.getElementById('finalScoreWas');         //getting refference to the list element

        entry2.appendChild(document.createTextNode("Your Final Score Was only: " + totalScore));
        list.appendChild(entry2);

        entry2.className += " " + "bonusText";                      //appending class name so ca style it
    </script>
</html>