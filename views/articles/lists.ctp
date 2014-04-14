<h1><?= $author['User']['username'] ?>のブログ</h1>

<? if ($isAuthor): ?>
	<?= $this->element('../articles/add') ?>
<? endif ?>

<nav class='paginator'>
	<?= $paginator->numbers(true) ?>
</nav>

<? foreach ($articles as $article): ?>
	<?= $this->element('article', array('article' => $article, 'lists' => true)) ?>
<? endforeach ?>

<nav class='paginator'>
	<?= $paginator->numbers(true) ?>
</nav>