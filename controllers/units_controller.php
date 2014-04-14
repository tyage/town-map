<?php
class UnitsController extends AppController {
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	function index() {
		$this->_renderJson($this->Unit->find('all'));
	}
}