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
		$this->jsutils->postFormAndBindTo("#btAdd", "click", "/dokuMission/Gmonde/add/", "frmAddMonde","#message");
		$this->jsutils->getAndBindTo(".delete","click","Gmonde/delete","#message","{}");
		$this->jsutils->getAndBindTo(".update","click","Gmonde/monde_modif","#message","{}");
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT m FROM Monde m");
		$monde = $query->getResult();
		$this->load->view('v_monde',array('mondes'=>$monde));
	}
	
	public function add(){	
		if(!empty($_POST['libelle'])){
			$libelle=htmlspecialchars($_POST['libelle']);
			$monde = new Monde();
			$monde->setLibelle($libelle);
			$this->doctrine->em->persist($monde);
			$this->doctrine->em->flush();
			if($monde->getId()!=null){
				echo "Ajouté";
				$this->jsutils->get("/dokuMission/Gmonde/refresh/","body");
				echo $this->jsutils->compile();
			}
		}
	}
	
	
	public function monde_modif($param){
		
		$this->jsutils->doSomethingOn("#frmUpdateMonde", "append","'<input type=\"hidden\" name=\"key\" value=\"$param\">'");
		$this->jsutils->getAndBindTo("#update", "click", "Gmonde/update/","#message");
		$this->jsutils->postFormAndBindTo("#btUpdate", "click", "/dokuMission/Gmonde/update/", "frmUpdateMonde","#message");
		echo $this->jsutils->compile();
	}
	

	public function update(){
		if(!empty($_POST['libelle']) && !empty($_POST['key'])){
			$libelle=htmlspecialchars($_POST['libelle']);
			$key=htmlspecialchars($_POST['key']);
			$query = $this->doctrine->em->createQuery("UPDATE Monde m SET m.libelle='".$libelle."' WHERE m.id='".$key."' ");
			$numUpdated = $query->execute();
			if($numUpdated ==1){
				echo "Mis à jour";
				$this->jsutils->get("/dokuMission/Gmonde/refresh/","body");
				echo $this->jsutils->compile();
			}
		}
		
	}	

	
	public function delete($param){
		$query = $this->doctrine->em->createQuery("DELETE Monde m  WHERE m.id='".$param."'");
		$numUpdated = $query->execute();
		if($numUpdated ==1){
			echo "Suprimé";
			$this->jsutils->get("/dokuMission/Gmonde/refresh/","body");
			echo $this->jsutils->compile();
		}
	}

}