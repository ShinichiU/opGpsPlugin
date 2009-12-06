<?php use_helper('opGps') ?>
<?php if (count($recentGpsList)): ?>
<ul>
<?php foreach ($recentGpsList as $_gps): ?>
<li><?php echo op_gps_link_to_show($_gps, true) ?> (<?php echo $_gps->getCarrier() ?>)</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
