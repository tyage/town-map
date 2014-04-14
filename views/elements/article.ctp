<article class='article'>
	<h2 class='article-title'>
		<?= $html->link($article['Article']['title'], '/articles/view/'.$article['Article']['id']) ?>
	</h2>
	<? 
		if (!empty($lists)) {
			$article['Article']['body'] = $text->truncate($article['Article']['body'], 100, array('ending' => '...'));
		}
	?>
	<pre><?= h($article['Article']['body']) ?></pre>
	<div class="info">
		<time class='created'><?= $article['Article']['created'] ?></time>
		<p class='comment'>
			<? $count = $this->requestAction('/comments/count/'.$article['Article']['id']) ?>
			<?= $html->link('コメント('.$count.')', '/articles/view/'.$article['Article']['id'].'#comment') ?>
		</p>
	</div>
</article>