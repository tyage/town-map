<?php
class ItemsShop extends AppModel{
	var $belongsTo = array('Shop', 'Item');
	
	function reduceStock($id, $stock) {
		$this->id = $id;
		if ($stock > 0) {
			$data = array(
				'ItemsShop' => array(
					'stock' => $stock
				)
			);
			$this->ItemsShop->save($data);
		} else {
			$this->ItemsShop->delete();
		}
	}
}