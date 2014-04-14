<div class='battle'>
	<div class='<?= $you === $attack['id'] ? 'you' : 'opponent' ?>'>
		<?= $attack['username'] ?>の攻撃！
	</div>
	<div class='<?= $you === $defence['id'] ? 'you' : 'opponent' ?>'>
		<p><?= $defence['username'] ?>は<?= $defence['damage'] ?>のダメージをくらった！</p>
		<p>体力：<?= $defence['energy_before'] ?>→<?= $defence['energy'] ?></p>
	</div>
</div>
