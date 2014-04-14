<?php
class Image extends AppModel{
	var $actsAs = array(
		'MeioUpload' => array(
			'filename' => array(
				'dir' => 'img/upload',
				'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
				'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif'),
				'thumbsizes' => array(
					'normal' => array('width' => 400, 'height' => 400),
					'medium' => array('width' => 200, 'height' => 200),
					'small' => array('width' => 32, 'height' => 32)
				)
			)
		)
	);
	
	var $belongsTo = array('User');
	
	function saveFromUploadedImage($dir) {
		// 使うときにはactAsを手動で解除しておくこと。
		$data = array();
		
		$condition = array(
			'Image.subdir' => $dir
		);
		$this->deleteAll($condition);
		
		uses('folder');
		$folder = new Folder(WWW_ROOT.'img'.DS.$dir);
		list($dirs,$files) = $folder->read();
		foreach ($files as $key => $file) {
			$data[] = array(
				'Image' => array(
					'filename' => $file,
					'dir' => 'img'.DS.$dir,
					'subdir' => $dir
				)
			);
		}
		
		$this->saveAll($data, array());
	}
}