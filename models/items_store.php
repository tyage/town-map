<?php
class ItemsStore extends AppModel {
	var $belongsTo = array('Store', 'Item', 'User');
	
	var $validate = array(
		'store_id' => array(
			'canStock' => array(
				'rule' => 'canStock',
				'message' => '収められません'
			)
		)
	);
	
	function canStock($check) {
		$store_id = current($check);
		$store = $this->Store->findById($store_id);
		$user_id = Configure::read('Self.User.id');
		$stock = $this->find('count', array(
			'conditions' => array(
				'ItemsStore.store_id' => $store_id
			)
		));
		
		return $store['User']['id'] === $user_id and 
			$stock < $store['Store']['stock'];
	}
}