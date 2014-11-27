<html>
<head>
<title>Ajout utilisateur</title>
</head>
<body>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('utilisateurs/add/'); ?>
 
<h5>Nom d'utilisateur</h5>
<input type="text" name="login" value="<?php echo set_value('login'); ?>" size="50" />
 
<div><input type="submit" value="Ajouter utilisateur" /></div>
 
</form>
 
</body>
</html>