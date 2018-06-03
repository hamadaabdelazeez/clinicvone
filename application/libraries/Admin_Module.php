<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* This controller will handle the foloowing modules in public area
- Activities
*/
class Admin_Module extends Admin_Controller{
	protected $_module = "";
	protected $_trash = false;
	protected $_model = "";
	protected $table_prefix = "";
	protected $views = "";
	protected $objects_name = "";
	protected $object_name = "";
	protected $form_fields = array();
	function __construct(){
		parent::__construct();
		$this->data["accessible"] = true;
	}
	public function index() {
		if(!$this->_has_access)return;
		$_page = ci_get_str_parameter("_page");
		if(!empty($_page))$this->_page = $_page;
		$this->data["_page"] = $this->_page;
		$_model = $this->_model;
		$all_objects = $this->$_model->get_all(true,$this->_trash);
		$_count = count($all_objects);
		// Fetch all users pagniated
		$pagination                   = new Mine_pagination($this->_page, $this->_per_page, $_count);
		$this->$_model->limit    = $this->_per_page;
		$this->$_model->offset = $pagination->offset();
		if(!empty($_GET["order"]) && !empty($_GET["orderby"])){
			$this->$_model->set_order_by($_GET["orderby"]." ".$_GET["order"]);
		}else{
			//$this->$_model->set_order_by(" ".$this->table_prefix."id DESC ");
			$this->$_model->set_order_by($this->$_model->_order_by);
		}
		$this->data[$this->objects_name] 	= $this->$_model->get('',false,true,$this->_trash);
		if($this->objects_name == "appointments"){
			$this->load->model("patient_m");
			$patients = $this->patient_m->get('',false,true,$this->_trash,"",true);
			$patients_options = array();
			foreach($patients as $patient){
				$patients_options[$patient->patient_id] = array("name"=>$patient->patient_name,"number"=>$patient->patient_key);
			}
			unset($patients);
			$this->load->model("clinic_m");
			$clinics = $this->clinic_m->get('',false,true,$this->_trash,"",true);
			$clinics_options = array();
			foreach($clinics as $clinic){
				$clinics_options[$clinic->clinic_id] = $clinic->clinic_title;
			}
			unset($clinics);
			$this->data["clinics_options"] = $clinics_options;
		}
		if($this->objects_name == "clinics" || $this->objects_name == "patients" || $this->objects_name == "appointments"){
			if(!empty($this->data[$this->objects_name])){
				foreach($this->data[$this->objects_name] as $_object){
					if($this->objects_name == "appointments"){
						if(!empty($clinics_options[$_object->appt_clinic_id])){
							$_object->clinic_title = $clinics_options[$_object->appt_clinic_id];
						}else{
							$_object->clinic_title = " --- ";
						}
						if(!empty($patients_options[$_object->appt_patient_id])){
							$_object->patient_name = $patients_options[$_object->appt_patient_id]["name"];
							$_object->patient_key = $patients_options[$_object->appt_patient_id]["number"];
						}else{
							$_object->patient_name = " --- ";
							$_object->patient_key = " --- ";
						}
					}
				}
			}
		}
		$this->data["links"]        = ci_draw_pagination_links($pagination, $this->_controller, $this->_page);
		$this->data['subview'] = $this->_backstage_dir.'/'.$this->views.'/index';
		$this->load_admin_view();
    }
	public function add(){
		$this->edit();
	}
	public function edit ($id = NULL){
		$_model = $this->_model;
		if ($id) {
			$this->data[$this->object_name] = $this->$_model->get($id);
			if(!$this->valid_object($this->data[$this->object_name]))return;
			count($this->data[$this->object_name]) || $this->data['errors'][] = $this->object_name.' could not be found';
		}
		else {
			$this->data[$this->object_name] = $this->$_model->get_new();
		}
		if($this->objects_name == "appointments"){
			$this->load->model("patient_m");
			if (!empty($this->data[$this->object_name]->appt_patient_id)) {
				$this->db->select("patient_key,patient_name,patient_mobile,patient_gender");
				$patient=$this->patient_m->get($this->data[$this->object_name]->appt_patient_id,true);
				$this->data[$this->object_name]->appt_patient_num = $patient->patient_key;
				$this->data[$this->object_name]->patient_name = $patient->patient_name;
				$this->data[$this->object_name]->patient_mobile = $patient->patient_mobile;
				$this->data[$this->object_name]->patient_gender = $patient->patient_gender;
			}
			else {
				$this->data[$this->object_name]->appt_patient_num="";
				$this->data[$this->object_name]->patient_name = "";
				$this->data[$this->object_name]->patient_mobile = "";
				$this->data[$this->object_name]->patient_gender = "";
			}
		}
		if($this->objects_name == "appointments"){
			$this->load->model("clinic_m");
			$clinics = $this->clinic_m->get('',false,true,$this->_trash,"",true);
			$this->data["clinics"] = $clinics;
			$clinics_arr = array();
			foreach($clinics as $clinic){
				$clinics_arr[$clinic->clinic_id] = $clinic->clinic_title;
			}
			$this->data["clinics_options"] = $clinics_arr;
		}
		// Set up the form
		$rules = $this->$_model->rules;
		$this->form_validation->set_rules($rules);
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->$_model->array_from_post($this->form_fields);
			if($this->objects_name == "appointments"){
				$this->load->model("patient_m");
				$patient_data=array("patient_key"=>$data["appt_patient_num"],"patient_name"=>$data["patient_name"],"patient_mobile"=>$data["patient_mobile"],"patient_gender"=>$data["patient_gender"]);
				if(empty($data["appt_patient_id"])){
					$result = $this->patient_m->save($patient_data);
					$patient_id =$this->db->insert_id();
					$data["appt_patient_id"] =$patient_id;				
				}else{					
					$result = $this->patient_m->save($patient_data,$data["appt_patient_id"]);
					$patient_id =$data["appt_patient_id"];
				}
				unset($data["appt_patient_num"]);
				unset($data["patient_name"]);
				unset($data["patient_mobile"]);
				unset($data["patient_gender"]);
			}
			$result = $this->$_model->save($data, $id);
			$the_id = empty($id)? $this->db->insert_id() : $id;
			if($result){
				if(!empty($id)){
					$msg = ucfirst($this->_module).' updated successfully';
				}else
					$msg = ucfirst($this->_module).' added successfully';
			}else{
				$this->session->set_flashdata('result_type', 'danger');
				if(!empty($id))$msg = 'Error while updating '.$this->_module;
				else $msg = 'Error while adding '.$this->_module;
			}
			$this->session->set_flashdata('result', $msg);
			redirect($this->_backstage_dir.'/'.$this->data["_controller"]);
		}
		// Load the view
		$this->data['subview'] = $this->_backstage_dir.'/'.$this->views.'/edit';
		$this->load_admin_view();
	}
}