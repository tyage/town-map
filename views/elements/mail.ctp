<table id='mail-list'>
	<thead>
		<tr>
			<th><?= $box === 'receive' ? '差出人' : '宛先' ?></th>
			<th>件名</th>
			<th>日付</th>
			<th>未読</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($mails as $mail): ?>
			<? $user = ($box === 'receive' ? $mail['From'] : $mail['To']) ?>
			<tr>
				<td><?= $this->User->image($user) ?><?= $this->User->link($user) ?></td>
				<td><?= $html->link($mail['Mail']['title'], array('controller' => 'mails', 'action' => 'view', $mail['Mail']['id'])) ?></td>
				<td><?= $mail['Mail']['created'] ?></td>
				<td><?= $mail['Mail']['read'] ? '' : '未読' ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>