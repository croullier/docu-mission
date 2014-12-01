<?php
class MyDocs extends \CI_Controller {
	
	public function index(){
		$query = $this->doctrine->em->createQuery("SELECT d FROM Document d");
		$document = $query->getResult();
		$this->load->view('v_myDocs',array('documents'=>$document));
	}
}