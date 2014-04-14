<div class='input clearfix'>
	<?= $form->label('image_id', '画像'); ?>
	<div class='switch data-input'>
		<div class='clearfix'>
			<p class='switch-trigger selected' name='default'>用意された画像から選ぶ</p>
			<p class='switch-trigger' name='upload'>アップロード画像から選ぶ</p>
		</div>
		<div class='switch-content default' name='default'>
			<?= $exform->imageSelector('image_id', $images, array(), 
				array('legend' => '　','line' => empty($line) ? 10 : $line)); ?>
		</div>
		<div class='switch-content' name='upload'>
			<?= $form->input('image_id', array('label' => false, 
				'type' => 'hidden', 'id' => 'imageId')) ?>
			<?= $html->image($image, array('id' => 'imagePreview', 'class' => 'user-image')) ?>
			<?= $html->link(
				'画像を選択してください。', 
				array('controller' => 'images', 'iframe' => true), 
				array('target' => '_blank', 'class' => 'window')
			) ?>
		</div>
	</div>
</div>
