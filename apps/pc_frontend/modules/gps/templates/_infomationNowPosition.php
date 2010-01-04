<?php use_helper('opGps') ?>
<?php if (count($recentGpsList)): ?>
<ul>
<?php foreach ($recentGpsList as $_gps): ?>
<li><?php echo op_gps_link_to_show($_gps, true) ?> (<?php echo $_gps->getCarrier() ?>)</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php if ('iPhone' == $carrier || 'Android' == $carrier): ?>
<ul><li><?php echo link_to(__('You can send GPS Data.'), 'gps/new') ?></li></ul>
<?php endif; ?>
