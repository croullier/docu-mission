<?php
class Gmonde extends \CI_Controller {
	public function index(){
		$query = $this->doctrine->em->createQuery("SELECT m FROM Mondes");
		$users = $query->getResult();
		$this->load->view('v_monde',array('mondes'=>$monde));
	}
}