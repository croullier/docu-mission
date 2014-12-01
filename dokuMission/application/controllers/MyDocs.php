<?php
class MyDocs extends \CI_Controller {
	
	public function index(){
		$query = $this->doctrine->em->createQuery("SELECT d FROM Version v join v.document d join v.utilisateur u ");
		$document = $query->getResult();
		$this->load->view('v_myDocs',array('documents'=>$document));
	}
}