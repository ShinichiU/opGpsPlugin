<?php use_helper('Javascript', 'opGps') ?>
<?php $googlemapsApikey = sfConfig::get('google_maps_api_key') ?>
<?php $googleAjaxSearchApikey = sfConfig::get('google_ajax_search_api_key') ?>
<?php $params = op_calc_gcs_change($memberGpsPosition) ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<title><?php echo ($op_config['sns_title']) ? $op_config['sns_title'] : $op_config['sns_name'] ?></title>
<?php if (!empty($googlemapsApikey) && !empty($googleAjaxSearchApikey)): ?>
<?php use_javascript('http://www.google.co.jp/uds/api?file=uds.js&v=1.0&key='.$googleAjaxSearchApikey) ?>
<?php use_javascript('http://maps.google.co.jp/maps?file=api&v=1.0&key='.$googlemapsApikey) ?>
<?php echo javascript_tag("
var gls;
var gMap;
function OnLocalSearch() {
  if (!gls.results) return;
  var first = gls.results[0];
  var point = new GLatLng(parseFloat(first.lat), parseFloat(first.lng));
  var zoom = 15;
  gMap.addControl(new GSmallMapControl());
  gMap.addControl(new GMapTypeControl());
  gMap.setMapType(G_MAP_TYPE);
  gMap.setCenter(point, zoom);
  var marker = new GMarker(point);
  gMap.addOverlay(marker);
  geocoder = new GClientGeocoder();
}
function load() {
  if (GBrowserIsCompatible()) {
    var point = new GLatLng(".$params['lat'].", ".$params['lon'].");
    var zoom = 15;
    gMap = new GMap2(document.getElementById('map'));
    gMap.addControl(new GSmallMapControl());
    gMap.addControl(new GMapTypeControl());
    gMap.setCenter(point, zoom);
    gMap.setMapType(G_MAP_TYPE);
    var marker = new GMarker(point);
    gMap.addOverlay(marker);
    geocoder = new GClientGeocoder();
  }
}
") ?>
</head>
<body onload="load()" onunload="GUnload()">
<div id="map" style="width: 300px; height: 320px"></div>
<?php else: ?>
</head>
<body>
<div style="width: 300px; height: 320px"><div style="position: absolute; height: 30px; width: 180px; top: 50%; left: 50%; margin: -15px 0 0 -90px;"><?php echo __('google maps apikey or google ajax search apikey is empty') ?></div></div>
<?php endif; ?>
</body>
</html>
