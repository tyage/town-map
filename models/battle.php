<?php
class Battle extends AppModel{
	var $belongsTo = array(
		'User',
		'Opponent' => array(
			'className' => 'User',
			'foreignKey' => 'opponent'
		)
	);
}