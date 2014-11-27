<?php
class Utilisateurs extends \CI_Controller {
	
	public function all(){
		$query = $this->doctrine->em->createQuery("SELECT u FROM Utilisateur u join u.groupe g");
		$users = $query->getResult();
		$this->load->view('v_utilisateurs',array('utilisateurs'=>$users));
	}
	
	public function add(){
		//$this->load->helper(array('form', 'url'));
	
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('v_utilisateur_add');
		}
		else
		{
			$this->submit_add($_POST["login"]);
		}
	}
	
	public function submit_add($login){
		$user = new Utilisateur();
		$user->setLogin($login);
		$this->doctrine->em->persist($user);
		$this->doctrine->em->flush();
		$this->load->view('v_success_add',array('user'=>$user));
	}
	
}