<?= $form->create('Comment', array('action' => 'add')) ?>
<? 
$option = !empty($article_id) ? 
	array('value' => $article_id, 'type' => 'hidden') : 
	array('type' => 'hidden') 
?>
<?= $form->input('Comment.article_id', $option) ?>
<?= $form->input('Comment.message', array('label' => 'メッセージ')) ?>
<?= $form->submit('投稿') ?>