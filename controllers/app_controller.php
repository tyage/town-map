<?php
class AppController extends Controller{
	var $components = array('Auth', 'RequestHandler', 'Self');
	var $helpers = array('Html', 'Form', 'Paginator', 'Session', 'Javascript', 'User');
	var $uses = array('User');
	
	var $Title = 'Google Mapsと愉快な仲間達';
	
	function beforeFilter() {
		if (!empty($this->Self->data)) {
			Configure::write('Self', $this->Self->data);
		}
		
		$this->Auth->logoutRedirect = '/';
		$this->Auth->deny('*');
		
		if (!empty($this->params['iframe'])) {
			$this->layout = 'iframe';
			Configure::write('Routing.prefixes', array('iframe'));
			$router =& Router::getInstance();
			$router->__setPrefixes();
		}
		
		$this->_status();
	}
	
	function beforeRender() {
		$this->set('title_for_layout', $this->Title);
		$this->set('Self', $this->Self);
	}
	
	function _status() {
		if (!empty($this->Self->id)) {
			switch ($this->Self->status) {
				case 'spa':
					$this->_spa();
					break;
				case 'battle':
					$this->_battle();
					break;
			}
		}
	}
	function _spa() {
	}
	function _battle($allow = array()) {
		if (!in_array($this->action, $allow)) {
			$this->flash('現在対戦中です', '/battles/fight');
		}
	}
	
	// http://c-brains.jp/blog/wsg/11/01/21-232435.php
	function _renderJson($contents=array(), $params=array()) {
		$params = Set::merge(array(
			'header' => true,
			'debugOff' => true,
		), $params);
		if ($params['debugOff']) {
			Configure::write('debug', 0);
		}
		if ($params['header']) {
			$this->RequestHandler->setContent('json');
			$this->RequestHandler->respondAs('application/json; charset=UTF-8');
		}

		$this->layout = false;
		$this->set(compact('contents'));
		$this->render('/json');
	}
}