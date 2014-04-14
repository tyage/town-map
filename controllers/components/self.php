<?php
class SelfComponent extends Object {
	function initialize(&$controller){
		$this->controller =& $controller;
		
		if ($id = $this->controller->Auth->user('id')) {
			$self = $this->controller->User->findById($id);
			foreach ($self['User'] as $key => $value) {
				$this->$key = $value;
			}
			$this->data = $self;
		}
	}

	function save($data, $validate = true, $fieldList = array()) {
		$this->updateData($data['User']);
		$correctData = $this->controller->User->correctData($this->data['User']);
		$this->updateData($correctData);
		
		foreach ($data['User'] as $key => $value) {
			$data['User'][$key] = $this->data['User'][$key];
		}
		
		$this->controller->User->id = $this->id;
		$this->controller->User->save($data, $validate, $fieldList);
	}
	
	function updateData ($data = null) {
		if (is_null($data)) {
			$data = $this->data['User'];
		}
		foreach ($data as $key => $value) {
			$this->$key = $value;
			$this->data['User'][$key] = $value;
		}
	}
}