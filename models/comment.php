<?php
class Comment extends AppModel{
	var $belongsTo = array('User', 'Article');
}