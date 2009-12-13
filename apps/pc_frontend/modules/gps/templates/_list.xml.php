<?php echo '<?xml version="1.0" encoding="utf-8"?>'."\n" ?>
<?php use_helper('opGps'); ?>
<data>
<?php if ($pager->getNbResults()): ?>
<?php foreach ($pager->getResults() as $position): ?>
<?php $params = op_calc_gcs_change($position) ?>
  <item id="<?php echo $position->getId() ?>">
    <lat><?php echo $params['lat'] ?></lat>
    <lon><?php echo $params['lon'] ?></lon>
    <location><?php echo $position->getLocation() ?></location>
    <carrier><?php echo $position->getCarrier() ?></carrier>
    <member>
      <id><?php echo $position->getMember()->getId() ?></id>
      <name><?php echo $position->getMember()->getName() ?></name>
      <imageTag><?php echo image_tag_sf_image($position->getMember()->getImageFilename(), array('size' => '76x76')) ?></imageTag>
      <url><?php echo url_for('member/profile?id='.$position->getMember()->getId(), true) ?></url>
    </member>
  </item>
<?php endforeach; ?>
<?php endif; ?>
  <myid><?php echo $sf_user->getMemberId() ?></myid>
</data>
