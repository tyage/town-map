<?php
class ItemsUser extends AppModel {
	var $belongsTo = array('User', 'Item');
	
	function consume ($item) {
		$this->id = $item['id'];
		$life = --$item['life'];
		if ($life > 0) {
			$data = array(
				'ItemsUser' => array(
					'life' => $life
				)
			);
			$this->save($data);
		} else {
			$this->delete();
		}
	}
}