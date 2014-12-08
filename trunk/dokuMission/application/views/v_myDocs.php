<div id="contain">
 <?php echo $library_src;?>
<?php echo $script_foot;?>

<h1>Gestion de mes documents</h1>
<?php
//var_dump($documents);
foreach ($documents as $docs){
	echo("<div class='space'>".$docs->getDocument()->getTitre(). " </div><div class='space'> <a href='#' class='update' id='".$docs->getDocument()->getId()."'>Editer </a></div><div class='space'><a href='#' class='delete' id='".$docs->getDocument()->getId()."'>Supprimer </a></div><br>");
	echo "<div class='underline'></div>";
}

?>
<div id="modifier" style="display:none">
<form id="frmUpdateMonde" name="frmUpdateMonde">
<label for="libelle">Modifier:</label> <input type="text" name="libelle" id="libelle">
<input type="button" value="Modifier" id="btUpdate">
</form>
</div>

<div id="message">
</div>





</div>