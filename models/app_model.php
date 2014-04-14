<?php
class AppModel extends Model {
	function _getFilePath($image) {
		$filepath = $image['Image']['subdir'].DS.
			($image['Image']['subdir'] === 'upload' ? 'thumb.small.' : '').
			$image['Image']['filename'];
		return $filepath;
	}
}