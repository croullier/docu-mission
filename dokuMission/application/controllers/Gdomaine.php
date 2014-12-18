<?php
class Gdomaine extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		ob_start();
		$this->load->library('jsUtils');
	}
	public function index(){
		define("WH", "Accueil->Admin->Gestion->Domaine");
		$this->load->view("v_header");
		$this->load->view("v_left");
		$this->refresh();
		$this->load->view("v_footer");
	}
	public function refresh(){		
		//Ajoute le domaine
		$this->jsutils->postFormAndBindTo("#btAdd", "click", "/dokuMission/Gdomaine/domaine_add/", "frmAddDomaine","#message");
		//Modifie le domaine séléctionner
		$this->jsutils->getAndBindTo(".update","click","Gdomaine/domaine_modif","#libelleDomaine","{}");
		//Supprime le thème sur lequel on a cliqué
		$this->jsutils->getAndBindTo(".delete","click","Gdomaine/domaine_delete","#message","{}");
		//Masque le formulaire de mise à jour du domaine
		$this->jsutils->click("#addDomaine",$this->jsutils->show("#frmAddDomaine"));
		$this->jsutils->click("#addDomaine",$this->jsutils->hide("#modifier"));
		//Affiche le formulaire de mise à jour du domaine
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->click(".update",$this->jsutils->hide("#frmAddDomaine"));
	
		$query = $this->doctrine->em->createQuery("SELECT d FROM Domaine d");
		$domaine = $query->getResult();
		// Boucle Permettant la récupération des documents dans une variable
		foreach ($domaine as $d){			
			$queryDoc =$this->doctrine->em->createQuery("SELECT d FROM Document d JOIN d.theme t JOIN t.domaine do WHERE do.id=".$d->getId());
			$document[] = $queryDoc->getResult();
		}
		// Boucle Permettant la récupération des thèmes dans une variable
		foreach ($domaine as $t){
			$queryDoc =$this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine do WHERE do.id=".$t->getId());
			$theme[] = $queryDoc->getResult();
		}
		
		$queryDomaine = $this->doctrine->em->createQuery("SELECT d FROM Domaine d JOIN d.monde m WHERE m.id=1");
		$domaine = $queryDomaine->getResult();
		$this->jsutils->external();
		$this->jsutils->compile();
		//Affichage des variables de récupération des données
		$this->load->view('v_domaine',array('domaines'=>$domaine,'documents'=>$document,'themes'=>$theme));
			
	}
	//fonction d'ajout d'un domaine
	public function domaine_add(){	
		echo "la";
		$user=1;
		if(!empty($_POST['libelle'])){
			$libelle=htmlspecialchars($_POST['libelle']);
			
			$querylibelle=$this->doctrine->em->createQuery("SELECT do FROM domaine do WHERE do.libelle='$libelle'");
			$domainelibelle=$querylibelle->getResult();
			
			if($domainelibelle==null){
				$domaine = new Domaine();
				$domaine->setLibelle($libelle);
			}
			if($themeid!="Aucun"){
				$queryDomaineid=$this->doctrine->em->createQuery("SELECT  do FROM domaine WHERE do.id=$domaineid");
				$domaineid=$queryDomaineid->getSingleResult();
				$domaine->setDomaine($domaineid);
			}
			//Instance de Utilisateurs
			$queryUsere=$this->doctrine->em->createQuery("SELECT u FROM utilisateur u WHERE u.id=$user");
			$user=$queryUsere->getSingleResult();
			$domaine->setLibelle($libelle);
			$this->doctrine->em->persist($domaine);
			$this->doctrine->em->flush();
			if($domaine->getId()!=null){
				echo "AjoutÃ©".$domaine->getLibelle();
				$this->jsutils->get("/dokuMission/Gdomaine/refresh/","body");
				echo $this->jsutils->compile();
			}
		}
	}

	//fonction d'affichage du champ de modification d'un domaine
	public function domaine_modif($param){
		$query = $this->doctrine->em->createQuery("SELECT d FROM Domaine d WHERE d.id=".$param);
		$domaine = $query->getSingleResult();
		echo $domaine->getLibelle();
		$this->jsutils->doSomethingOn("#frmUpdateDomaine", "append","'<input type=\"hidden\" name=\"key\" value=\"$param\">'");
		
		$this->jsutils->getAndBindTo("#update", "click", "Gdomaine/domaine_update/","#message");
		$this->jsutils->postFormAndBindTo("#btUpdate", "click", "/dokuMission/Gdomaine/domaine_update", "frmUpdateTheme","#message");
		
		echo $this->jsutils->compile();
	}
	
	//fonction de supression d'un domaine
	public function domaine_delete($param){
		$query = $this->doctrine->em->createQuery("DELETE Domaine d WHERE d.id='".$param."'");
		$numDeleted= $query->execute();
		if($numDeleted ==1){
			echo "SuprimÃ©";
			$this->jsutils->get("/dokuMission/Gdomaine/index/","body");
			echo $this->jsutils->compile();
		}
	}	
	//fonction de modification d'un domaine 
	public function domaine_update(){
			$user=1;
			if($this->modelutils->ifempty(array($_POST['btUpdate']))==true){
			
				if($domaineid=="Aucun"){
					$domaineid="";
				}
		
				$user=$user;
				if($libelle!=""){
					$query = $this->doctrine->em->createQuery("UPDATE Domaine d SET d.libelle='".$libelle."' WHERE d.id='".$key."' ");
					//execute la requÃªte
					$query->execute();
				}
					
				$this->jsutils->get("/dokuMission/Gdomaine/index/","body");
				echo $this->jsutils->compile();
					
			}
			else{
				echo "Erreur";
			}
		
		
	}
}