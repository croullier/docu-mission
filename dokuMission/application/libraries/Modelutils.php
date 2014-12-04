<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelutils {
	
	/**
	 * Retourne une instance de utilisateur courant stocké en variable de session
	 * @return Utilisateur
	 */
	public function getActiveUser(){
		return "moi";
	}
}