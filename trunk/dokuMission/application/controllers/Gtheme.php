<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gtheme extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('jsUtils');
		$this->load->library('Modelutils');
	}
	
	public function index(){
		define("WH", "Accueil->Gestion->Thème");
		$this->load->view("v_header");
		$this->load->view("v_left");
		$this->refresh();
		$this->load->view("v_footer");
	}

	public function refresh(){
		//Poste le formulaire de modification des thèmes
		$this->jsutils->postFormAndBindTo("#btAdd", "click", "/dokuMission/Gtheme/add/", "frmAddTheme","#message");
		//Supprime le thème sur lequel on a cliqué
		$this->jsutils->getAndBindTo(".delete","click","Gtheme/deleteForm","#message","{}");
		//Appel la méthode monde_modif 
		$this->jsutils->getAndBindTo(".update","click","Gtheme/monde_modif","#message","{}");
		$this->jsutils->click("#addTheme",$this->jsutils->show("#frmAddTheme"));
		$this->jsutils->click("#addTheme",$this->jsutils->hide("#modifier"));
		//Affiche le formulaire de mise à jour du nom
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->click(".update",$this->jsutils->hide("#frmAddTheme"));
		//$this->jsutils->getAndBindTo(".update", "click", "Gtheme/domaineUpdate","#message");
		$this->jsutils->getAndBindTo("#sltDomaineAdd", "change", "Gtheme/addParentThem/","#message","{}","","value");
		$this->jsutils->external();
		$this->jsutils->compile();
		$query = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d JOIN t.utilisateur u WHERE u.id=1");
		$theme = $query->getResult();
		
		foreach ($theme as $t){
			$queryDoc = $this->doctrine->em->createQuery("SELECT d FROM Document d JOIN d.theme t WHERE t=".$t->getId());
			$document[] = $queryDoc->getResult();
		}
		
		$queryDomaine = $this->doctrine->em->createQuery("SELECT d FROM Domaine d JOIN d.monde m WHERE m.id=1");
		$domaine = $queryDomaine->getResult();
		
		$this->load->view('v_theme',array('themes'=>$theme, 'documents'=>$document, 'domaines'=>$domaine));
	}
	
	/**
	 * Ajouter le thème à la Base de donnée 
	 */
	public function add(){	
		$user=1;
		if($this->modelutils->ifempty(array($_POST['libelle'],$_POST['sltThemeAdd'],$_POST['sltDomaineAdd']))==true){
			
			//Supprime les caractère non acceptable
			$libelle=$this->modelutils->cleanPost($_POST['libelle']);
			$themeid=$this->modelutils->cleanPost($_POST['sltThemeAdd']);
			$domaine=$this->modelutils->cleanPost($_POST['sltDomaineAdd']);
			$theme = new Theme();
			$theme->setLibelle($libelle);
			if($themeid!="Aucun"){
				$queryThemeid=$this->doctrine->em->createQuery("SELECT t FROM theme t WHERE t.id=$themeid");
				$themeid=$queryThemeid->getSingleResult();
				$theme->setTheme($themeid);
			}

			$queryDomaine=$this->doctrine->em->createQuery("SELECT d FROM domaine d WHERE d.id=$domaine");
			$domaine=$queryDomaine->getSingleResult();
			$theme->setDomaine($domaine);
			$queryUsere=$this->doctrine->em->createQuery("SELECT u FROM utilisateur u WHERE u.id=$user");
			$user=$queryUsere->getSingleResult();
			$theme->setUtilisateur($user);
			$this->doctrine->em->persist($theme);
			$this->doctrine->em->flush();
			//On test que l'insertion a fonctionnée
			if($theme->getId()!=null){
				echo "Ajouté ".$theme->getLibelle();
				$this->jsutils->get("/dokuMission/Gtheme/index/","body");
				echo $this->jsutils->compile();
			}
		}else{
			echo "Erreur de saisie";
		}
	}
	
	/**
	 * Ajoute l'id du thème dans le formulaire et appel la méode update pour mettre à jour dans la base
	 * @param $param
	 */
	public function monde_modif($param){
		$param=explode("-", $param);
		$domaine=$param[1];
		$theme=$param[0];
		$nameTheme=$this->doctrine->em->createQuery("SELECT t FROM Theme t WHERE t.id=$theme");
		$theTheme=$nameTheme->getSingleResult();
		$theTheme=$theTheme->getLibelle();
		$this->jsutils->doSomethingOn("#nameTargetTheme", "remove");
		$this->jsutils->doSomethingOn("#targetTheme", "append","'<span id=\"nameTargetTheme\">$theTheme par </span>'");
		
		$this->jsutils->doSomethingOn("#key", "remove");
		$this->jsutils->doSomethingOn("#frmUpdateTheme", "append","'<input type=\"hidden\" id=\"key\" name=\"key\" value=\"$theme\">'");
		$this->jsutils->doSomethingOn("#sltDomaineUpdate", "val","$domaine");	
		$this->updateParentThem($domaine);
		
		$this->jsutils->getAndBindTo("#update", "click", "Gtheme/update/","#message");
		$this->jsutils->postFormAndBindTo("#btUpdate", "click", "/dokuMission/Gtheme/update", "frmUpdateTheme","#message");
		
		echo $this->jsutils->compile();
	}
	
	/**
	 * Ajoute les options au select
	 */
	public function addParentThem($param){
		$this->jsutils->doSomethingOn("#sltThemeAdd option", "remove");
		$queryTheme = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d WHERE d.id=".$param);
		$qTheme = $queryTheme->getResult();
		if($qTheme == null){
			$this->jsutils->doSomethingOn("#sltThemeAdd", "append","'<option>Aucun</option>'");
		}
		$value=false;
		foreach ($qTheme as $qt){
			if($value==false){
				$this->jsutils->doSomethingOn("#sltThemeAdd", "append","'<option>Aucun</option>'");
				$value=true;
			}
			$them=$qt->getId();
			$this->jsutils->doSomethingOn("#sltThemeAdd", "append","'<option value=\"$them\">".$qt->getLibelle()."</option>'");
		}
		echo $this->jsutils->compile();
	}
	
	/**
	 * Mise � jour les options au select
	 */
	public function updateParentThem($param){
		$this->jsutils->doSomethingOn("#sltThemeUpdate option", "remove");
		$queryTheme = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d WHERE d.id=".$param);
		$qTheme = $queryTheme->getResult();
		if($qTheme == null){
			$this->jsutils->doSomethingOn("#sltThemeUpdate", "append","'<option>Aucun</option>'");
		}
		$value=false;
		foreach ($qTheme as $qt){
			if($value==false){
				$this->jsutils->doSomethingOn("#sltThemeUpdate", "append","'<option>Aucun</option>'");
				$value=true;
			}
			$them=$qt->getId();
			$this->jsutils->doSomethingOn("#sltThemeUpdate", "append","'<option value=\"$them\">".$qt->getLibelle()."</option>'");
		}
		echo $this->jsutils->compile();
	}

	/**
	 * Met à jour les données dans la table thème
	 */
	public function update(){
		$user=1;
		if($this->modelutils->ifempty(array($_POST['sltThemeUpdate'],$_POST['sltDomaineUpdate'],$_POST['key']))==true){
			$libelle=$this->modelutils->cleanPost($_POST['libelle']);
			$themeid=$this->modelutils->cleanPost($_POST['sltThemeUpdate']);
			$domaine=$this->modelutils->cleanPost($_POST['sltDomaineUpdate']);
			$key=$this->modelutils->cleanPost($_POST['key']);
			if($themeid=="Aucun"){
				$themeid="";
			}

			$user=$user;
			if($libelle!=""){
				$query = $this->doctrine->em->createQuery("UPDATE Theme t SET t.libelle='".$libelle."' WHERE t.id='".$key."' ");
				//execute la requête
				$query->execute();
			}
		
			if($domaine!=""){
				$query = $this->doctrine->em->createQuery("UPDATE Theme t SET t.domaine='".$domaine."' WHERE t.id='".$key."' ");
				//execute la requête
				$query->execute();
			}
			
			if($themeid!=""){
				$query = $this->doctrine->em->createQuery("UPDATE Theme t SET t.theme='".$themeid."' WHERE t.id='".$key."' ");
				//execute la requête
				$query->execute();
			}
			
				$this->jsutils->get("/dokuMission/Gtheme/index/","body");
				echo $this->jsutils->compile();
			
		}
		else{
			echo "Erreur";
		}
		
	}	
	
	/**
	 * 
	 * @param $param affiche les documents associ� au th�me
	 */
	public function deleteForm($param){
		$param=explode("-", $param);
		$query=$this->doctrine->em->createQuery("SELECT d FROM Document d JOIN d.theme t WHERE t=$param[0]");
		$libelle=$query->getResult();
		if($libelle!=null){
			$this->jsutils->postFormAndBindTo("#btDelete", "click", "/dokuMission/Gtheme/saveDocs", "frmDelete","#message");
			$this->jsutils->doSomethingOn("#keyTheme", "remove");
			$this->jsutils->doSomethingOn("#frmDelete", "append","'<input type=\"hidden\" id=\"keyTheme\" name=\"keyTheme\" value=\"$param[0]\">'");
			echo $this->jsutils->compile();
			$this->load->view("v_formdeletetheme",array("theme"=>$libelle));
		}
		else{
			echo $this->delete($param[0]);
		}	
	}
	
	/**
	 * Si on garde les doccuments ou on les supprimes avec les th�mes
	 * @param $param
	 */
	public function saveDocs($param){
		if(!empty($_POST['docs'])){
			if($_POST['docs']=="non"){
				$this->delete($_POST['keyTheme']);
			}
			else{
				$this->deleteDocs($_POST['keyTheme']);
				$this->delete($_POST['keyTheme']);	
			}
		}
		else{
			echo "une erreur est arriv�e";
		}
	}
	
	/**
	 * Supprime le thème
	 * @param $param
	 */
	public function delete($param){
		$query = $this->doctrine->em->createQuery("DELETE Theme t  WHERE t.id='".$param."'");
		$numDeleted= $query->execute();
		if($numDeleted ==1){
			echo "Suprimé";
			$this->jsutils->get("/dokuMission/Gtheme/index/","body");
			echo $this->jsutils->compile();
		}
	}
	
	/**
	 * Supprime les documents d'un th�me
	 * @param $param
	 */
	public function deleteDocs($param){
		$query = $this->doctrine->em->createQuery("DELETE Document d WHERE d.theme='".$param."'");
		$numDeleted= $query->execute();
		if($numDeleted ==1){
			echo "Suprimé";
			$this->jsutils->get("/dokuMission/Gtheme/index/","body");
			echo $this->jsutils->compile();
		}
	}

}