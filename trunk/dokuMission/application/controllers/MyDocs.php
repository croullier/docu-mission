<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyDocs extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
	}
	
	
	public function index(){
		define("WH", "Accueil->Gestion->Mes documents");
		$this->load->view("v_header");
		$this->load->view("v_left");
		$this->refresh();
		$this->load->view("v_footer");
	}
	
	public function refresh(){
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT v FROM Version v join v.document d join v.utilisateur u WHERE u.id=1");
		$document = $query->getResult();
		$this->load->view('v_myDocs',array('documents'=>$document));
	}
}