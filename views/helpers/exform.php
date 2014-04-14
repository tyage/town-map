<?php
class ExformHelper extends AppHelper{
	var $helpers = array('Html','Form');

	function imageSelector($fieldName, $images, $imageAttr = array(), $radioAttr = array()) {
		$i = 0;
		$options = array();
		foreach($images as $image){
			$url = $image['Image']['subdir'].DS.$image['Image']['filename'];
			$id = $image['Image']['id'];
			$options[$id] = $this->Html->image($url, $imageAttr);
			if(++$i >= $radioAttr['line']){
				$options[$id] .= '<br />';
				$i = 0;
			}
		}
		$out = $this->Form->radio($fieldName, $options, $radioAttr);

		return $this->output('<div class="images">'.$out.'</div>');
	}
}