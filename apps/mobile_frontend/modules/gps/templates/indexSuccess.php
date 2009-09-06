<html>
<head>
</head>
<body>
<?php if ($ua->isDocomo()): ?>
<form method="post" action="<?php echo url_for('gps') ?>" lcs>
<?php elseif ($ua->isSoftBank()): ?>
<form method="post" action="location:auto?url=<?php echo url_for('gps') ?>">
<?php elseif ($ua->isEZweb()): ?>
<form method="post" action="device:gpsone?url=<?php echo url_for('gps') ?>">
<?php endif; ?>
<input type="submit" name="navi_pos" value="位置情報の取得">
</form>
</body>
</html>
