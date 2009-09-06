<h3><?php echo __('You can submit GPS Data') ?></h3>
<?php $tag = $carrierGps->getGPSLink(url_for('gps/index')) ?>
<form method="get" action="<?php echo $tag['url'] ?>">
<input type="submit" value="<?php echo __('Send GPS Data') ?>" />
</form>
