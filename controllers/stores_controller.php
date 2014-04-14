<?php
class StoresController extends AppController {
	var $uses = array('Store', 'ItemsStore', 'ItemsUser');
	
	function view($id) {
		$store = $this->Store->findById($id);
		$storeItems = $this->_storeItems($id);
		$userItems = $this->_uesrItems($this->Self->id);
		$this->set(compact('store', 'storeItems', 'userItems'));
	}
	function _storeItems($id) {
		$this->paginate = array(
			'ItemsStore' => array(
				'order' => 'ItemsStore.created DESC'
			)
		);
		$items = $this->paginate('ItemsStore', array('ItemsStore.store_id' => $id));
		return $items;
	}
	function _uesrItems($id) {
		$this->paginate = array(
			'ItemsUser' => array(
				'order' => 'ItemsUser.created DESC'
			)
		);
		$items = $this->paginate('ItemsUser', array('ItemsUser.user_id' => $id));
		return $items;
	}
	
	function create($house_id) {
		$data = array(
			'Store' => array(
				'house_id' => $house_id,
				'user_id' => $this->Self->id,
				'stock' => $this->Store->startStock
			)
		);
		$this->Store->save($data);
		
		$id = $this->Store->getLastInsertID();
		$this->redirect('/stores/view/'.$id);
	}
	
	function out($items_store_id) {
		$item = $this->ItemsStore->findById($items_store_id);
		if ($item['User']['id'] === $this->Self->id) {
			$this->ItemsStore->delete($items_store_id);
			
			$data = array(
				'ItemsUser' => $item['ItemsStore']
			);
			$this->ItemsUser->save($data);
		}
		
		$this->redirect('/stores/view/'.$item['Store']['id']);
	}
	
	function in($store_id, $items_user_id) {
		$item = $this->ItemsUser->findById($items_user_id);
		
		if ($item['User']['id'] === $this->Self->id) {
			$data = array(
				'ItemsStore' => am(
					$item['ItemsUser'],
					array('store_id' => $store_id)
				)
			);
			if ($this->ItemsStore->save($data)) {
				$this->ItemsUser->delete($items_user_id);
			}
		}
		
		$this->redirect('/stores/view/'.$store_id);
	}
}