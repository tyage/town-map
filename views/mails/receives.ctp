<hgroup id='mail-header' class='clearfix'>
	<h1>受信BOX</h1>
	<h2><?= $html->link('送信BOX', array('controller' => 'mails', 'action' => 'sends')) ?></h2>
</hgroup>

<?= $this->element('../mails/add') ?>

<?= $this->element('mail', array('mails' => $receives, 'box' => 'receive')) ?>

<?= $paginator->numbers(true) ?>

<?= $html->css('mails/list', null, array('inline' => false)) ?>