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
           if(cheatScore >0){
                list.appendChild(entryCheat);
           }
           
            //\xa0 creates a space in javascript
            entry2.appendChild(document.createTextNode("Overal \xa0Score: " + totalSofar  ));
            list.appendChild(entry2);