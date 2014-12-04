<?php
class Groupes extends \BaseCtrl {
	
	public function all(){
		$query = $this->doctrine->em->createQuery("SELECT g FROM Groupe g ");
		$group = $query->getResult();
		$this->load->view('v_groupes',array('groupes'=>$group));
	}
	
}