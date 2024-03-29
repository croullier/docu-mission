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
		$user=1;
		//Poste le formulaire de modification des thèmes
		$this->jsutils->postFormAndBindTo("#btAdd", "click", "/dokuMission/Gtheme/add/", "frmAddTheme","#message");
		//Supprime le thème sur lequel on a cliqué
		$this->jsutils->getAndBindTo(".delete","click","Gtheme/deleteForm","#message","{}");
		//Appel la méthode theme_modif 
		$this->jsutils->getAndBindTo(".update","click","Gtheme/theme_modif","#message","{}");
		$this->jsutils->click("#addTheme",$this->jsutils->show("#fieldAddTheme"));
		$this->jsutils->click("#addTheme",$this->jsutils->hide("#modifier"));
		//Affiche le formulaire de mise à jour du nom
		$this->jsutils->click(".update",$this->jsutils->show("#modifier"));
		$this->jsutils->click(".update",$this->jsutils->hide("#fieldAddTheme"));
		//$this->jsutils->getAndBindTo(".update", "click", "Gtheme/domaineUpdate","#message");
		$this->jsutils->getAndBindTo("#sltDomaineAdd", "change", "Gtheme/addParentThem/","#message","{}","","value");
		$this->jsutils->external();
		$this->jsutils->compile();
		//Rr�cup�re tout les th�mes d'un utilisateur
		$query = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d JOIN t.utilisateur u WHERE u.id=:utilisateur");
		$query->setParameter('utilisateur',$user);
		$theme = $query->getResult();
		//R�cup�ration des documents appartenant au th�me
		foreach ($theme as $t){
			$queryDoc = $this->doctrine->em->createQuery("SELECT d FROM Document d JOIN d.theme t WHERE t=:id");
			$queryDoc->setParameter('id', $t->getId());
			$document[] = $queryDoc->getResult();
		}
		//S�lectionner tous les thdomaine d'un monde
		$queryDomaine = $this->doctrine->em->createQuery("SELECT d FROM Domaine d JOIN d.monde m WHERE m.id=:utilisateur");
		$queryDomaine->setParameter('utilisateur',$user);
		$domaine = $queryDomaine->getResult();
		
		$this->load->view('v_theme',array('themes'=>$theme, 'documents'=>$document, 'domaines'=>$domaine));
	}
	
	/**
	 * Ajouter le thème à la Base de donnée 
	 */
	public function add(){	
		$user=1;
		//On test si les variable ne sont pas vide
		if($this->modelutils->ifempty(array($_POST['libelle'],$_POST['sltThemeAdd'],$_POST['sltDomaineAdd']))==true){
			
			//Supprime les caractère non acceptable
			$libelle=$this->modelutils->cleanPost($_POST['libelle']);
			$themeid=$this->modelutils->cleanPost($_POST['sltThemeAdd']);
			$domaine=$this->modelutils->cleanPost($_POST['sltDomaineAdd']);
			
			$querylibelle=$this->doctrine->em->createQuery("SELECT t FROM theme t WHERE t.libelle=:libelle");
			$querylibelle->setParameter('libelle',$libelle);
			$themelibelle=$querylibelle->getResult();
			
			if($themelibelle==null){
				$theme = new Theme();
				$theme->setLibelle($libelle);
				
				if($themeid!="Aucun"){
					$queryThemeid=$this->doctrine->em->createQuery("SELECT t FROM theme t WHERE t.id=:theme");
					$queryThemeid->setParameter('theme',$themeid);
					$themeid=$queryThemeid->getSingleResult();
					$theme->setTheme($themeid);
				}
				//Instance de domaine
				$queryDomaine=$this->doctrine->em->createQuery("SELECT d FROM domaine d WHERE d.id=:domaine");
				$queryDomaine->setParameter('domaine',$domaine);
				$domaine=$queryDomaine->getSingleResult();
				$theme->setDomaine($domaine);
				//Instance de Utilisateur
				$queryUsere=$this->doctrine->em->createQuery("SELECT u FROM utilisateur u WHERE u.id=:user");
				$queryUsere->setParameter('user',$user);
				$user=$queryUsere->getSingleResult();
				$theme->setUtilisateur($user);
				$this->doctrine->em->persist($theme);
				//Ajout de l'instance th�me
				$this->doctrine->em->flush();
				//On test que l'insertion a fonctionnée
				if($theme->getId()!=null){
					echo "Ajouté ".$theme->getLibelle();
					$this->jsutils->get("/dokuMission/Gtheme/index/","body");
					echo $this->jsutils->compile();
				}
			}
			else{
				echo "Doublons";
			}
		}else{
			echo "Erreur de saisie";
		}
	}
	
	/**
	 * Ajoute l'id du thème dans le formulaire et appel la méode update pour mettre à jour dans la base
	 * @param $param
	 */
	public function theme_modif($param){
		//explosion de la variable pour r�cup�rer les donn�es
		$param=explode("-", $param);
		$domaine=$param[1];
		$theme=$param[0];
		$nameTheme=$this->doctrine->em->createQuery("SELECT t FROM Theme t WHERE t.id=:theme");
		$nameTheme->setParameter('theme',$theme);
		//R�cup�rer un r�sultat 
		$theTheme=$nameTheme->getSingleResult();
		$theTheme=$theTheme->getLibelle();
		//Si l'id est d�ja pr�sent, on le supprime pour �viter tout doublons
		$this->jsutils->doSomethingOn("#nameTargetTheme", "remove");
		$this->jsutils->doSomethingOn("#targetTheme", "append","'<span id=\"nameTargetTheme\">$theTheme par </span>'");
		
		$this->jsutils->doSomethingOn("#key", "remove");
		//Ajout de l'id du th�me sur lequel on travail
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
		$queryTheme = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d WHERE d.id=:param");
		$queryTheme->setParameter('param',$param);
		$qTheme = $queryTheme->getResult();
		//S'il n'y a pas de th�mme alors on affiche une option qui affirme qu'il n'y a pas de th�me pour ce domaine
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
		$queryTheme = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d WHERE d.id=:param");
		$queryTheme->setParameter('param',$param);
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
				$querylibelle=$this->doctrine->em->createQuery("SELECT t FROM theme t WHERE t.libelle=:libelle");
				$querylibelle->setParameter('libelle',$libelle);
				$themelibelle=$querylibelle->getResult();
					
				if($themelibelle==null){
					$query = $this->doctrine->em->createQuery("UPDATE Theme t SET t.libelle=:libelle WHERE t.id=:key ");
					$query->setParameters(array('libelle'=>$libelle,
													'key'=>$key,
					));
					//execute la requête
					$query->execute();
				}else{
					echo"$libelle existe d�j�";
				}
				
			}
		
			if($domaine!=""){
				$query = $this->doctrine->em->createQuery("UPDATE Theme t SET t.domaine=:domaine WHERE t.id=:key ");
				$query->setParameters(array('domaine'=>$domaine,
									'key'=>$key
				));
				//execute la requête
				$query->execute();
			}
			
			if($themeid!=""){
				$query = $this->doctrine->em->createQuery("UPDATE Theme t SET t.theme=:theme WHERE t.id=:key ");
				$query->setParameters(array('theme'=>$themeid,
									'key'=>$key
				));
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
	 * Affiche les documents associ� au th�me
	 * @param $param theme
	 */
	public function deleteForm($param){
		$param=explode("-", $param);
		$query=$this->doctrine->em->createQuery("SELECT d FROM Document d JOIN d.theme t WHERE t=:param");
		$query->setParameter('param',$param[0]);
		$libelle=$query->getResult();
		if($libelle!=null){
			$this->jsutils->postFormAndBindTo("#btDelete", "click", "/dokuMission/Gtheme/saveDocs", "frmDelete","#message");
			$this->jsutils->click("#btCancel",$this->jsutils->hide("#divDelete"));
			$this->jsutils->doSomethingOn("#keyTheme", "remove");
			$this->jsutils->doSomethingOn("#frmDelete", "append","'<input type=\"hidden\" id=\"keyTheme\" name=\"keyTheme\" value=\"$param[0]\">'");
			echo $this->jsutils->compile();
			$this->load->view("v_formdeletetheme",array("theme"=>$libelle));
		}
		else{
			$query=$this->doctrine->em->createQuery("SELECT t FROM Theme t WHERE t=:param");
			$query->setParameter('param',$param[0]);
			$libelleTheme=$query->getSingleResult();
			$this->jsutils->postFormAndBindTo(".btSendDelete", "click", "Gtheme/checkConfirmDelete", "frmconfirmDelete","#message");
			$this->jsutils->click(".btCancel",$this->jsutils->hide("#confirmDelete"));
			$this->jsutils->doSomethingOn("#keyTheme", "remove");
			$this->jsutils->doSomethingOn("#frmconfirmDelete", "append","'<input type=\"hidden\" id=\"keyTheme\" name=\"keyTheme\" value=\"$param[0]\">'");
			echo $this->jsutils->compile();
			$this->load->view("v_confirmdeletetheme", array("theme"=>$libelleTheme));
			//echo $this->delete($param[0]);
		}	
	}
	
	/**
	 * Supprime le th�me si coch� oui
	 * @param $param theme
	 */
	public function checkConfirmDelete(){
		if(!empty($_POST['keyTheme'])){
			$this->delete($_POST['keyTheme']);			
		}
		else{
			echo "une erreur est arriv�e";
		}
	}
	
	
	/**
	 * Si on garde les doccuments ou on les supprimes avec les th�mes
	 * @param $param
	 */
	public function saveDocs($param){
		if(!empty($_POST['keyTheme'])){
			if(!empty($_POST['docs'])){
				$this->deleteDocs($_POST['keyTheme']);
				$this->delete($_POST['keyTheme']);
			}
			else{
				$this->updateDocs($_POST['keyTheme']);
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
		$query = $this->doctrine->em->createQuery("DELETE Theme t  WHERE t.id=:param");
		$query->setParameter('param',$param);
		$numDeleted= $query->execute();
		if($numDeleted ==1){
			echo "Suprimé";
			$this->jsutils->get("/dokuMission/Gtheme/index/","body");
			echo $this->jsutils->compile();
		}
	}
	
	/**
	 * met � jour les documents dont le th�me � �tait suprim�
	 * @param unknown $param
	 */
	public function updateDocs($param){
		$query = $this->doctrine->em->createQuery("UPDATE Document d SET d.theme=Null WHERE d.theme=:param");
		$query->setParameter('param',$param);
		//execute la requête
		$v=$query->execute();
	
	}
	
	/**
	 * Supprime les documents d'un th�me
	 * @param $param
	 */
	public function deleteDocs($param){
		$query = $this->doctrine->em->createQuery("DELETE Document d WHERE d.theme=:param");
		$query->setParameter('param',$param);
		$numDeleted= $query->execute();
		if($numDeleted ==1){
			echo "Suprimé";
			$this->jsutils->get("/dokuMission/Gtheme/index/","body");
			echo $this->jsutils->compile();
		}
	}

}