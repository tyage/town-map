<?php
class CommentsController extends AppController {
	function add() {
		if (!empty($this->data)) {
			$this->data['Comment']['user_id'] = $this->Self->id;
			if ($this->Comment->save($this->data)) {
				$this->flash('コメントを投稿しました。', '/articles/view/'.$this->data['Comment']['article_id']);
			}
		}
	}
	
	function count($article_id) {
		$condition = array(
			'conditions' => array(
				'Comment.article_id' => $article_id
			)
		);
		return $this->Comment->find('count', $condition);
	}
}