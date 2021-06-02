<?php
class admLoginController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admlogin', $dados);

	}

} 