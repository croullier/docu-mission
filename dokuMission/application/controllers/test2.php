<?php
class test2 extends CI_Controller{
	
	public function index() {
		define("WH", "Accueil->Admin->Gestion->Monde");
		$this->load->view("v_header");
		$this->load->view("v_left");
 		
	}
	
}

