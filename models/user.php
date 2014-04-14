<?php
class User extends AppModel {
	var $belongsTo = array('Chat', 'Image');
	var $validate = array(
		'username' => array(
			'isUnique',
			'notEmpty'
		),
		'email' => array(
			'rule' => array('email'),
			'allowEmpty' => true
		)
	);
	
	var $startWeight = array(60,50); //男,女
	var $startHeight = array(170,160); //男,女
	var $startMoney = 50000;
	var $startSkill = 50;
	var $startEnergy = 50;
	var $startSpirit = 50;
	var $startLat = 35;
	var $startLng = 135;
	var $startLatRange = 5;
	var $startLngRange = 10;
	var $startImageId = 107;
	var $recoverPerSecond = 0.1;
	var $imageDir = 'users';
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		
		$a = $this->alias;
		$this->virtualFields = array(
			'bmi' => 'CAST(('.$a.'.weight / ('.$a.'.height/100) / ('.$a.'.height/100)) AS SIGNED)',
			'maxEnergy' => 'CAST(('.$a.'.power+'.$a.'.speed+'.$a.'.soft)/3 AS SIGNED)',
			'maxSpirit' => 'CAST(('.$a.'.language+'.$a.'.math+'.$a.'.science+'.$a.'.society)/4 AS SIGNED)'
		);
	}
	
	function beforeSave() {
		if (!empty($this->data['User']['image_id'])) {
			$image = $this->Image->findById($this->data['User']['image_id']);
			$this->data['User']['image'] = $this->_getFilePath($image);
		}
		return true;
	}
	
	function init($id) {
		$user = $this->findById($id);
		$this->id = $id;
		$data = $this->_initData($user);
		$this->save($data);
	}
	function _initData($user) {
		$this->startLat += rand(-$this->startLatRange/2, $this->startLatRange/2);
		$this->startLng += rand(-$this->startLngRange/2, $this->startLngRange/2);
		$data = array(
			'User' => array(
				'weight' => $this->startWeight[$user['User']['sex']],
				'height' => $this->startHeight[$user['User']['sex']],
				'image_id' => $this->startImageId,
				'lat' => $this->startLat,
				'lng' => $this->startLng,
				'energy' => $this->startEnergy,
				'spirit' => $this->startSpirit,
				'money' => $this->startMoney
			)
		);
		$skills = getSkills();
		foreach ($skills as $skill) {
			$data['User'][$skill] = $this->startSkill;
		}
		return $data;
	}
	
	function correctData($data) {
		$maxSpirit = $this->getMaxSpirit($data);
		$maxEnergy = $this->getMaxEnergy($data);
		
		$data['spirit'] = ($data['spirit'] > $maxSpirit ? $maxSpirit : $data['spirit']);
		$data['energy'] = ($data['energy'] > $maxEnergy ? $maxEnergy : $data['energy']);
		
		return $data;
	}
	
	function getMaxSpirit($data) {
		$skills = getSkills('brain');
		$max = 0;
		foreach ($skills as $skill) {
			$max += $data[$skill];
		}
		return ceil($max / count($skills));
	}
	function getMaxEnergy($data) {
		$skills = getSkills('physical');
		$max = 0;
		foreach ($skills as $skill) {
			$max += $data[$skill];
		}
		return ceil($max / count($skills));
	}
	
	function calcRecover($seconds) {
		return intval($seconds * $this->recoverPerSecond);
	}
	
	function getImages(){
		$condition = array(
			'conditions' => array(
				'Image.subdir' => $this->imageDir
			)
		);
		$files = $this->Image->find('all', $condition);
		return $files;
	}
}