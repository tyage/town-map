<?= $form->create('Chat', array('action' => 'add')) ?>
<?= $form->input('Chat.message', array('div' => false, 'label' => false)) ?>
<?= $form->submit('投稿', array('div' => false)) ?>
<?= $form->end() ?>