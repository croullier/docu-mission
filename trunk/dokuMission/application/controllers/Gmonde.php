<?php
class Gmonde extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
	}
	
	public function index(){
		$this->refresh();
		
	}
	
	public function refresh(){
		
		$this->jsutils->getAndBindTo(".delete","click","Gmonde/delete","#message","{}");
		$this->jsutils->getAndBindTo(".update","click","Gmonde/monde_modif","#message","{}");
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
	
	public function monde_modif($param){
		
		$this->jsutils->doSomethingOn("#modifier", "append","'<input type=\"hidden\" name=\"key\" value=\"$param\">'");
		$this->jsutils->getAndBindTo("#update", "click", "Gmonde/update/","#message");
		$this->jsutils->external();
		echo $this->jsutils->compile();
	}
	
	public function update(){
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('update_monde', 'Monde', 'trim|required|min_length[1]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('key', 'Monde', 'trim|required|min_length[1]|max_length[12]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('v_monde');
		}
		else
		{
			$this->monde_update($_POST["update_monde"], $_POST["key"]);
		}
		
	}
	
	public function monde_update($monde, $key){
		$query = $this->doctrine->em->createQuery("UPDATE Monde m SET m.libelle='".$monde."' WHERE m.id='".$key."' ");
		$query->getSingleResult();
		//echo JsUtils::get("/trivia/CPartie/refresh","{}","body");
		$this->refresh();
	}
	
	public function delete($param){
	
		$query = $this->doctrine->em->createQuery("DELETE Monde m  WHERE m.id='".$param."'");
		$query->getSingleResult();
		//echo JsUtils::get("/trivia/CPartie/refresh","{}","body");
		echo "Supprimé";
		$this->jsutils->get("/dokuMission/Gmonde/refresh","{}","body");
		$this->jsutils->doSomethingOn("#message", "hide",5000);
	}
	
	
	
	
}