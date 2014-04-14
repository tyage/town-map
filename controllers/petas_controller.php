<?php
class PetasController extends AppController {
	function add() {
		if (!empty($this->data)) {
			$this->data['Peta']['user_id'] = $this->Self->id;
			if ($this->Peta->save($this->data)) {
				$this->flash('投稿しました！', '/houses/view/'.$this->data['Peta']['house_id']);
			}
		}
	}
}