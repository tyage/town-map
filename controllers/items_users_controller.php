<?php
class ItemsUsersController extends AppController {
	function _battle() {
		//parent::_battle();
	}
	
	function index() {
		$this->layout = 'iframe';
		
		$this->paginate = array(
			'conditions' => array(
				'User.id' => $this->Self->id
			),
			'order' => 'ItemsUser.updated DESC'
		);
		$this->set('items', $this->paginate());
	}
	
	function consume($id) {
		$item = $this->ItemsUser->findById($id);
		
		switch (true) {
			case strtotime($this->Self->item_limit) > time():
				$message = (strtotime($this->Self->item_limit) - time()).'秒後まで使用できません。';break;
			case $this->Self->energy + $item['Item']['energy'] < 0:
				$message = '体力が足りません。';break;
			case $this->Self->spirit + $item['Item']['spirit'] < 0:
				$message = '精神力が足りません。';break;
			case $this->Self->id !== $item['ItemsUser']['user_id']:
				$message = 'あなたの物ではありません。';break;
			default:
				$this->ItemsUser->consume($item['ItemsUser']);
				$this->_upSkill($item);
				$this->_updateLimit($item);
				$message = $item['Item']['name'].'を使用しました。';
		}
		
		$this->flash($message, '/items_users/');
	}
	function _upSkill($item) {
		$statuses = am(
			getSkills(), 
			array('height', 'weight', 'energy', 'spirit')
		);
		
		$data = array();
		foreach ($statuses as $status) {
			$data['User'][$status] = $this->Self->$status + $item['Item'][$status];
		}
		$this->Self->save($data);
	}
	function _updateLimit($item) {
		$data = array(
			'User' => array(
				'item_limit' => date('Y-m-d H:i:s', time() + $item['Item']['interval'])
			)
		);
		$this->Self->save($data);
	}
}