<?= $this->element('../chats/add') ?>

<div id='messages'>
	<? foreach ($chats as $chat): ?>
		<?= $this->element(
			'message', 
			array(
				'user' => $chat['User'],
				'time' => $chat['Chat']['created'],
				'message' => $text->autoLink(h($chat['Chat']['message']))
			)
		) ?>
	<? endforeach ?>
</div>

<?= $paginator->numbers(true) ?>

<?= $html->css('message', null, array('inline' => false)) ?>