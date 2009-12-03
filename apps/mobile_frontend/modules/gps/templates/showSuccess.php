<?php op_mobile_page_title(__('Foot path of %1%', array('%1%' => $member->getName()))) ?>

<?php echo op_within_page_link() ?>
<?php echo op_format_date($memberGpsPosition->getCreatedAt(), 'XDateTime') ?>
<?php if ($memberGpsPosition->getMemberId() === $sf_user->getMemberId()): ?>
<form action="<?php echo url_for('gps_delete', $memberGpsPosition) ?>" method="post">
<?php echo $form[$form->getCSRFFieldName()] ?>
<input type="submit" value="<?php echo __('Delete') ?>"><br>
</form>
</div>
<?php endif; ?><br>

<?php $apikey = sfConfig::get('google_maps_api_key') ?>
<?php if (!empty($apikey)): ?>
<img src="http://maps.google.com/staticmap?center=<?php echo$memberGpsPosition->getLat() ?>,<?php echo$memberGpsPosition->getLon() ?>&zoom=15&size=220x220&maptype=mobile&markers=<?php echo$memberGpsPosition->getLat() ?>,<?php echo$memberGpsPosition->getLon() ?>,blueb&key=<?php echo $apikey ?>" />
<?php else: ?>
<?php echo __('empty google map api key.') ?>
<?php endif; ?>

<?php if ($memberGpsPosition->getPrevious($sf_user->getMemberId()) || $memberGpsPosition->getNext($sf_user->getMemberId())): ?>
<hr>
<center>
<?php if ($memberGpsPosition->getPrevious($sf_user->getMemberId())): ?> <?php echo link_to(__('Previous Foot Path'), 'gps_show', $memberGpsPosition->getPrevious($sf_user->getMemberId())) ?><?php endif; ?>
<?php if ($memberGpsPosition->getNext($sf_user->getMemberId())): ?> <?php echo link_to(__('Next Foot Path'), 'gps_show', $memberGpsPosition->getNext($sf_user->getMemberId())) ?><?php endif; ?>
</center>
<?php endif; ?>

<hr>
<?php echo link_to(__('Foot path of %1%', array('%1%' => $member->getName())), 'gps_list_member', $member) ?><br>
<?php if ($memberGpsPosition->getMemberId() !== $sf_user->getMemberId()): ?>
<?php echo link_to(__('Profile of %1%', array('%1%' => $member->getName())), 'member/profile?id='.$member->getId()) ?><br>
<?php endif; ?>
