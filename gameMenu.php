<html><!-- I should put the score var in here because this is on everypage -->
    <head>
        <!-- Style-->
        <style>
            .dropdown {
                position: relative;

                /** Make it fit tightly around it's children */
                display: inline-block;
            }

            .dropdown .dropdown-menu {
                position: absolute;

                /**
                 * Set the top of the dropdown menu to be positioned 100%
                 * from the top of the container, and aligned to the left.
                 */
                top: 100%;
                left: 0;

                /** Allow no empty space between this and .dropdown */
                margin: 0;
            }




            .dropdown:hover .dropdown-menu {

                /** Show dropdown menu */
                display: block;
            }



            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown .dropdown-menu {
                position: absolute;
                top: 100%;
                display: none;
                margin: 0;

                /****************
                 ** NEW STYLES **
                 ****************/

                list-style: none; /** Remove list bullets */
                width: 100%; /** Set the width to 100% of it's parent */
                padding: 0;
            }

            .dropdown:hover .dropdown-menu {
                display: block;
            }

            /** Button Styles **/
            .dropdown button {
                background: #FF6223;
                color: #FFFFFF;
                border: none;
                margin: 0;
                padding: 0.4em 0.8em;
                font-size: 1em;
            }

            /** List Item Styles **/
            .dropdown a {
                display: block;
                padding: 0.2em 0.8em;
                text-decoration: none;
                background: #CCCCCC;
                color: #333333;
            }

            /** List Item Hover Styles **/
            .dropdown a:hover {
                background: #BBBBBB;
            }
        </style>
    </head>
    <body>
        <!-- dropdown container -->
        <div class="dropdown">
            <!-- trigger button -->
            <button><img src='images/icon_cog.png'></button>
            <!-- dropdown menu -->
            <ul class="dropdown-menu">
                <li><a href="#contact" onclick="toggleSound()"><p><img src='images/icon_sound.png'><text class="dropDownItem"> Toggle Sound</text></p></a></li>
                <li><a href="Intro.php"><p><img src='images/icon_quit.png'><text class="dropDownItem"> Quit</text></p></a></li>
                <li><a href="Game_Olympics.php"><p><img src='images/icon_startAgain.png'><text class="dropDownItem"> Start Again</text></p></a></li>
            </ul>
        </div>


    </body>
</html>











