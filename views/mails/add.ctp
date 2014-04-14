<?= $form->create('Mail', array('action' => 'add')) ?>
<?= $form->input('User.username', array('label' => '宛先')) ?>
<?= $form->input('Mail.title', array('label' => '件名')) ?>
<?= $form->input('Mail.message', array('label' => 'メッセージ')) ?>
<?= $form->end('送信') ?>