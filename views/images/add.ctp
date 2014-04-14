<h1>画像アップローダー</h1>

<?= $form->create('Image', array('type' => 'file')); ?>
<?= $form->input('Image.filename', array('type' => 'file', 'label' => '画像')) ?>
<?= $form->end('アップロード') ?>