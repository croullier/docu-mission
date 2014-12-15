<div id="confirmDelete">
	<form id="frmconfirmDelete" name="frmconfirmDelete">
		<fieldset>
			<legend>Suppression</legend>
			<span>Confirmer Suppression de <strong><?php echo $theme->getLibelle() ?></strong> ?</span><br>
			<div id="confYN">
				<label for="rdYes">Oui</label><input type= "radio" id="rdYes" name="them" value="oui"> 
				<label for="rdNo">Non</label><input type= "radio" id="rdNo" name="them" value="non" checked><br>
			</div>
			
			<input type="button" id="btConfirmDelete" value="Envoyer">
				
		</fieldset>
	</form>
</div>
<div id="message"></div>