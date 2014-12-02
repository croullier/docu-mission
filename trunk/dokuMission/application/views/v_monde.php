 
<?php 
echo validation_errors();
echo form_open('Gmonde/add/');
foreach ($mondes as $monde){
	echo("<table border=1><tr><td>".$monde->getLibelle()."</td><td><a href='#' id='update'>Modif</a></td><td><a href='http://www.siteduzero.com'>Suppr</a></td></tr></table>");	
}
echo "Ajouter: <input type='text' name='monde'><input type='submit' value='Insérer'>";
?>
<div id="modifier" style="display:none;">moi</div>