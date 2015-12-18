<html>
    <head>

    </head>
    <body>
        
      <table id="myTable">
    <thead>
        <tr>
            <th>Player</th>
            <th>Highscore</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>R.D</td> 
            <td>20000</td> 
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>My footer</td>
        </tr>
    </tfoot>
</table>




    </body>
            <script>
            var scoreRecievedEnd = localStorage.score1;
           
            //score is recieved as a String so muct convert back to a number
            var convertToInt = +scoreRecievedEnd;
            scoreRecievedEnd = convertToInt;
            
           // 
            
       
           
          

            var gamerName = prompt ("Enter Your Name");
              var score = scoreRecievedEnd;
              var initials = gamerName;
               function addNewScore()  {
              var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];

              // Insert a row in the table at row index 0
              var newRow   = tableRef.insertRow(tableRef.rows.length);
              var newRow2  = tableRef.insertRow(tableRef.rows.length);

              // Insert a cell in the row at index 0
              var newCell  = newRow.insertCell(0);
              var newCell1  = newRow.insertCell(0);

              // Append a text node to the cell
              var newText  = document.createTextNode(score);
              var newText1  = document.createTextNode(initials);
              newCell.appendChild(newText);
              newCell1.appendChild(newText1);
              
     }
            
        </script>

</html>