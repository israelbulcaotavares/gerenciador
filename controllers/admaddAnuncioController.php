<?php
class admaddAnuncioController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admaddAnuncio', $dados);

	}

} 