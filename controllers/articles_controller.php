<?php
class ArticlesController extends AppController {
	var $helpers = array('Text');
	var $uses = array('Article', 'Comment');
	
	function lists($user_id) {
		$this->paginate = array(
			'conditions' => array(
				'Article.user_id' => $user_id
			),
			'limit' => 5,
			'order' => 'Article.created DESC'
		);
		$this->set('articles', $this->paginate());
		
		$this->set('author', $this->Article->User->findById($user_id));
		
		$this->set('isAuthor', $this->Self->id === $user_id);
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data['Article']['user_id'] = $this->Self->id;
			if ($this->Article->save($this->data)) {
				$id = $this->Article->getLastInsertID();
				$this->flash('新しく記事を投稿しました。', '/articles/view/'.$id);
			}
		}
	}
	
	function view($id) {
		$this->set('article', $this->Article->findById($id));
		$this->set('comments', $this->_comments($id));
	}
	function _comments($id) {
		$this->paginate = array(
			'Comment' => array(
				'conditions' => array(
					'Comment.article_id' => $id
				),
				'limit' => 5,
				'order' => 'Comment.created DESC'
			)
		);
		return $this->paginate('Comment');
	}
}