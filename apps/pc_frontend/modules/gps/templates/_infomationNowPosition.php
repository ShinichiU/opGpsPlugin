<?php if (count($recentGpsList)): ?>
<ul>
<?php foreach ($recentGpsList as $_gps): ?>
<li><?php echo op_gps_link_to_show($position, true) ?> (<?php echo $_gps->getCarrier() ?>)</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
