<?php
class Store extends AppModel{
	var $belongsTo = array('House', 'User');
	
	var $validate = array(
		'house_id' => array(
			'hasNoStore' => array(
				'rule' => array('hasNoStore'),
				'message' => '既に作られています。'
			)
		)
	);
	
	var $startStock = 10;
	
	function hasNoStore($check) {
		$house_id = current($check);
		$house = $this->House->findById($house_id);
		$user_id = Configure::read('Self.User.id');
		
		return $house['User']['id'] === $user_id and 
			empty($house['Store']['id']);
	}
}