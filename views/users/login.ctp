<h1>ログイン</h1>

<?= $form->create() ?>
<?= $form->input('User.username', array('label' => 'ユーザー名')) ?>
<?= $form->input('User.password', array('label' => 'パスワード')) ?>
<?= $form->end('ログイン') ?>