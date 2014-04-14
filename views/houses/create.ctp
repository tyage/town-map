<div id="mapWrapper">
	<p class='lite-title'>マーカーをドラッグ＆ドロップして建設位置を選択してください。</p>
	<div id='map'></div>
</div>

<?= $form->create() ?>
<?= $form->input('House.lat', array('label' => '緯度', 
	'readonly' => true, 'value' => $Self->lat)) ?>
<?= $form->input('House.lng', array('label' => '経度', 
	'readonly' => true, 'value' => $Self->lng)) ?>
<? $images = $this->requestAction('houses/images') ?>
<?= $this->element('image_select', array('images' => $images, 'image' => null)) ?>
<?= $form->end('建設する') ?>

<?= $html->css('map', null, array('inline' => false)) ?>
<?= $html->css('houses/create', null, array('inline' => false)) ?>
<?= $html->script('map', array('inline' => false)) ?>
<?= $html->script('houses/create', array('inline' => false)) ?>