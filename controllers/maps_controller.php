<?php
class MapsController extends AppController {
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	function index() {
	}
}