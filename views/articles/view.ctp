<nav>
	<?= $html->link('記事一覧', 
		'/articles/lists/'.$article['Article']['user_id']) ?>
</nav>

<?= $this->element('article', array('article' => $article)) ?>

<div id='comment'>
	<h2><?= $html->link('コメント', '#comment', array('name' => 'comment')) ?></h2>
	<?= $this->element('../comments/add', array('article_id' => $article['Article']['id'])) ?>

	<div id='messages'>
		<? foreach ($comments as $comment): ?>
			<?= $this->element(
				'message', 
				array(
					'user' => $comment['User'],
					'time' => $comment['Comment']['created'],
					'message' => $text->autoLink(h($comment['Comment']['message']))
				)
			) ?>
		<? endforeach ?>
	</div>

	<?= $paginator->numbers(array('model' => 'Comment')) ?>
</div>

<?= $html->css('message', null, array('inline' => false)) ?>