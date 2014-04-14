<p><?= $html->link('一覧に戻る', array('action' => 'index')) ?></p>
<br>

<p>
	<a id='select' href='#select'>この画像に設定する</a>
</p>
<br>

<p>
	<? $imagePath = 'upload'.DS.$image['Image']['filename'] ?>
	<?= $html->image($imagePath, array('class' => 'em', 'id' => 'image')) ?>
</p>
<br>

<dl class='mini-list clearfix'>
	<dt>ID</dt>
		<dd id='imageId'><?= $image['Image']['id'] ?></dd>
	<dt>投稿者</dt>
		<dd><?= $user->link($image['User']) ?></dd>
	<dt>ファイル名（アイコン用）</dt>
		<dd><?= $image['Image']['filename'] ?></dd>
	<dt>種類</dt>
		<dd><?= $image['Image']['mimetype'] ?></dd>
	<dt>サイズ</dt>
		<dd><?= $image['Image']['filesize'] ?>bytes</dd>
	<dt>作成日</dt>
		<dd><?= $image['Image']['created'] ?></dd>
</dl>

<? $html->script('images/view', array('inline' => false)) ?>