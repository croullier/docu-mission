<?php
foreach ($utilisateurs as $user){
	echo($user->getNom()." (".$user->getGroupe()->getLibelle().")<br>");
}
?>