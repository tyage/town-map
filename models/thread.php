<?php
class Thread extends AppModel {
	var $belongsTo = array(
		'User' => array(
			'fields' => array('id', 'username', 'image')
		)
	);

	var $validate = array(
		'title' => 'notEmpty'
	);
}