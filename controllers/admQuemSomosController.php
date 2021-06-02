<?php
class admQuemSomosController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admquemsomos', $dados);

	}

} 