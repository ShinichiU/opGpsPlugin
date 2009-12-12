<?php use_helper('opGps') ?>

<?php if (count($gpsList)): ?>
<div id="homeRecentList_<?php echo $gadget->getId() ?>" class="dparts homeRecentList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Recently Posted Foot path of All') ?></h3></div>
<div class="block">

<ul class="articleList">
<?php foreach ($gpsList as $gps): ?>
<li><?php echo op_gps_link_to_show($gps, true) ?> (<?php echo $gps->getCarrier() ?>)</li>
<?php endforeach; ?>
</ul>

<div class="moreInfo">
<ul class="moreInfo">
<li><?php echo link_to(__('More'), '@gps_list_member?id='.$memberId) ?></li>
</ul>
</div>

</div>
</div></div>
<?php endif; ?>
