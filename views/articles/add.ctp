<?= $form->create('Article', array('action' => 'add')) ?>
<?= $form->input('Article.title', array('label' => 'タイトル')) ?>
<?= $form->input('Article.body', array('label' => '内容')) ?>
<?= $form->submit('投稿') ?>