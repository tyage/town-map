<!DOCTYPE html>
<html lang='ja'>
	<head>
		<meta charset="UTF-8">
		<title><?= $title_for_layout; ?></title>
		
		<?= $html->css('reset'); ?>
		<?= $html->css('default'); ?>
		<?= $html->css('iframe'); ?>
		
		<?= $html->script('html5'); ?>
		<?= $html->script('cssua'); ?>
		<?= $html->script('http://www.google.com/jsapi'); ?>
		<script type="text/javascript">
			google.load('jquery', '1');
		</script>
		<?= $scripts_for_layout ?>
		<?= $html->script('common'); ?>
	</head>
	<body>
		<div id='Content'>
			<?= $this->Session->flash() ?>
			<?= $content_for_layout ?>
		</div>
	</body>
</html>