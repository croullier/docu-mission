<div id="titreDomaine">
<?php 
echo $library_src;
echo $script_foot;

$idmonde="";
$iddom="";
$i=0;
$j=0;
foreach ($domaines as $domaine){
	$iddom=$domaine->getid();
	if ($idmonde!=$domaine->getMonde()->getId()){
		echo "<b>Monde: ".$domaine->getMonde()->getLibelle()."<br><div id='sousTitreDomaine'>Domaine:</div></b>";
		$idmonde=$domaine->getMonde()->getId();
	}
	?></div><div id="contenuDomaine" align=center><?php
	echo("<ul><li>".$domaine->getLibelle()." <a href='#' class='update' id='".$domaine->getId()."'> Modif</a> <a href='#' class='delete' id='".$domaine->getId()."'> Suppr</a></li></ul>");	
	$idDoc="";
	foreach ($documents as $doc){		
		foreach ($doc as $d){
			if($d->getId()==$iddom){
				$i++;
			}
				
		}
	}
	$Docs=$i." Document(s)";
	$i=0;
	echo "<div class='underline'></div>";
	
	$idThe="";
	foreach ($themes as $the){
		foreach ($the as $t){
			if($t->getId()==$iddom){
				$j++;
			}
	
		}
	}
	echo "".$j." Theme(s) - ".$Docs."";
	$j=0;
	echo "<div class='underline'></div>";
}
?>

	<form id="frmAddDomaine" name="frmAddDomaine">
		<br><label for="libelle">Ajouter:</label> <input type='text' name='domaine'><input type='submit' value='Insérer' id="btAdd">
	</form>
	<div id="modifier" style="display:none;">
		<form id="frmUpdateDomaine" name="frmUpdateDomaine">
			<!--  Monde: 	<select name="menu_monde">
          				<option value="0">...</option>
          				<?php #foreach ($domaines as $domaine){?>
          				<option value="<?php #$domaine->getMonde()->getId();?>"><?php #echo $domaine->getMonde()->getLibelle();?>
          				
          				<?php #}?>
     				</select><br>-->
     				
     				<div id="libelleDomaine"></div>
			<label for="libelle">Modifier: </label><input type='text' name='update_domaine'>
			<input type='submit' value='Ins�rer' id="btUpdate">
		</form>
		<a href="#" id="addDomaine">Ajouter</a>
	</div>
	
<div id="message">
</div> 
</div>
<!-- Doc techniques
	Contrôleurs MVC Vue -> Modèle
	Doc des élements ajoutés (procédure/fonctions/méthodes/classes) 
	Varaiables Golable / Session-->
	
	
	
	
	
	