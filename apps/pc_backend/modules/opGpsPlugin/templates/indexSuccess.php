<?php $form->getWidget('google_maps_api_key')->setAttribute('style', 'width: 660px') ?>
<?php $form->getWidget('google_ajax_search_api_key')->setAttribute('style', 'width: 660px') ?>

<h2><?php echo __('GPS Plugin 設定') ?></h2>

<form action="<?php url_for('opGpsPlugin/index') ?>" method="post">
<table>
<?php echo $form ?>
<tr>
<td colspan="2"><input type="submit" value="<?php echo __('変更') ?>" /></td>
</tr>
</table>
</form>
