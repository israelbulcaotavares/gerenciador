<?php
class admHomeController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admHome', $dados);
 
	}

} 