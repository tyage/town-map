<?php
class ThreadsController extends AppController {
	var $uses = array('Thread', 'Response');
	var $helpers = array('Text');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}
	
	function index() {
		$this->paginate = array(
			'order' => 'Thread.updated DESC'
		);
		$this->set('threads', $this->paginate());
	}
	
	function view($id) {
		$thread = $this->Thread->findById($id);
		$this->set('thread', $thread);

		$this->paginate = array(
			'conditions' => array(
				'Response.thread_id' => $id
			),
			'order' => 'Response.created DESC',
			'limit' => 10
		);
		$this->set('responses', $this->paginate('Response'));
		$this->set('paginatorOption', 
			array(
				'url' => array($id)
			)
		);
	}

	function add(){
		if (!empty($this->data)) {
			$this->data['Thread']['user_id'] = $this->Self->id;
			$fieldList = array(
				'user_id','title'
			);
			if ($this->Thread->save($this->data, true, $fieldList)) {
				$id = $this->Thread->getLastInsertID();
				$this->redirect('/threads/view/'.$id);
			}
		}
	}
}