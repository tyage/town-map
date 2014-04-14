<?= $form->create('Peta', array('action' => 'add')) ?>
<?= $form->input('Peta.house_id', array('type' => 'hidden', 'value' => $house_id)) ?>
<?= $form->input('Peta.message', array('div' => false, 'label' => false)) ?>
<?= $form->submit('投稿', array('div' => false)) ?>
<?= $form->end() ?>