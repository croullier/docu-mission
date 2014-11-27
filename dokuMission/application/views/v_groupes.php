<?php
var_dump($groupes);
foreach ($groupes as $group){
	echo $group->getlibelle()." (";
	 foreach ($group->getUtilisateurs() as $g){
										echo $g->getLogin().")<br>";
	}
	
}
?>