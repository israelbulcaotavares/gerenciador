<?php
class admEditarAnuncioController extends controller {

	public function index() {
		$dados = array();
 
		$this->loadTemplateADM('admeditaranuncio', $dados);

	}

} 