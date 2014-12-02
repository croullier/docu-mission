<?php
//var_dump($documents);
foreach ($documents as $docs){
	echo $docs->getDocument()->getTitre()."<br>";
}