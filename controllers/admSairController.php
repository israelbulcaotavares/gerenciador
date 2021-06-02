<?php
class admSairController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admsair', $dados);

	}

} 