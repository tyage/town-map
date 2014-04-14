<div class='user'>
	<p class='username'>
		<?= $this->User->image($user) ?>
		<?= $this->User->link($user) ?>
	</p>
	<dl class='user-data mini-list clearfix'>
		<dt>体力/最大</dt>
			<dd><?= $user['energy'] ?>/<?= $user['maxEnergy'] ?></dd>
		<dt>精神力/最大</dt>
			<dd><?= $user['spirit'] ?>/<?= $user['maxSpirit'] ?></dd>
		<? foreach (getSkills('all', true) as $skill => $ja): ?>
			<dt><?= $ja ?></dt>
				<dd><?= $user[$skill] ?></dd>
		<? endforeach ?>
	</dl>
</div>