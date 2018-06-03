<?php
class Qajax extends MY_Controller {
	public $_backstage_dir;
	public $site_lang = "en";
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->_backstage_dir = config_item("backstage_dir");
		$ci =& get_instance();
		// load_Language($this->site_lang);
	}
	public function index(){
		die("Invalid Access");
	}

	public function get_patient(){
		$patient_num=$_POST["patient_num"];
		$this->load->model("patient_m");
		$this->db->where("patient_key",$patient_num);
		$patient=$this->patient_m->get('',true);
		// var_dump($patient);
		if (!empty($patient)){
			$patient_id=!empty($patient->patient_id)?$patient->patient_id	:"";
			$patient_name=!empty($patient->patient_name)?$patient->patient_name:"";
			$patient_mobile=!empty($patient->patient_mobile)?$patient->patient_mobile	:"";
			$patient_gender=!empty($patient->patient_gender)?$patient->patient_gender	:"";
			$output=$patient_id."#".$patient_name."#".$patient_mobile."#".$patient_gender;
			echo $output;
		}
		else {
			echo 1;
		}

		die();
	}
}
