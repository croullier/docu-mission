<?php
class Gdomaine extends \CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
	}
	public function index(){
		$this->refresh();
	}
	public function refresh(){
		
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->getAndBindTo(".update","click","Gdomaine/domaine_modif","#message","{}");
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT d FROM Domaine d");
		$domaine = $query->getResult();
		$this->load->view('v_domaine',array('domaines'=>$domaine));
	}
	
	public function add(){	
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('domaine', 'Domaine', 'trim|required|min_length[1]|max_length[12]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('v_domaine');
		}
		else
		{
			$this->domaine_add($_POST["domaine"]);
		}
	}
	
	public function domaine_add($domaine){
		$domaines = new Domaine();
		$domaines->setLibelle($domaine);
		$this->doctrine->em->persist($domaines);
		$this->doctrine->em->flush();
	}
	
	public function domaine_modif($param){		
		$this->jsutils->doSomethingOn("#modifier", "append","'<input type=\"hidden\" name=\"key\" value=\"$param\">'");
		$this->jsutils->external();
		echo $this->jsutils->compile();
	}
	
	public function domaine_update($param){
	
	}
	
	public function domaine_delete($param){
		
		
	}
}