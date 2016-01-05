localStorage.clear();                                   //clear localstorage
var audio = new Audio('sounds/start.mp3');		//sound effect for spacebar pressed
var audio1 = new Audio('sounds/startUpMusic.mp3');	//start up music

//document.body.style.background = "#f3f3f3 url('images/introAnimation.gif')";
window.onload = startUpMusoc;                           //on window load calls function that plays start up music

function startUpMusoc() {                               //plays start up music
    audio1.play();
}

var motion = "static";                                  //this variable is the key for changing the animation

//--------------- checkKeys function-----------------
function checkKeys(e) {
    var keyPressed = e.keyCode;

    if (keyPressed === 32)                              //if spacebar pressed
    {
        audio1.pause();                                 // if gamer presses space straight away, stop playing intro music 
        StartSound('audio1');                           //calls function that plays start sound and level 1
    }

    //------plays start music and delays the href by enough time to finish the sound clip-----
    function StartSound(soundobj)
    {
        var thissound = document.getElementById(soundobj);
        thissound.play();
        setTimeout(function () {
            window.location.href = 'CharacterSelect.php';
        }, 1300);                                       //waits for animation to finish
    }

    //---------game Cheat <moving mouse while pressing SHIFT ALT CTRL ------------      
    window.onmousemove = function (e) {
        if (!e)
            e = window.event;
        if (e.shiftKey)
        {
            //shift is down
            if (e.altKey)
            {
                //alt is down
                if (e.ctrlKey) {
                    //ctrl is down
                    //got this far so all keys are held down togetehr
                    window.location.href = 'CheatCodeActivated.php';    //go to cheat page
                }
            }
        }
    };

    //reset count
    count = 0;
    switch (keyPressed) {
        //left
        case (32):
            motion = "space";                 //spacebar
            break;
    }
}