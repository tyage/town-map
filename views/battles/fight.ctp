<div id='battleWindow'>
	<h1><?= $opponent['User']['username'] ?>とバトル</h1>

	<div id='users' class='clearfix'>
		<?= $this->element('user_battle', array('user' => $Self->data['User'])) ?>
		<p id='vs'>VS</p>
		<?= $this->element('user_battle', array('user' => $opponent['User'])) ?>
	</div>

	<? if (!empty($turn1)): ?>
		<?= $this->element('battle', array(
			'attack' => $turn1['attack'],
			'defence' => $turn1['defence'],
				'you' => $Self->id
		)) ?>
	<? endif ?>
	<? if (!empty($turn2)): ?>
		<?= $this->element('battle', array(
			'attack' => $turn2['attack'],
			'defence' => $turn2['defence'],
			'you' => $Self->id
		)) ?>
	<? endif ?>

	<? if (!empty($win)): ?>
		<div class='battle system'>
			<p>勝利しました！</p>
			<p>賞金<?= $money ?>円を得ました！</p>
		</div>
	<? elseif (!empty($lose)): ?>
		<p class='battle system'>負けました・・・</p>
	<? else: ?>
		<nav id='command'>
			<header>
				<h2>どうする？</h2>
			</header>
			
			<ul id='command-list' class='clearfix'>
				<li><?= $html->link('攻撃', '/battles/fight/attack') ?></li>
				<li><strike><?= $html->link('技', '/battles/fight/skill') ?></strike></li>
				<li><strike><?= $html->link('防御', '/battles/fight/defend') ?></strike></li>
				<li><?= $html->link('逃げる', '/battles/fight/escape') ?></li>
				<li><?= $html->link('更新', '/battles/fight/') ?></li>
			</ul>
		</nav>
	<? endif ?>
</div>

<?= $html->css('battles/common', null, array('inline' => false)) ?>