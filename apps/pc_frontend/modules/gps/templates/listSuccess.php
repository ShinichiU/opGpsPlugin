<?php use_helper('opGps', 'opJavascript') ?>

<?php if ($googleMapsApiKey): ?>
<?php use_javascript('/opGpsPlugin/js/swfobject2') ?>
<?php echo javascript_tag("
  var params = {'allowfullscreen': true};
  var flashvars = {'key': '".$googleMapsApiKey."', 'xml': '".url_for('gps_list_xml')."'};
  swfobject.embedSWF('".url_for('/opGpsPlugin/swf/googlemap.swf')."', 'flashobj', '600', '450', '9.0.0', '', flashvars, params);
") ?>
<div style="height: 460px;">
<div id="flashobj">
Flash が見れない人用のJavascrptのGooglemap
</div>
</div>
<?php elseif ($pager->getNbResults()): ?>
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Foot path list') ?></h3></div>
<?php echo op_include_pager_navigation($pager, 'gps/list?page=%d'); ?>
<div class="block">
<?php foreach ($pager->getResults() as $position): ?>
<div class="ditem"><div class="item"><table><tbody><tr>
<td rowspan="4" class="photo"><a href="<?php echo url_for('gps_show', $position) ?>"><?php echo image_tag_sf_image($position->getMember()->getImageFilename(), array('size' => '76x76')) ?></a></td>
<th><?php echo __('%Nickname%') ?></th><td><?php echo $position->getMember()->getName() ?></td>
</tr><tr>
<th><?php echo __('position') ?></th><td><?php echo op_gps_link_to_show($position, true) ?></td>
</tr><tr class="operation">
<th><?php echo __('Foot path Created at') ?></th><td><span class="text"><?php echo op_format_date($position->getCreatedAt(), 'XDateTimeJa') ?></span> <span class="moreInfo"><?php echo link_to(__('View this foot path'), 'gps_show', $position) ?></span></td>
</tr></tbody></table></div></div>
<?php endforeach; ?>
</div>
<?php echo op_include_pager_navigation($pager, 'gps/list?page=%d'); ?>
</div></div>
<?php else: ?>
<?php op_include_box('gpsList', __('There are no foot path.'), array('title' => 'gps path')) ?>
<?php endif; ?>
