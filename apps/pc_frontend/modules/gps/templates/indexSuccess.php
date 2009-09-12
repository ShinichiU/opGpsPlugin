<?php if ($carrier == 'iPhone'): ?>
<?php use_javascript('/opGpsPlugin/js/iPhone.js') ?>
<form method="post" action="<?php echo url_for('@gps_send', true) ?>">
<input type="hidden" value=""  id="latValue" name="lat" />
<input type="hidden" value="" id="lonValue" name="lon" />
<input type="submit" class="input_submit" value="<?php echo __('Send') ?>" />
</form>
<?php elseif ($carrier == 'Android'): ?>
your mobile is Android
<?php endif; ?>
