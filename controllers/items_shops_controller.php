<?php
class ItemsShopsController extends AppController {
	var $uses = array('ItemsShop', 'ItemsUser');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('shop');
	}
	
	function shop($shop_id) {
		$this->set('shop', $this->ItemsShop->Shop->findById($shop_id));
		$this->paginate = array(
			'conditions' => array(
				'ItemsShop.shop_id' => $shop_id
			),
			'limit' => 10
		);
		$this->set('items', $this->paginate());
	}
	
	function buy($id) {
		$itemsShop = $this->ItemsShop->findById($id);
		
		$money = $this->Self->money - $itemsShop['ItemsShop']['price'];
		if ($money >= 0) {
			// お金を払う
			$data = array(
				'User' => array(
					'money' => $money
				)
			);
			$this->Self->save($data);
			
			// 在庫を減らす
			$stock = --$itemsShop['ItemsShop']['stock'];
			$this->ItemsShop->reduceStock($id, $stock);
			
			// 所持アイテムに追加
			$data = array(
				'ItemsUser' => array(
					'item_id' => $itemsShop['Item']['id'],
					'user_id' => $this->Self->id,
					'price' => $itemsShop['ItemsShop']['price'],
					'life' => $itemsShop['Item']['life']
				)
			);
			$this->ItemsUser->save($data);
		}
		
		$this->redirect('/shops/view/'.$itemsShop['Shop']['id']);
	}
	
	function siire() {
		$maxId = $this->ItemsShop->Item->find('count');
		$data = array();
		for ($i = 0; $i < 200; $i++) {
			$id = rand(1, $maxId);
			
			$item = $this->ItemsShop->Item->findById($id);
			$data[$id] = array(
				'ItemsShop' => array(
					'item_id' => $id,
					'shop_id' => 1,
					'price' => $item['Item']['price'] * 2,
					'stock' => $item['Item']['stock']
				)
			);
		}
		$this->ItemsShop->saveAll($data);
	}
}