<?php
class HousesController extends AppController {
	var $helpers = array('Exform', 'Text');
	var $uses = array('House', 'Peta');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view', 'index');
	}
	
	function index() {
		$condition = array(
			'fields' => array(
				'House.id', 'House.user_id', 'House.lat', 'House.lng', 'House.image',
				'User.username',
				'Image.*'
			)
		);
		$this->_renderJson($this->House->find('all', $condition));
	}
	
	function edit($id) {
		$house = $this->House->findById($id);
		if ($house['User']['id'] === $this->Self->id) {
			if (!empty($this->data)) {
				$this->House->id = $id;
				$this->House->save($this->data, true, $this->House->fields['edit']);
			} else {
				$this->data = $house;
			}
		}
	}
	
	function view($id) {
		$house = $this->House->findById($id);
		$petas = $this->_petas($id);
		$this->set(compact('house', 'petas'));
	}
	function _petas($id) {
		$this->paginate = array(
			'Peta' => array(
				'order' => 'Peta.created DESC',
				'limit' => 5
			)
		);
		$petas = $this->paginate('Peta', array('Peta.house_id' => $id));
		return $petas;
	}
	
	function create() {
		if (!empty($this->data)) {
			$this->data['House']['user_id'] = $this->Self->id;
			if ($this->House->save($this->data, true, $this->House->fields['add'])) {
				$id = $this->House->getLastInsertID();
				$this->flash('家が完成しました！', '/houses/view/'.$id);
			}
		}
	}
	
	function images() {
		return $this->House->images();
	}
}