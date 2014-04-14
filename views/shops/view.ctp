<h1><?= $shop['Shop']['name'] ?></h1>

<? $skills = getSkills('all', true) ?>
<table>
	<thead>
		<tr>
			<th><?= $paginator->sort('アイテム', 'Item.name') ?></th>
			<th><?= $paginator->sort('在庫', 'ItemsShop.stock') ?></th>
			<th><?= $paginator->sort('金額', 'ItemsShop.price') ?></th>
			<th><?= $paginator->sort('耐久', 'Item.life') ?></th>
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
		<? foreach ($items as $item): ?>
			<tr>
				<td><?= $html->link(
					$item['Item']['name'], 
					'/items_shops/buy/'.$item['ItemsShop']['id']
				) ?></td>
				<td><?= $item['ItemsShop']['stock'] ?>個</td>
				<td><?= $item['ItemsShop']['price'] ?>円</td>
				<td><?= $item['Item']['life'] ?>回</td>
				<td><?= $item['Item']['interval'] ?>分</td>
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

<?= $paginator->numbers(true) ?>