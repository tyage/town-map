<!DOCTYPE html>
<html lang='ja'>
	<head>
		<meta charset="UTF-8">
		<title><?= $title_for_layout; ?></title>
		<?= $html->meta('icon'); ?>
		
		<?= $html->css('reset'); ?>
		<?= $html->css('default'); ?>
		<?= $html->css('jquery.pnotify.default.css'); ?>
		<?= $html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css'); ?>
		
		<?= $html->script('html5'); ?>
		<?= $html->script('cssua'); ?>
		<?= $html->script('http://www.google.com/jsapi'); ?>
		<script type="text/javascript">
			google.load('jquery', '1');
		</script>
		<?= $html->script('common'); ?>
		<?= $html->script('jquery.pnotify.min.js'); ?>
		<?= $html->script('sidebar'); ?>
		<? if (!empty($Self->id)): ?>
			<?= $html->script('mails/check'); ?>
			<?= $html->script('users/recover'); ?>
		<? endif ?>
		<?= $scripts_for_layout ?>
	</head>
	<body>
		<header id='Header' class='clearfix'>
			<h1 id='HeaderLogo'>
				<?= $html->link($title_for_layout, '/') ?>
			</h1>
			
			<nav id='HeaderNav'>
				<ul class='clearfix'>
					<? if (!empty($Self->id)): ?>
						<li><?= $html->link('ログアウト', '/users/logout') ?></li>
					<? else: ?>
						<li><?= $html->link('ユーザー登録', '/users/add') ?></li>
						<li><?= $html->link('ログイン', '/users/login') ?></li>
					<? endif ?>
				</ul>
			</nav>
		</header>

		<section id='Side'>
			<div id='SideContent'>
				<p id='SideLoading'>更新中...</p>
				<iframe id='SideFrame'></iframe>
			</div>
			<nav id='Sidebar'>
				<? if (!empty($Self->id)): ?>
					<ul>
						<li>
							<?= $html->image(
								$Self->image, 
								array('url' => '/iframe/users/view/'.$Self->id, 'class' => 'user-image')
							); ?>
						</li>
						<li>
							<?= $html->image('item.gif', array('url' => '/iframe/items_users/')); ?>
						</li>
						<li>
							<?= $html->image('mail.gif', array('url' => '/iframe/mails/receives/')); ?>
							<div id='MailCheck'>
								<div class='popup'>
									<p class='popup-text text'></p>
									<span class='popup-arrow'></span>
								</div>
							</div>
						</li>
						<li>
							<?= $html->image('chat.gif', array('url' => '/iframe/chats/index/')); ?>
						</li>
						<li>
							<?= $html->image('config.gif', array('url' => '/iframe/users/edit/')); ?>
						</li>
					</ul>
				<? endif ?>
			</nav>
		</section>

		<div id='Content'>
			<?= $this->Session->flash() ?>
			<?= $content_for_layout ?>
		</div>

		<footer></footer>

		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>