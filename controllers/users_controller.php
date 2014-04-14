<?php
class UsersController extends AppController {
	var $helpers = array('Exform');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'view', 'entries');
	}
	
	function _battle() {
		$allow = array('view', 'edit', 'self', 'entries');
		parent::_battle($allow);
	}
	
	function login() {
	}
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function self() {
		$this->_renderJson($this->Self->data);
	}
	
	function add() {
		if (!empty($this->data)) {
			$option = array(
				'fieldList' => array(
					'username','password','sex'
				)
			);
			if ($this->User->save($this->data, $option)) {
				$id = $this->User->getLastInsertID();
				$this->User->init($id);
				
				$this->Auth->login($this->data);
				$this->redirect($this->Auth->redirect());
			}
			$this->data['User']['password'] = ''; //パスワードは暗号化されているので初期化
		}
	}
	
	function view($id) {
		$this->layout = 'iframe';
		
		$user = $this->User->findById($id);
		$this->set(compact('user'));
	}

	function edit() {
		$this->layout = 'iframe';
		
		$this->set('images', $this->User->getImages());
		
		$this->User->id = $this->Self->id;
		if (!empty($this->data)) {
			$fieldList = array('username', 'email', 'born', 'image_id', 'image');
			$this->Self->save($this->data, true, $fieldList);
		} else {
			$this->data = $this->User->read();
		}
	}
	
	function entries() {
		$condition = array(
			'conditions' => array(
				'User.updated > ' => date('Y-m-d H:i:s', time() - 60*60*24*60)
			),
			'fields' => array(
				'User.id', 'User.username', 'User.image', 'User.lat', 'User.lng', 
				'Chat.id', 'Chat.message', 'Chat.created',
				'User.created', 'User.updated'
			)
		);
		$this->set('users', $this->User->find('all', $condition));
	}
	
	function move($lat, $lng) {
		$data = array(
			'User' => array(
				'lat' => $lat,
				'lng' => $lng
			)
		);
		$result = $this->Self->save($data);
		$this->_renderJson($result);
	}
	
	function recover() {
		$now = time();
		$recovered = strtotime($this->Self->recovered);
		$recover = ($this->Self->status === 'battle' ? 0 : $this->User->calcRecover($now - $recovered));
		
		$tmp = array(
			'spirit' => $this->Self->spirit,
			'energy' => $this->Self->energy
		);
		$data  = array(
			'User' => array(
				'recovered' => date('Y-m-d H:i:s', $now),
				'spirit' => $this->Self->spirit + $recover,
				'energy' => $this->Self->energy + $recover
			)
		);
		$this->Self->save($data);
		
		$this->_renderJson(
			array(
				'spirit' => $this->Self->spirit - $tmp['spirit'],
				'energy' => $this->Self->energy - $tmp['energy']
			)
		);
	}
}