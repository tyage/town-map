<?php
class House extends AppModel {
	var $belongsTo = array('User', 'Image');
	var $hasOne = array('Store', 'Shop');
	
	var $imageDir = 'houses';
	
	var $fields = array(
		'add' => array('user_id', 'lat', 'lng', 'image_id', 'image'),
		'edit' => array('lat', 'lng', 'image_id', 'image')
	);
	
	function beforeSave() {
		if (!empty($this->data['House']['image_id'])) {
			$image = $this->Image->findById($this->data['House']['image_id']);
			$this->data['House']['image'] = $this->_getFilePath($image);
		}
		return true;
	}
	
	function images(){
		$condition = array(
			'conditions' => array(
				'Image.subdir' => $this->imageDir
			)
		);
		$files = $this->Image->find('all', $condition);
		return $files;
	}
}