 <?php echo $library_src;?>
<?php echo $script_foot;?>
<?php 

echo validation_errors();
echo form_open('Gmonde/add/');
foreach ($mondes as $monde){
	echo("<table border=1><tr><td>".$monde->getLibelle()."</td><td><a href='#' class='update'>Modif</a></td><td><a href='http://www.siteduzero.com'>Suppr</a></td></tr></table>");	
}
?>
<div id="message">
	<div id="modifier" style="display:none;">
		Ajouter: <input type='text' name='monde'><input type='submit' value='Insérer'>
	</div>
</div>