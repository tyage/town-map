<div id='map'></div>

<?= $html->css('map', null, array('inline' => false)) ?>
<?= $html->css('maps/index', null, array('inline' => false)) ?>
<?= $html->script('map', array('inline' => false)) ?>
<? if (!empty($Self->id)): ?>
	<?= $html->script('maps/index', array('inline' => false)) ?>
<? endif ?>