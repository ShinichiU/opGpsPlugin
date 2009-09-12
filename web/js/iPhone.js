window.onload = function(){
  navigator.geolocation.getCurrentPosition(update);
}
function update(position){
  var latId = document.getElementById('latValue');
  var lonId = document.getElementById('lonValue');
  latId.value = position.coords.latitude;
  lonId.value = position.coords.longitude;
}
