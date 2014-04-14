<?= $html->link('掲示板に戻る', '/threads/view/'.$this->data['Response']['thread_id']) ?>

<?= $form->create() ?>
<?= $form->hidden('Response.thread_id') ?>
<?= $form->input('Response.message', array('label' => '内容')) ?>
<?= $form->end('投稿') ?>