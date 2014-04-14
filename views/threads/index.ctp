<h1>掲示板</h1>

<table>
	<thead>
		<tr>
			<th><?= $paginator->sort('作成者', 'Thread.user_id') ?></th>
			<th><?= $paginator->sort('タイトル', 'Thread.title') ?></th>
			<th><?= $paginator->sort('更新日', 'Thread.updated') ?></th>
			<th><?= $paginator->sort('作成日', 'Thread.created') ?></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($threads as $thread): ?>
			<tr>
				<td>
					<?= $user->image($thread['User']) ?>
					<?= $user->link($thread['User']) ?>
				</td>
				<td><?= $html->link($thread['Thread']['title'], '/threads/view/'.$thread['Thread']['id']) ?></td>
				<td><?= $thread['Thread']['updated'] ?></td>
				<td><?= $thread['Thread']['created'] ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>

<?= $form->create('Thread', array('action' => 'add')) ?>
<?= $form->input('Thread.title', array('label' => 'タイトル')) ?>
<?= $form->end('作成') ?>