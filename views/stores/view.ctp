<nav>
	<?= $html->link('家に戻る', array('controller' => 'houses', 'action' => 'view', $store['House']['id'])) ?>
</nav>

<h1><?= $store['User']['username'] ?>の倉庫</h1>

<? $skills = getSkills('all', true) ?>

<div class='switch data-input'>
	<div class='clearfix'>
		<p class='switch-trigger selected' name='store'>倉庫アイテム</p>
		<p class='switch-trigger' name='user'>手持ちアイテム</p>
	</div>
	<div class='switch-content default' name='store'>
		<table>
			<thead>
				<tr>
					<th></th>
					<th><?= $paginator->sort('アイテム', 'Item.name') ?></th>
					<th>金額<?//= $paginator->sort('金額', 'ItemsStore.price') ?></th>
					<th>残り<?//= $paginator->sort('残り', 'ItemsStore.life') ?></th>
					<th><?= $paginator->sort('間隔', 'Item.interval') ?></th>
					<th><?= $paginator->sort('説明', 'Item.description') ?></th>
					<th><?= $paginator->sort('身長', 'Item.height') ?></th>
					<th><?= $paginator->sort('体重', 'Item.weight') ?></th>
					<th><?= $paginator->sort('特殊', 'Item.special') ?></th>
					<th><?= $paginator->sort('身体', 'Item.energy') ?></th>
					<th><?= $paginator->sort('精神', 'Item.spirit') ?></th>
					<? foreach ($skills as $skill => $ja): ?>
						<th><?= $paginator->sort($ja, 'Item.'.$skill) ?></th>
					<? endforeach ?>
				</tr>
			</thead>
			<tbody>
				<? foreach ($storeItems as $item): ?>
					<tr>
						<td><?= $html->link('出す', array('action' => 'out', 
							$item['ItemsStore']['id'])) ?></td>
						<td><?= $item['Item']['name'] ?></td>
						<td><?= $item['ItemsStore']['price'] ?>円</td>
						<td><?= $item['ItemsStore']['life'] ?>回</td>
						<td><?= $item['Item']['interval'] ?>秒</td>
						<td><?= $item['Item']['description'] ?></td>
						<td><?= $item['Item']['height'] ?>cm</td>
						<td><?= $item['Item']['weight'] ?>kg</td>
						<td><?= $item['Item']['special'] ?></td>
						<td><?= $item['Item']['energy'] ?></td>
						<td><?= $item['Item']['spirit'] ?></td>
						<? foreach ($skills as $skill => $ja): ?>
							<td><?= $item['Item'][$skill] ?></td>
						<? endforeach ?>
					</tr>
				<? endforeach ?>
			</tbody>
		</table>
	</div>
	<div class='switch-content' name='user'>
		<table>
			<thead>
				<tr>
					<th></th>
					<th><?= $paginator->sort('アイテム', 'Item.name') ?></th>
					<th>金額<?//= $paginator->sort('金額', 'ItemsUser.price') ?></th>
					<th>残り<?//= $paginator->sort('残り', 'ItemsUser.life') ?></th>
					<th><?= $paginator->sort('間隔', 'Item.interval') ?></th>
					<th><?= $paginator->sort('説明', 'Item.description') ?></th>
					<th><?= $paginator->sort('身長', 'Item.height') ?></th>
					<th><?= $paginator->sort('体重', 'Item.weight') ?></th>
					<th><?= $paginator->sort('特殊', 'Item.special') ?></th>
					<th><?= $paginator->sort('身体', 'Item.energy') ?></th>
					<th><?= $paginator->sort('精神', 'Item.spirit') ?></th>
					<? foreach ($skills as $skill => $ja): ?>
						<th><?= $paginator->sort($ja, 'Item.'.$skill) ?></th>
					<? endforeach ?>
				</tr>
			</thead>
			<tbody>
				<? foreach ($userItems as $item): ?>
					<tr>
						<td><?= $html->link('入れる', array('action' => 'in', 
							$store['Store']['id'], $item['ItemsUser']['id'])) ?></td>
						<td><?= $item['Item']['name'] ?></td>
						<td><?= $item['ItemsUser']['price'] ?>円</td>
						<td><?= $item['ItemsUser']['life'] ?>回</td>
						<td><?= $item['Item']['interval'] ?>秒</td>
						<td><?= $item['Item']['description'] ?></td>
						<td><?= $item['Item']['height'] ?>cm</td>
						<td><?= $item['Item']['weight'] ?>kg</td>
						<td><?= $item['Item']['special'] ?></td>
						<td><?= $item['Item']['energy'] ?></td>
						<td><?= $item['Item']['spirit'] ?></td>
						<? foreach ($skills as $skill => $ja): ?>
							<td><?= $item['Item'][$skill] ?></td>
						<? endforeach ?>
					</tr>
				<? endforeach ?>
			</tbody>
		</table>
	</div>
</div>