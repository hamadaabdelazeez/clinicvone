<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Homepage extends CI_Controller{
	protected $_trash = false;
	public $data = array();
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$site_name = config_item("site_frontend_title");
	    $this->data["page_title"] =_lang("Home");
		die("Version : ".$this->migration->current());
		$this->load->view("homepage",$this->data);
	}
}
