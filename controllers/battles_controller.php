<?php
class BattlesController extends AppController {
	function _battle() {
		$allow = array('fight');
		parent::_battle($allow);
	}
	
	function start($id, $confirm = false) {
		$user = $this->User->findById($id);
		$this->set('opponent', $user);
		
		if ($confirm and $user) {
			$data = array(
				'Battle' => array(
					'user_id' => $this->Self->id,
					'opponent' => $user['User']['id'],
					'energy' => $user['User']['maxEnergy'],
					'spirit' => $user['User']['maxSpirit']
				)
			);
			$this->Battle->save($data);
			
			$data = array(
				'User' => array(
					'status' => 'battle'
				)
			);
			$this->Self->save($data);
			
			$this->redirect('/battles/fight/');
		}
	}
	
	function fight($command = '') {
		$battle = $this->Battle->findByUserId($this->Self->id);
		if (empty($battle)) {
			$this->redirect('/');
		}
		
		switch ($command) {
			case 'attack':
				$data = $this->_attack($battle);
				break;
			case 'skill':
				$this->_skill($battle);
				break;
			case 'defend':
				$this->_defend($battle);
				break;
			case 'escape':
				$this->_escape($battle);
				break;
			default:
				break;
		}
		
		if (!empty($data)) {
			$this->Battle->id = $battle['Battle']['id'];
			$this->Battle->save($data);
			$battle = $this->Battle->read();
		}
		
		$opponent = $this->User->findById($battle['Opponent']['id']);
		$opponent['User']['energy'] = $battle['Battle']['energy'];
		$opponent['User']['spirit'] = $battle['Battle']['spirit'];
		$this->set('opponent', $opponent);
		
		if ($opponent['User']['energy'] <= 0) {
			$this->_win();
			$this->_end($battle);
		} else if ($this->Self->energy <= 0) {
			$this->_lose();
			$this->_end($battle);
		}
	}
	
	function _end($battle) {
		$data = array(
			'User' => array(
				'status' => ''
			)
		);
		$this->Self->save($data);
		
		$this->Battle->delete($battle['Battle']['id']);
	}
	
	function _win() {
		$money = rand(500, 1000);
		$data = array(
			'User' => array(
				'money' => $this->Self->money + $money
			)
		);
		$this->Self->save($data);
		
		$this->set('win', true);
		$this->set('money', $money);
	}
	function _lose() {
		$this->set('lose', true);
	}
	
	function _attack($battle) {
		$opponent = $this->User->findById($battle['Battle']['opponent']);
		$opponent['User']['energy'] = $battle['Battle']['energy'];
		$opponent['User']['spirit'] = $battle['Battle']['spirit'];
		
		if ($this->Self->speed >= $opponent['User']['speed']) {
			$first = $this->Self->data['User'];
			$second = $opponent['User'];
		} else {
			$first = $opponent['User'];
			$second = $this->Self->data['User'];
		}
		
		$second = $this->_damage($first, $second);
		$this->set('turn1', array(
			'attack' => $first,
			'defence' => $second
		));
		if ($second['energy'] > 0) {
			$first = $this->_damage($second, $first);
			$this->set('turn2', array(
				'attack' => $second,
				'defence' => $first
			));
		}
		
		$user = ($this->Self->id === $first['id'] ? $first : $second);
		$data = array(
			'User' => array(
				'energy' => $user['energy']
			)
		);
		$this->Self->save($data);
		
		$opponent = ($opponent['User']['id'] === $first['id'] ? $first : $second);
		return array(
			'Battle' => array(
				'energy' => $opponent['energy']
			)
		);
	}
	function _damage($attack, $defence) {
		$defence['spirit_before'] = $defence['spirit'];
		$defence['energy_before'] = $defence['energy'];
		
		$damage = $attack['power'] - $defence['soft'];
		if ($damage < 0) {
			$damage = 0;
		}
		if ($defence['energy'] < $damage) {
			$damage = $defence['energy'];
		}
		$defence['energy'] -= $damage;
		$defence['damage'] = $damage;
		
		return $defence;
	}
	
	function _skill() {
	
	}
	
	function _defend() {
	
	}
	
	function _escape($battle) {
		$this->_end($battle);
		$this->flash('逃げましたね！', '/');
	}
}