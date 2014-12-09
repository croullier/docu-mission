
<div id="contain">
 <?php echo $library_src;?>
<?php echo $script_foot;?>

<h1>Gestion des mondes</h1>
<?php 
foreach ($mondes as $monde){
	echo("<div class='space'>".$monde->getLibelle(). " </div><div class='space'> <a href='#' class='update' id='".$monde->getId()."'>Modifier </a></div><div class='space'><a href='#' class='delete' id='".$monde->getId()."'>Supprimer </a></div><br>");
	echo "<div class='underline'></div>";
}

?>
<div class="clear"></div>
	<form id="frmAddMonde" name="frmAddMonde">
		<label for="libelle">Ajouter:</label> <input type="text" name="libelle" id="libelle">
		<input type="button" value="Ajouter" id="btAdd">
	</form>
	
	<div id="modifier" style="display:none;">
		<form id="frmUpdateMonde" name="frmUpdateMonde">
			<label for="libelle">Modifier:</label> <input type="text" name="libelle" id="libelle">
			<input type="button" value="Modifier" id="btUpdate">
		</form>
		<a href="#" id="addMonde">Ajouter</a>
	</div>
	
<div id="message">
</div>
</div>
