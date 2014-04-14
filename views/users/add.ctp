<?= $form->create(); ?>
<?= $form->input('User.username',array('label' => '名前')); ?>
<?= $form->input('User.password',array('label' => 'パスワード')); ?>
<?= $form->input('User.sex',array('label' => '性別','options' => array('男','女'))); ?>
<?= $form->end('登録'); ?>