<p><?php echo __('You can submit GPS Data') ?></p>
<?php $tag = $sf_data->getRaw('carrierGps')->getGPSLink(url_for('@gps_create', $isAbsoluteUrl), __('Send GPS Data')) ?>
<?php echo $tag['tag'] ?>
