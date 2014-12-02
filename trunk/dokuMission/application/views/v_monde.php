 <?php echo $library_src;?>
<?php echo $script_foot;?>
<?php 

echo validation_errors();
echo form_open('Gmonde/add/');
foreach ($mondes as $monde){
	echo("<table border=1><tr><td>".$monde->getLibelle()."</td><td><a href='#' class='update' id='".$monde->getId()."'>Modif</a></td><td><a href='http://www.siteduzero.com'>Suppr</a></td></tr></table>");	
}
?>
Ajouter: <input type='text' name='monde'><input type='submit' value='Insérer'>


	<div id="modifier" style="display:none;">
		Modifier: <input type='text' name='add_monde'><input type='submit' value='Insérer'>
	</div>
<div id="message">
</div>