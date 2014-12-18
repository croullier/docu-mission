<?php 
class Listages extends \BaseCtrl {
	
	public function __construct()
	{
		parent::__construct();
		ob_start(); // mise en forme pour un bon affichage des vues
		$this->load->library('jsUtils');
	}
	
	// Méthode appelée par défault, appel les vues supplémentaire (header, left, footer...)
	public function index(){
		define("WH", "Accueil->Domaine");
		$this->load->view("v_header");
		$this->load->view("v_left");
		$this->refresh(); 
		$this->load->view("v_footer");
	}
	
	// Méthode appelée par l'index et utilisé pour l'affichage initial et le rafraîchissement après une modification
	// Affichage de la vue v_listages et de son contenu
	public function refresh(){
		$this->jsutils->getAndBindTo(".listDomaine", "click", "/dokuMission/Listages/selectDomaine", ".space");
		
    /*getAndBindTo : Effectue une action suite à un événement (les paramètres de l'id Html sont envoyés automatiquement)
      compile : Ajoute la portion de code écrite vers la vue
      doSomethingOn : Peut servir à ajouter ou supprimer des éléments dans un contenu existant*/
		 
		$query = $this->doctrine->em->createQuery("SELECT d FROM Domaine d");
		$domaine = $query->getResult();
		echo $this->jsutils->compile();
		$this->load->view('v_listages',array('domaines'=>$domaine));
		
	}
	
	// Méthode qui permet d'afficher les thèmes correspondant au domaine qui lui est associé.
	public function selectDomaine($param) {
		
		$query = $this->doctrine->em->createQuery("SELECT t FROM Theme t JOIN t.domaine d WHERE d.id=".$param);
		$domaine = $query->getResult();
		
		$passed=false;
		foreach ($domaine as $s){	
			if($passed==false){
				echo "Parent: ".$s->getDomaine()->getLibelle();
				$passed=true;
			}
		}
		
		echo "<h3>Themes:</h3>";
		foreach ($domaine as $dom){
			$do=$dom->getId();
			$this->jsutils->doSomethingOn(".space", "append","'<a href=\"#\" class=\"doc\" id=\"$do\">".$dom->getLibelle()."</a><br>'");
		}
		
		$this->jsutils->getAndBindTo(".doc", "click", "/dokuMission/Listages/selectTheme/".$param, ".space");
		$this->jsutils->getAndBindTo("#return", "click", "/dokuMission/Listages/refresh", "#contain");
		echo $this->jsutils->compile();
		
	}
	
	//  Méthode qui permet d'afficher les documents correspondant au thème qui lui est associé.
	public function selectTheme($domaine,$param) {
		
		$query = $this->doctrine->em->createQuery("SELECT doc FROM Document doc JOIN doc.theme t JOIN t.domaine d WHERE t.id=".$param);
		$doc = $query->getResult();
		
		$passed=false;
		foreach ($doc as $d){
			if($passed==false){
				echo "Parent: ".$d->getTheme()->getDomaine()->getLibelle()." -> " .$d->getTheme()->getLibelle();
				$passed=true;
			}
		}
		
		echo "<h3>Documents:</h3>";
		foreach ($doc as $th){
			$this->jsutils->doSomethingOn(".space", "append","'<span>".$th->getTitre()."</span><br>'");
		}
		$this->jsutils->getAndBindTo("#return", "click", "/dokuMission/Listages/selectDomaine/".$domaine, "#contain");
		echo $this->jsutils->compile();
		
	}

	
}