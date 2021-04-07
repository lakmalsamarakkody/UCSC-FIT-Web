function display_c(){
  var refresh=1000; // Refresh rate in milli seconds
  mytime=setTimeout('display_ct()',refresh)
}
function display_ct() {
  var dt = new Date()
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  // SET LEADING ZEROS
  if(dt.getHours() < 10){var hours = "0" +dt.getHours()}else{var hours = dt.getHours()}
  if(dt.getMinutes() < 10){var minutes = "0" + dt.getMinutes()}else{var minutes = dt.getMinutes()}
  if(dt.getSeconds() < 10){var seconds = "0" + dt.getSeconds()}else{var seconds = dt.getSeconds()}
  // /SET LEADING ZEROS

  var date = days[dt.getDay()] + " " + dt.getDate() + " " + months[dt.getMonth()] + " " + dt.getFullYear()
  var time = hours + " : " + minutes + " : " + seconds
  document.getElementById('ct').innerHTML = date + " - " + time;
  display_c();
}
$(document).ready(function(){
  display_ct();
});