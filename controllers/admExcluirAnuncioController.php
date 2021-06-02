<?php
class admExcluirAnuncioController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admexcluiranuncio', $dados);

	}

} 