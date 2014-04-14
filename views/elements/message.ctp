<div class='message clearfix'>
	<div class='message-image'>
		<?= $this->User->image($user) ?>
	</div>
	<div class='message-content'>
		<header class='message-header'>
			<span class='message-username'><?= $this->User->link($user) ?></span>
			<time class='message-time'><?= $time ?></time>
		</header>
		<pre class='message-body'><?= $message ?></pre>
	</div>
</div>