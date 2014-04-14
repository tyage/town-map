<h1>画像アップローダー</h1>

<p><?= $html->link('アップロードする', '/images/add') ?></p>

<ul id='images' class='clearfix'>
	<? foreach ($images as $image): ?>
		<li>
			<?= $html->image(
				'upload'.DS.'thumb.medium.'.$image['Image']['filename'],
				array(
					'url' => array('action' => 'view', $image['Image']['id'])
				)
			) ?>
		</li>
	<? endforeach ?>
</ul>

<?= $paginator->numbers(true) ?>

<?= $html->css('images/index', null, array('inline' => false)) ?>