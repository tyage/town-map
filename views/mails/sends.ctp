<hgroup id='mail-header' class='clearfix'>
	<h1>送信BOX</h1>
	<h2><?= $html->link('受信BOX', array('controller' => 'mails', 'action' => 'receives')) ?></h2>
</hgroup>

<?= $this->element('../mails/add') ?>

<?= $this->element('mail', array('mails' => $sends, 'box' => 'send')) ?>

<?= $paginator->numbers(true) ?>

<?= $html->css('mails/list', null, array('inline' => false)) ?>