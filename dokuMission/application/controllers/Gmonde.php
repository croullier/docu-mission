<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmonde extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
		$this->load->library('Modelutils');
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
		//Supprime le monde sur lequel on a cliqu�
		$this->jsutils->getAndBindTo(".delete","click","Gmonde/delete","#message","{}");
		//Appel la m�thode monde_modif 
		$this->jsutils->getAndBindTo(".update","click","Gmonde/monde_modif","#message","{}");

		$this->jsutils->click("#addMonde",$this->jsutils->show("#frmAddMonde"));
		$this->jsutils->click("#addMonde",$this->jsutils->hide("#modifier"));
		//Affiche le formulaire de mise � jour du nom

		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->click(".update",$this->jsutils->hide("#frmAddMonde"));
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT DISTINCT m FROM Monde m");
		$monde = $query->getResult();
		$this->load->view('v_monde',array('mondes'=>$monde));
	}
	
	/**
	 * Ajouter le monde � la Base de donn�e 
	 */
	public function add(){	
		if(!empty($_POST['libelle'])){
			//Supprime les caract�re non acceptable
			$libelle=htmlspecialchars($_POST['libelle']);
			$monde = new Monde();
			$monde->setLibelle($libelle);
			$this->doctrine->em->persist($monde);
			$this->doctrine->em->flush();
			//On test que l'insertion � fonctionn�
			if($monde->getId()!=null){
				echo "Ajout�";
				$this->jsutils->get("/dokuMission/Gmonde/index/","body");
				echo $this->jsutils->compile();
			}
		}
	}
	
	/**
	 * Ajoute l'id du monde dans le formulaire et appel la m�thode update pour mettre � jour dans la base
	 * @param $param
	 */
	public function monde_modif($param){		
		$this->jsutils->doSomethingOn("#frmUpdateMonde", "append","'<input type=\"hidden\" name=\"key\" value=\"$param\">'");
		$this->jsutils->getAndBindTo("#update", "click", "Gmonde/update/","#message");
		$this->jsutils->postFormAndBindTo("#btUpdate", "click", "/dokuMission/Gmonde/update/", "frmUpdateMonde","#message");
		
		echo $this->jsutils->compile();
	}
	/**
	 * Met � jour dans la base le nom du monde
	 */
	public function update(){
		if($this->modelutils->ifempty(array($_POST['libelle'],$_POST['key']))==true){
			$libelle=htmlspecialchars($_POST['libelle']);
			$key=htmlspecialchars($_POST['key']);
			$query = $this->doctrine->em->createQuery("UPDATE Monde m SET m.libelle='".$libelle."' WHERE m.id='".$key."' ");
			//execute la requ�te
			$numUpdated = $query->execute();
			if($numUpdated ==1){
				echo "Mis � jour";
				$this->jsutils->get("/dokuMission/Gmonde/index/","body");
				echo $this->jsutils->compile();
			}
		}
		else{
			echo "Erreur";
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
			echo "Suprim�";
			$this->jsutils->get("/dokuMission/Gmonde/index/","body");
			echo $this->jsutils->compile();
		}
	}

}