<?php
class controller {

	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		require 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {  //abrir proximas paginas coms msm templates
		require 'views/template.php';
	}

 
	public function loadViewInTemplate($viewName, $viewData = array()) {
		extract($viewData);
		require 'views/'.$viewName.'.php';
	}



		public function loadTemplateADM($viewName, $viewData = array()) {  //abrir proximas paginas coms msm templates
		require 'views/admtemplate.php';
	}


 

}