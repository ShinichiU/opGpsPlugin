<?php use_helper('opGps') ?>

<div class="dparts gpsDetailBox"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Footpath of %1% in %2%', array('%1%' => $member->getName(), '%2%' => op_format_date($memberGpsPosition->getCreatedAt(), 'XDateTimeJaBr'))) ?></h3></div>

<?php if ($memberGpsPosition->getPrevious($sf_user->getMemberId()) || $memberGpsPosition->getNext($sf_user->getMemberId())): ?>
<div class="block prevNextLinkLine">
<?php if ($memberGpsPosition->getPrevious($sf_user->getMemberId())): ?>
<p class="prev"><?php echo link_to(__('Previous Footpath'), 'gps_show', $memberGpsPosition->getPrevious($sf_user->getMemberId())) ?></p>
<?php endif; ?>
<?php if ($memberGpsPosition->getNext($sf_user->getMemberId())): ?>
<p class="next"><?php echo link_to(__('Next Footpath'), 'gps_show', $memberGpsPosition->getNext($sf_user->getMemberId())) ?></p>
<?php endif; ?>
</div>
<?php endif; ?>

<div class="title">
<p class="heading"><?php printf('%s (%s)', $memberGpsPosition->getLocation(), $memberGpsPosition->getCarrier()) ?></p>
</div>
<div class="body">
<?php echo op_generate_google_cmd($memberGpsPosition) ?>
<br /><a href="<?php echo op_gps_generate_url($memberGpsPosition, 1) ?>" target="_blank"><?php echo __('Show Google Map') ?></a>
<br /><a href="<?php echo op_gps_generate_url($memberGpsPosition, 2) ?>" target="_blank"><?php echo __('Show Yahoo Map') ?></a>
</div>
</dd>
</dl>
<?php if ($memberGpsPosition->getMemberId() === $sf_user->getMemberId()): ?>
<div class="operation">
<?php echo $form->renderFormTag(url_for('gps_delete', $memberGpsPosition)); ?>
<?php echo $form ?>
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="<?php echo __('delete this foot path') ?>" /></li>
</ul>
</form>
</div>
<?php endif; ?>
</div></div>
