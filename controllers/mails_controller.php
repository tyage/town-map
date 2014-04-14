<?php
class MailsController extends AppController {
	var $helpers = array('Text');
	
	function _battle() {
		//parent::_battle();
	}
	
	function add() {
		if ($this->data) {
			$user = $this->User->findByUsername($this->data['User']['username']);
			if ($user['User']['id']) {
				$this->data['Mail']['to'] = $user['User']['id'];
				$this->data['Mail']['from'] = $this->Self->id;
				$this->data['Mail']['read'] = false;
				
				$fieldList = array('to', 'from', 'title', 'message', 'read');
				$this->Mail->save($this->data, true, $fieldList);
			}
		}
		$this->redirect('/mails/sends/');
	}
	
	function sends() {
		$this->layout = 'iframe';
		
		$this->paginate = array(
			'conditions' => array(
				'Mail.from' => $this->Self->id
			),
			'order' => 'Mail.created DESC'
		);
		$this->set('sends', $this->paginate());
	}
	
	function receives() {
		$this->layout = 'iframe';
		
		$this->paginate = array(
			'conditions' => array(
				'Mail.to' => $this->Self->id
			),
			'order' => 'Mail.created DESC'
		);
		$this->set('receives', $this->paginate());
	}
	
	function view($id) {
		$this->layout = 'iframe';
		
		$this->Mail->id = $id;
		$mail = $this->Mail->read();
		if ($mail['To']['id'] === $this->Self->id) {
			$data = array(
				'Mail' => array(
					'read' => true
				)
			);
			$this->Mail->save($data);
		} elseif ($mail['From']['id'] !== $this->Self->id) {
			$this->redirect('/mails/receives/');
		}
		
		$this->set('mail', $mail);
	}
	
	function check() {
		$condition = array(
			'conditions' => array(
				'Mail.to' => $this->Self->id,
				'Mail.read' => false
			)
		);
		$count = $this->Mail->find('count', $condition);
		$this->_renderJson(array('count' => $count));
	}
}