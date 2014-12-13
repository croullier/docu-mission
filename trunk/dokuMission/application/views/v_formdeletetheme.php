<div id="divDelete">
<fieldset>
    <legend>Suppression:</legend>
 <?php 
 $doc=false;
	if($theme != null){
		$them="";
		foreach ($theme as $aTheme){
			if($aTheme->getTheme()->getId()!=$them){
				echo "<u>Thème :</u> ".utf8_encode($aTheme->getTheme()->getLibelle())."<br>";
				$them=$aTheme->getTheme()->getId();
			}
			if($doc==false){
				echo "<br><u>Document associé :</u><br>- " .utf8_encode($aTheme->getTitre())."<br>";
				$doc=true;
			}
			else{
				echo "- ".utf8_encode($aTheme->getTitre())."<br>";
			}
		}
	}else{
		echo"Aucun document associé";
	}
	
	if($doc==true){
?>	
		<br><span>Souhaitez-vous également supprimer les documents ?</span><br>
		<form id="frmDelete" name="frmDelete">
			<label for="rdYes">Oui</label><input type= "radio" id="rdYes" name="docs" value="oui"> 
			<label for="rdNo">Non</label><input type= "radio" id="rdNo" name="docs" value="non" checked><br>
			
			<input type="button" id="btDelete" value="Supprimer">
		</form>
<?php 
	}
?>

 </fieldset>
</div>
<div id="message"></div>