<?php use_helper('opJavascript') ?>
<?php use_javascript('/opGpsPlugin/js/gears_init') ?>
<?php echo javascript_tag("
var lat = document.getElementById('latValue');
var lon = document.getElementById('lonValue');
function handleError(positionError)
{
  alert('位置情報取得失敗:'+positionError.message);
  return false;
}
") ?>
<?php if ($carrier == 'iPhone'): ?>
<?php echo javascript_tag("
function submitGPS()
{
  var gps = navigator.geolocation;
  gps.getCurrentPosition(setLatLonAndSubmit, handleError);
}
function setLatLonAndSubmit(position)
{
  lat.value = position.coords.latitude;
  lon.value = position.coords.longitude;
  document.getElementById('gps').submit();
}
") ?>
<?php elseif ($carrier == 'Android'): ?>
<?php echo javascript_tag("
function submitGPS()
{
  var gps = google.gears.factory.create('beta.geolocation');
  gps.getCurrentPosition(setLatLonAndSubmit, handleError);
}
function setLatLonAndSubmit(position)
{
  lat.value = position.latitude;
  lon.value = position.longitude;
  document.getElementById('gps').submit();
}
") ?>
<?php endif; ?>
<form method="post" id="gps" action="<?php echo url_for('@gps_create?_csrf_token='.$form->getCSRFToken(), true) ?>">
<input type="hidden" value="" id="latValue" name="lat" />
<input type="hidden" value="" id="lonValue" name="lon" />
<input type="button" class="input_submit" onclick="submitGPS();" value="<?php echo __('Send') ?>" />
</form>
