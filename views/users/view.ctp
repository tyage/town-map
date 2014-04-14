<h2>
	<?= $html->image($user['User']['image'], array('class' => 'user-image')) ?>
	<?= $user['User']['username'] ?>
</h2>

<dl class='mini-list clearfix'>
	<dt>名前</dt>
		<dd><?= $user['User']['username'] ?></dd>
	<dt>ID</dt>
		<dd><?= $user['User']['id'] ?></dd>
	<dt>メール</dt>
		<dd><?= $user['User']['email'] ?></dd>
	<dt>性別</dt>
		<dd><?= $user['User']['sex'] ?></dd>
	<dt>誕生日</dt>
		<dd><?= $user['User']['born'] ?></dd>
	<dt>所持金</dt>
		<dd><?= $user['User']['money'] ?>円</dd>
	<dt>身長</dt>
		<dd><?= $user['User']['height'] ?>cm</dd>
	<dt>体重</dt>
		<dd><?= $user['User']['weight'] ?>kg</dd>
	<dt>BMI</dt>
		<dd><?= $user['User']['bmi'] ?></dd>
	<dt>最終更新</dt>
		<dd><?= $user['User']['updated'] ?></dd>
	<dt>体力/最大</dt>
		<dd><?= $user['User']['energy'] ?>/<?= $user['User']['maxEnergy'] ?></dd>
	<dt>精神力/最大</dt>
		<dd><?= $user['User']['spirit'] ?>/<?= $user['User']['maxSpirit'] ?></dd>
	<? foreach (getSkills('all', true) as $skill => $ja): ?>
		<dt><?= $ja ?></dt>
			<dd><?= $user['User'][$skill] ?></dd>
	<? endforeach ?>
</dl>