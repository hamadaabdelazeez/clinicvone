<?php 
class MY_Controller extends CI_Controller{
	
	public $data = array();
	public $db_data = array();
	public $view_data = array();
	public $_controller='';
	public $_method='';
	public $_page=1;
	public $site_lang = "";
	public $site_dir = "";
	public $_frontend = false;
	public $encrypt_file_names = true;
	
	function __construct(){
		parent::__construct();
		$this->_controller = $this->router->fetch_class();
		$this->_method = $this->router->fetch_method();
		$this->data['_controller'] = $this->_controller;
		$this->data['_method'] = $this->_method;
		$this->load->library('session');
		$this->site_lang = "en";
		$this->site_dir = ($this->site_lang == "ar")?"rtl":"ltr";
		$this->data['direction'] = $this->site_dir;
		$this->data['_lang'] = $this->site_lang;
		$this->data["site_name"] = config_item("site_name");
	}	
}