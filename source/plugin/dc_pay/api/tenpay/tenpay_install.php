<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

class tenpay_install extends api_install{
	public function __construct(){
		parent::__construct();
		$this->title=$this->_lang['install_title'];
		$this->des=$this->_lang['install_des'];
		$this->author=$this->_lang['install_author'];
		$this->version='v1.0.2';
		$this->logo='logo.gif';
	}
	public function install(){
		return true;
	}
	
	public function uninstall(){
		return true;
	}
	
	public function upgrade($version){
		
	}

}
?>