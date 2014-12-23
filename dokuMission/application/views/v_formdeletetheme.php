<div id="divDelete">
<fieldset>
    <legend>Suppression:</legend>
 <?php 
 $doc=false;
 $t=false;
	if($theme != null){
		$them="";
		foreach ($theme as $aTheme){
			if($aTheme->getTheme()->getId()!=$them){
				echo "<u>Thème :</u> ".$aTheme->getTheme()->getLibelle()."<br>";
				$them=$aTheme->getTheme()->getId();
			}
			/*if($doc==false){
				echo "<br><u>Document associé :</u><br>- " .$aTheme->getTitre()."<br>";
				$doc=true;
			}
			else{
				echo "- ".$aTheme->getTitre()."<br>";
			}
		}
	}else{
		echo"Aucun document associé";
	}*/
	if($t==false){
?>	
<form id="frmDelete" name="frmDelete">
		<br><span>Souhaitez-vous également supprimer les documents ?</span><br>
		<?php 
		$t=true;
	}
			if($doc==false){
				echo "<br><u>Document associé :</u><br><br>- " .$aTheme->getTitre()."<br><br>";
				$doc=true;
			}
			else{
				echo "- ".$aTheme->getTitre()."<br><br>";
			}
		?>
			
<?php 
	}
	echo'<input type= "checkbox" id="rdYes" name="docs"><label for="ckYes">Oui</label> <br>
		
	<input type="button" id="btDelete" value="Supprimer">
	<input type="button" id="btCancel" value="Annuler">
	</form>';
}else{
	echo"Aucun document associé";
}
?>

 </fieldset>
</div>
<div id="message"></div>