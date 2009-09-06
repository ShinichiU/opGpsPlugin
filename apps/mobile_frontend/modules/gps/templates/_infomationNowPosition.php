<?php if (count($recentGpsList)): ?>
<ul>
<?php foreach ($recentGpsList as $_gps): ?>
<li>
<a href="http://map.yahoo.co.jp/pl?&amp;mode=map&amp;type=scroll&amp;sc=7&amp;lat=<?php echo $_gps->getLat() ?>&amp;lon=<?php echo $_gps->getLon() ?>" target="_blank"><?php echo __('I\'m Here') ?></a> (<?php echo $_gps->getCarrier() ?>)
<?php echo $_gps->getCreatedAt() ?></span>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
