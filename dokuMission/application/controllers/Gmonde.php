<?php
class Gmonde extends \CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
	}
	
	public function index(){
		
		$this->jsutils->getAndBindTo("#update","click","Gmonde/monde_modif","#modifier");
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT m FROM Monde m");
		$monde = $query->getResult();
		$this->load->view('v_monde',array('mondes'=>$monde));
	}
	
	public function add(){	
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('monde', 'Monde', 'trim|required|min_length[1]|max_length[12]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('v_monde');
		}
		else
		{
			$this->monde_add($_POST["monde"]);
		}
	}
	
	public function monde_add($monde){
		$mondes = new Monde();
		$mondes->setLibelle($monde);
		$this->doctrine->em->persist($mondes);
		$this->doctrine->em->flush();
	}
	
	public function monde_modif(){
		$this->jsUtils->doSomeThingOn("#modifier","show");
		echo"lol";
	}
}