<?php
class MyDocs extends \CI_Controller {
	
	/**
	 * Affiche la liste de mes docs
	 */
	public function index(){
		$query = $this->doctrine->em->createQuery("SELECT v FROM Version v join v.document d join v.utilisateur u WHERE u.id=1");
		$document = $query->getResult();
		$this->load->view('v_myDocs',array('documents'=>$document));
	}
}