<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelutils {
	
	/**
	 * Retourne une instance de utilisateur courant stocké en variable de session
	 * @return Utilisateur
	 */
	public function getActiveUser(){
		$CI =& get_instance();
		return $CI->session->userdata("user");
	}
	
	/**
	 * Nettoie les variables global Post
	 * @param $param
	 * @return string
	 */
	public function cleanPost($param){
		$param=htmlspecialchars($param);
		return $param;	
	}
	
	/**
	 * Récupére un array puis vérifie si une variable est vide
	 * @param $params
	 * @return boolean
	 */
	public function ifempty($params=array()){
		$checked=true;
		foreach ($params as $param){
			if($checked==true){
				if(empty($param)){
					$checked=false;
				}
			}
		}
		return $checked;
	}
}