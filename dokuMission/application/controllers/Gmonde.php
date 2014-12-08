<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmonde extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
	}
	public function index(){
		define("WH", "Accueil->Admin->Gestion->Monde");
		$this->load->view("v_header");
		$this->load->view("v_left");
		$this->refresh();
		$this->load->view("v_footer");
	}

	public function refresh(){
		//Poste le formulaire de modification des mondes
		$this->jsutils->postFormAndBindTo("#btAdd", "click", "/dokuMission/Gmonde/add/", "frmAddMonde","#message");
		//Supprime le monde sur lequel on a cliqué
		$this->jsutils->getAndBindTo(".delete","click","Gmonde/delete","#message","{}");
		//Appel la méthode monde_modif 
		$this->jsutils->getAndBindTo(".update","click","Gmonde/monde_modif","#message","{}");
		//Affiche le formulaire de mise à jour du nom
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT m FROM Monde m");
		$monde = $query->getResult();
		$this->load->view('v_monde',array('mondes'=>$monde));
	}
	
	/**
	 * Ajouter le monde à la Base de donnée 
	 */
	public function add(){	
		if(!empty($_POST['libelle'])){
			//Supprime les caractère non acceptable
			$libelle=htmlspecialchars($_POST['libelle']);
			$monde = new Monde();
			$monde->setLibelle($libelle);
			$this->doctrine->em->persist($monde);
			$this->doctrine->em->flush();
			//On test que l'insertion à fonctionné
			if($monde->getId()!=null){
				echo "Ajouté";
				$this->jsutils->get("/dokuMission/Gmonde/refresh/","body");
				echo $this->jsutils->compile();
			}
		}
	}
	
	/**
	 * Ajoute l'id du monde dans le formulaire et appel la méthode update pour mettre à jour dans la base
	 * @param $param
	 */
	public function monde_modif($param){
		
		$this->jsutils->doSomethingOn("#frmUpdateMonde", "append","'<input type=\"hidden\" name=\"key\" value=\"$param\">'");
		$this->jsutils->getAndBindTo("#update", "click", "Gmonde/update/","#message");
		$this->jsutils->postFormAndBindTo("#btUpdate", "click", "/dokuMission/Gmonde/update/", "frmUpdateMonde","#message");
		echo $this->jsutils->compile();
	}
	
	/**
	 * Met à jour dans la base le nom du monde
	 */
	public function update(){
		if(!empty($_POST['libelle']) && !empty($_POST['key'])){
			$libelle=htmlspecialchars($_POST['libelle']);
			$key=htmlspecialchars($_POST['key']);
			$query = $this->doctrine->em->createQuery("UPDATE Monde m SET m.libelle='".$libelle."' WHERE m.id='".$key."' ");
			//execute la requête
			$numUpdated = $query->execute();
			if($numUpdated ==1){
				echo "Mis à jour";
				$this->jsutils->get("/dokuMission/Gmonde/refresh/","body");
				echo $this->jsutils->compile();
			}
		}
		
	}	

	/**
	 * Supprime le monde
	 * @param $param
	 */
	public function delete($param){
		$query = $this->doctrine->em->createQuery("DELETE Monde m  WHERE m.id='".$param."'");
		$numDeleted= $query->execute();
		if($numDeleted ==1){
			echo "Suprimé";
			$this->jsutils->get("/dokuMission/Gmonde/refresh/","body");
			echo $this->jsutils->compile();
		}
	}

}