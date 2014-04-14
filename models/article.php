<?php
class Article extends AppModel{
	var $belongsTo = array('User');
	
	//don't need yet
	//var $hasMany = array('Comment');
}