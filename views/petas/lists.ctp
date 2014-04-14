<?= $this->element('../petas/add', array('house_id' => $house_id)) ?>

<div id='messages'>
	<? foreach ($petas as $peta): ?>
		<?= $this->element(
			'message', 
			array(
				'user' => $peta['User'],
				'time' => $peta['Peta']['created'],
				'message' => $text->autoLink(h($peta['Peta']['message']))
			)
		) ?>
	<? endforeach ?>
</div>

<?= $paginator->numbers(true) ?>

<?= $html->css('message', null, array('inline' => false)) ?>