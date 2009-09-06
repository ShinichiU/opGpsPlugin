<?php if (count($recentGpsList)): ?>
<div class="dparts homeRecentList" style="position: relative;">
<div class="parts">
<div class="partsHeading"><h3><?php echo __('Foot History') ?></h3></div>
<div class="block">
<ul class="articleList">
<?php foreach ($recentGpsList as $_gps): ?>
<li>
<span class="date"><?php echo $_gps->getCreatedAt() ?></span>
<a href="http://map.yahoo.co.jp/pl?&amp;mode=map&amp;type=scroll&amp;sc=7&amp;lat=<?php echo $_gps->getLat() ?>&amp;lon=<?php echo $_gps->getLon() ?>" target="_blank"><?php echo __('I\'m Here') ?></a> (<?php echo $_gps->getCarrier() ?>)
</li>
<?php endforeach; ?>
</ul>
</div>

<div class="moreInfo">
<ul class="moreInfo">
<li><a href="#"><?php echo __('More') ?></a></li>
</ul>
</div>
</div>
</div>
<?php endif; ?>
