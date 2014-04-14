<?php
class Chat extends AppModel{
	var $belongsTo = 'User';
	
	var $validate = array(
		'message' => 'notEmpty'
	);
}