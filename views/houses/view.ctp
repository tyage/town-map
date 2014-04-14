<h1><?= $house['User']['username'] ?>の家</h1>

<? $landlord = $house['User']['id'] === $Self->id ?>
<? if($landlord): ?>
	<?= $html->link('家の管理', '/houses/edit/'.$house['House']['id']) ?>
<? endif ?>

<nav>
	<ul>
		<li>
			<? if(!empty($house['Store']['id'])): ?>
				<?= $html->link('倉庫', 
					'/stores/view/'.$house['Store']['id']); ?>
			<? elseif ($landlord): ?>
				<?= $html->link('倉庫を設置する', 
					'/stores/create/'.$house['House']['id']); ?>
			<? endif ?>
		</li>
		<li>
			<? if(!empty($house['Shop']['id'])): ?>
				<?= $html->link('店舗', 
					'/shops/view/'.$house['Shop']['id']); ?>
			<? elseif ($landlord): ?>
				<?= $html->link('店舗を設置する', 
					'/shops/create/'.$house['House']['id']); ?>
			<? endif ?>
		</li>
	</ul>
</nav>

<hr />

<section class="comment">
	<h2>コメント</h2>
	<?= $this->element('../petas/lists', 
		array(
			'house_id' => $house['House']['id'], 
			'petas' => $petas, 
			'element' => true
		)
	) ?>
</section>
