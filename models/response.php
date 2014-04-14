<?php
class Response extends AppModel {
	var $belongsTo = array(
		'User' => array(
			'fields' => array('id', 'username', 'image')
		),
		'Thread'
	);

	var $validate = array(
		'message' => array(
			'rule' => 'notEmpty'
		)
	);

}