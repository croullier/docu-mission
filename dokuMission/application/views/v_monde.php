 <body>

 <?php echo $library_src;?>
<?php echo $script_foot;?>
<?php 
echo validation_errors();
echo form_open('Gmonde/add/');

foreach ($mondes as $monde){
	echo("<table border=1><tr><td>".$monde->getLibelle()."</td><td><a href='#' class='update' id='".$monde->getId()."'>Modif</a></td><td><a href='#' class='delete' id='".$monde->getId()."'>Suppr</a></td></tr></table>");	
}

?>

<br>
Ajouter: <input type='text' name='monde'><input type='submit' value='Insérer'>

<?php
echo form_close();
?>
<?php 	echo form_open('Gmonde/update/'); ?>
	
	<div id="modifier" style="display:none;">
		Modifier: <input type='text' name='update_monde'><input type='submit' value='Insérer'>

	</div>
	<?php echo form_close(); ?>
<div id="message">
</div>

</body>