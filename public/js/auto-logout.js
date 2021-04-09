//initialize
var timoutNow = 6000000;
var timeoutTimerID;

//start timer
function startTimer() {
  // window.setTimeout returns an Id that can be used to start and stop a timer
  timeoutTimerID = window.setTimeout(IdleTimeout, timoutNow);
}

//reset timer
function resetTimer() {
  window.clearTimeout(timeoutTimerID);
  startTimer();
}

// Logout the user.
function IdleTimeout() {
  document.getElementById('logout-form').submit();
}

//timer setup
function setupTimers () {
  document.addEventListener("mousemove", resetTimer, false);
  document.addEventListener("mousedown", resetTimer, false);
  document.addEventListener("keypress", resetTimer, false);
  document.addEventListener("touchmove", resetTimer, false);
  document.addEventListener("onscroll", resetTimer, false);
  startTimer();
}

//run timer automatically
$(document).ready(function(){
  setupTimers();
});