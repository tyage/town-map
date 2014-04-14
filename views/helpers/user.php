<?php
class UserHelper extends AppHelper {
	var $helpers = array('Html');

	function link($user) {
		$out = null;
		$option = array(
			'class' => 'window'
		);
		$out .= $this->Html->link(
			$user['username'], 
			$this->_url($user), 
			$option
		);
		return $this->output($out);
	}
	
	function image($user) {
		$out = null;
		$option = array(
			'class' => 'window',
			'escape' => false
		);
		$out .= $this->Html->link(
			$this->Html->image($user['image'], array('class' => 'user-image')),
			$this->_url($user), 
			$option
		);
		return $this->output($out);
	}
	
	function _url($user) {
		return array('controller' => 'users', 'action' => 'view', $user['id']);
	}
}