<?php if ($carrier == 'iPhone'): ?>
your mobile is iPhone
<script type="text/javascript">
//<![CDATA[
window.onload = function(){
    navigator.geolocation.watchPosition(update);
}
function update(position){
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    var acc = position.coords.accuracy;
}
//]]>
</script>
<?php elseif ($carrier == 'Android'): ?>
your mobile is Android
<?php endif; ?>
