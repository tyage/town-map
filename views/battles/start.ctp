<div id='battleWindow'>
	<h1>相手の確認</h1>

	<div id='users' class='clearfix'>
		<?= $this->element('user_battle', array('user' => $Self->data['User'])) ?>
		<p id='vs'>VS</p>
		<?= $this->element('user_battle', array('user' => $opponent['User'])) ?>
	</div>

	<br>

	<nav id='command'>
		<header>
			<h2>どうする？</h2>
		</header>
		
		<ul id='command-list' class='clearfix'>
			<li><?= $html->link('戦う', '/battles/start/'.$opponent['User']['id'].'/true') ?></li>
			<li><?= $html->link('やめる', '/') ?></li>
		</ul>
	</nav>
</div>

<?= $html->css('battles/common', null, array('inline' => false)) ?>