<?php

class BaseCtrl extends \CI_Controller{
	
	/**
	 * 
	 * @var Modelutils
	 */
	private $modelutils;
	 /**
     * @var CI_JsUtils
     */
    private $jsutils;
     
    /**
     * @var CI_Base
     */
    private $CI;
     
    /**
     * @var Doctrine
     */
    private $doctrine;
     
    /**
     * @var CI_Loader
     */
    private $load;
     
    public function __construct(){ 
   
    	parent::__construct();
    	if(!$this->_isValid()){
    		return $this->_onInvalidControl();
    	}
    }
    
   protected function _isValid(){
    	return true;
    }
    
    protected function _onInvalidControl(){
    	header('HTTP/1.1 401 Unauthorized', true, 401);
    }
}