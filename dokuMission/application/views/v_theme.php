
<div id="contain">
 <?php echo $library_src;?>
<?php echo $script_foot;
?>

<h1>Gestion des thèmes</h1>
<div id="containListe">
<?php
//var_dump($themes);
echo"<h2>Domaine :</h2>"; 
$whatDomaine="";
$i=0;
if($themes!=null){
foreach ($themes as $theme){
	if($whatDomaine != $theme->getDomaine()->getId()){
		echo "<h3>".$theme->getDomaine()->getLibelle()."</h3>";
		$whatDomaine=$theme->getDomaine()->getId();
	}
	$idTheme=$theme->getId();
	echo"<div class='divLibelle'><div class='space'>";
	if($theme->getTheme()!=null){
		echo "Parent: ".$theme->getTheme()->getLibelle()." -> " ;
	}
	echo $theme->getLibelle();
	
		echo"</div><br><div class='space'> <a href='#' class='update' id='".$theme->getId()."-".$whatDomaine."'>Modifier </a></div><div class='space'><a href='#' class='delete' id='".$theme->getId()."-".$whatDomaine."'>Supprimer </a> - ";
	
	foreach ($documents as $doc){
		foreach ($doc as $d){
			if($idTheme==$d->getTheme()->getId()){
				$i++;
			}
			
		}
	}
	echo $i." Document(s)</div></div><br>";
	$i=0;
	echo "<div class='underline'></div>";
}
}
else{
	echo"Pas de th�me.";
}

?>
</div>

<div id="containForm">

<fieldset id="fieldAddTheme">
	<legend>Ajout</legend>
		<form id="frmAddTheme" name="frmAddTheme">
			<div id="sltAddDomaine">
			<label for="sltDomaineAdd">Domaine:</label>
				<select id="sltDomaineAdd" name="sltDomaineAdd">
		<?php foreach ($domaines as $domaine){
					echo"<option value=".$domaine->getId()." id=".$domaine->getId()." class='slt-".$domaine->getId()."'>".$domaine->getLibelle()."</option>";
				}
			?>
				</select>
			</div>
			<div id="sltAddTheme">
			<label for="sltThemeAdd">Thème<br>parent:</label>
				<select id="sltThemeAdd" name="sltThemeAdd">
					<option>Aucun</option>
				</select>
			</div>
			<label for="libelle">Ajouter:</label> <input type="text" name="libelle" id="libelle"><br>
			<input type="button" value="Ajouter" id="btAdd">
		</form>
</fieldset>
	
	
	
	<div id="modifier" style="display:none;">
		<form id="frmUpdateTheme" name="frmUpdateTheme">
			<div id="sltUpdate">
			<label for="sltDomaineUpdate">Domaine:</label>
				<select id="sltDomaineUpdate" name="sltDomaineUpdate">
		<?php foreach ($domaines as $domaine){
					echo"<option value=".$domaine->getId().">".$domaine->getLibelle()."</option>";
				}
			?>
				</select>
			</div>
			<div id="sltUpdateTheme">
				<label for="sltThemeUpdate">Thème<br>parent:</label>
				<select id="sltThemeUpdate" name="sltThemeUpdate">
					<option>Aucun</option>
				</select>
			</div>
			<label for="libelle">Remplacer <span id="targetTheme"></span>:</label><br>
			<input type="text" name="libelle" id="libelle"><br>
			<input type="button" value="Modifier" id="btUpdate">
		</form>
		<a href="#" id="addTheme">Ajouter</a>
	</div>
</div>
<div class="clear"></div>

<div id="message"></div> 

</div>
<div class="clear"></div>
