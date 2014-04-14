<?php
class ResponsesController extends AppController {
	function add() {
		if (!empty($this->data)) {
			$this->data['Response']['user_id'] = $this->Self->id;
			$fieldList = array(
				'thread_id','user_id','message'
			);
			if ($this->Response->save($this->data, true, $fieldList)) {
				$this->Response->Thread->id = $this->data['Response']['thread_id'];
				$this->Response->Thread->save();

				$this->redirect('/threads/view/'.$this->data['Response']['thread_id']);
			}
		} else {
			$this->redirect('/threads/index/');
		}
	}
}