<?php
class ImagesController extends AppController {
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view', 'index');
	}
	
	function index() {
		$this->paginate = array(
			'limit' => 10,
			'order' => 'Image.created DESC',
			'conditions' => array(
				'Image.subdir' => 'upload'
			)
		);
		$this->set('images', $this->paginate());
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data['Image']['user_id'] = $this->Self->id;
			$this->data['Image']['subdir'] = 'upload';
			if ($this->Image->save($this->data)) {
				$this->flash('アップロードが完了しました。', '/images/');
			}
		}
	}
	
	function delete($id) {
		$image = $this->Image->findById($id);
		if (
			$image['Image']['subdir'] === 'upload' and 
			$image['Image']['user_id'] === $this->Self->id and 
			$this->Image->delete($id)
		) {
			$this->flash('削除しました。', '/images/');
		}
	}
	
	function view($id) {
		$this->set('image', $this->Image->findById($id));
	}
	
	function saveUserImage() {
		// 使うときにはactAsを手動で解除しておくこと。
		$this->Image->saveFromUploadedImage('users');
	}
	function saveHouseImage() {
		// 使うときにはactAsを手動で解除しておくこと。
		$this->Image->saveFromUploadedImage('houses');
	}
}