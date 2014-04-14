<?php
class ShopsController extends AppController {
	var $uses = array('Shop', 'ItemsShop');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	function index() {
		$condition = array(
			'fields' => array(
				'Shop.id', 'Shop.name', 'Shop.lat', 'Shop.lng'
			)
		);
		$this->_renderJson($this->Shop->find('all', $condition));
	}
	
	function view($id) {
		$shop = $this->Shop->findById($id);
		
		$this->paginate = array(
			'conditions' => array(
				'ItemsShop.shop_id' => $id
			),
			'limit' => 10
		);
		$items = $this->paginate('ItemsShop');
		
		$this->set(compact('shop', 'items'));
	}
}