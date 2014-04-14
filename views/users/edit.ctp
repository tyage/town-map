<?= $form->create('User', array(array('type' => 'file'))); ?>
<?= $form->input('User.username',array('label' => '名前')); ?>
<?= $form->input('User.email', array('label' => 'Eメール')) ?>
<div class='input clearfix'>
	<?= $form->label('User.born','誕生日'); ?>
	<div class='data-input'>
		<?= $form->year('User.born',date('Y') - 100,date('Y'),NULL,array('empty' => false)); ?>年
		<?= $form->month('User.born',NULL,array('monthNames' => false,'empty' => false)); ?>月
		<?= $form->day('User.born',NULL,array('empty' => false)); ?>日
	</div>
</div>
<?= $this->element('image_select', array('images' => $images, 'line' => 7, 'image' => $Self->image)) ?>
<?= $form->end('編集') ?>