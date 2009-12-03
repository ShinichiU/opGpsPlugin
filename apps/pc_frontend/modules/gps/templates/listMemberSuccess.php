<?php use_helper('opGps'); ?>

<?php if ($sf_user->getMemberId() === $member->getId()): ?>
<?php if ($carrier == 'iPhone'): ?>
<?php use_javascript('/opGpsPlugin/js/iPhone.js') ?>
<form method="post" action="<?php echo url_for('@gps_create', true) ?>">
<input type="hidden" value=""  id="latValue" name="lat" />
<input type="hidden" value="" id="lonValue" name="lon" />
<input type="submit" class="input_submit" value="<?php echo __('Send') ?>" />
</form>
<?php elseif ($carrier == 'Android'): ?>
your mobile is Android
<?php endif; ?>
<?php endif; ?>

<?php if ($pager->getNbResults()): ?>
<div class="dparts recentList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Foot path of %1%', array('%1%' => $member->getName())) ?></h3></div>
<?php echo op_include_pager_navigation($pager, 'gps/listMember?page=%d&id='.$member->getId()) ?>
<?php foreach ($pager->getResults() as $position): ?>
<dl>
<dt><?php echo op_format_date($position->getCreatedAt(), 'XDateTimeJa') ?></dt>
<dd><?php echo op_gps_link_to_show($position, true) ?></dd>
</dl>
<?php endforeach; ?>
<?php echo op_include_pager_navigation($pager, 'gps/listMember?page=%d&id='.$member->getId()) ?>
</div></div>
<?php else: ?>
<?php op_include_box('gpsList', __('There are no foot path.'), array('title' => 'gps path')) ?>
<?php endif; ?>
