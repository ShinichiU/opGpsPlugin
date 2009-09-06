<p><?php echo __('Your footprint on the earth') ?></p>
<br>
<p><?php echo __('You can submit GPS Data') ?></p>
<?php $tag = $carrierGps->getGPSLink(url_for('gps/index')) ?>
<form method="get" action="<?php echo $tag['url'] ?>">
<input type="submit" value="<?php echo __('Send GPS Data') ?>" />
</form>
