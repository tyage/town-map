<hgroup>
	<?= $html->link('一覧に戻る', '/threads/') ?>
	<h1><?= h($thread['Thread']['title']) ?></h1>
</hgroup>

<div id='messages'>
	<? foreach ($responses as $response): ?>
		<?= $this->element(
			'message', 
			array(
				'user' => $response['User'],
				'time' => $response['Response']['created'],
				'message' => $text->autoLink(h($response['Response']['message']))
			)
		) ?>
	<? endforeach; ?>
</div>

<?= $paginator->numbers($paginatorOption) ?>

<?= $form->create('Response', array('action' => 'add')) ?>
<?= $form->hidden('Response.thread_id', array('value' => $thread['Thread']['id'])) ?>
<?= $form->input('Response.message', array('label' => '内容')) ?>
<?= $form->end('投稿') ?>

<?= $html->css('message', null, array('inline' => false)) ?>