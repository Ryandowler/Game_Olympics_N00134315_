var sound = false;//soundtrack initually set to not playing

//plays the levels soundtrack in a loop
var myAudio = new Audio('sounds/level3Soundtrack.mp3');
myAudio.addEventListener('ended', function () {
    this.currentTime = 0;
    this.play();
}, false);
myAudio.play();
sound = true; //soundtrack is playing

//funnction called when "toggle sound" is clicked. this function pauses/plays soundtrack
function toggleSound() {
    if (sound === true) {
        myAudio.pause();
        sound = false;//soundtrack is paused
    } else {
        myAudio.play();
        sound = true;//soundtrack is playing
    }
}