<?php
class admbannerController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admbanner', $dados);

	}

} 