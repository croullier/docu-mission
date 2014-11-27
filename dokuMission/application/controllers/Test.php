<?php
class Test extends \CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
	}
	
	function index(){
		$this->jsutils->getAndBindTo("#div","click","Test/ajaxGet","#response");
		$this->jsutils->external();
		$this->jsutils->compile();
		$this->load->view('v_test');
	}
	 
	function ajaxGet(){
		echo "Exemple de get sur click";
	}
	
}