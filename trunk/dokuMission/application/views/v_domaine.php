<?php 
echo $library_src;
echo $script_foot;
echo validation_errors();
echo form_open('Gdomaine/add/');
foreach ($domaines as $domaine){
	echo("<table border=1><tr><td>".$domaine->getLibelle()."</td><td><a href='#' class='update' id='".$domaine->getId()."'>Modif</a></td><td><a href='#' class='delete' id='".$domaine->getId()."'>Suppr</a></td></tr></table>");	
}
?>
<br>
Ajouter: <input type='text' name='domaine'><input type='submit' value='Insérer'>

	<div id="modifier" style="display:none;">
		Modifier: <input type='text' name='update_domaine'><input type='submit' value='Insérer'>
	</div>
<div id="message">
</div> 