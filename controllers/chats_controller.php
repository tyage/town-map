<?php
class ChatsController extends AppController {
	var $helpers = array('Text');
	
	function _battle() {
		// do nothing when mode is battle
	}
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data['Chat']['user_id'] = $this->Self->id;
			if ($this->Chat->save($this->data)) {
				$money = rand(10, 100);
				$data = array(
					'User' => array(
						'money' => $this->Self->money + $money,
						'chat_id' => $this->Chat->getLastInsertID()
					)
				);
				$this->Self->save($data);
				
				$this->flash('投稿して'.$money.'円を得ました。', '/chats/');
			} else {
				$this->redirect('/chats/');
			}
		}
	}
	
	function index() {
		$this->layout = 'iframe';
		
		$this->paginate = array(
			'order' => 'Chat.created DESC'
		);
		$this->set('chats', $this->paginate());
	}
}