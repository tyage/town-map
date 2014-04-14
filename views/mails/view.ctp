<nav id='mail-nav'>
	<?= $html->link('受信BOX', array('controller' => 'mails', 'action' => 'receives')) ?>
	<?= $html->link('送信BOX', array('controller' => 'mails', 'action' => 'sends')) ?>
</nav>

<header id='mail'>
	<hgroup id='mail-title'>
		<h1><?= h($mail['Mail']['title']) ?></h1>
		<time><?= $mail['Mail']['created'] ?></time>
	</hgroup>
	
	<div id='mail-users' class='clearfix'>
		<div class='mail-user'>
			<?= $user->image($mail['From']) ?>
			<?= $user->link($mail['From']) ?>
		</div>
		<div class='mail-user'>
			<span>→</span>
			<?= $user->image($mail['To']) ?>
			<?= $user->link($mail['To']) ?>
		</div>
	</div>
</header>

<hr>

<pre id='mail-message'>
<?= $text->autoLink(h($mail['Mail']['message'])) ?>
</pre>

<?= $html->css('mails/view', null, array('inline' => false)) ?>