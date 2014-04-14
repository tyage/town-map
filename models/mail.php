<?php
class Mail extends AppModel {
	var $belongsTo = array(
		'From' => array(
			'className' => 'User',
			'foreignKey' => 'from',
			'fields' => array('id', 'username', 'image')
		),
		'To' => array(
			'className' => 'User',
			'foreignKey' => 'to',
			'fields' => array('id', 'username', 'image')
		)
	);
}
