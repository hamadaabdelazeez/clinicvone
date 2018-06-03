<?php
class appointment_m extends MY_Model{
	protected $_table_name = APPOINTMENTS_TABLE;
	public $_order_by = ' appt_id DESC ';
	protected $_table_prefix = "appt_";
	public $rules = array(
		'appt_patient_num' => array(
			'field' => 'appt_patient_num',
			'label' => "Patient Number",
			'rules' => 'trim|required|xss_clean'
		),
		'appt_clinic_id' => array(
		  'field' => 'appt_clinic_id',
		  'label' => "Clinic",
		  'rules' => 'trim|required|xss_clean'
		),
		'appt_status' => array(
		  'field' => 'appt_status',
		  'label' => "Appointment status",
		  'rules' => 'trim|required|xss_clean'
		),
		'appt_date' => array(
		  'field' => 'appt_date',
		  'label' => "Appointment date",
		  'rules' => 'trim|required|xss_clean'
		),
		'appt_cost' => array(
		  'field' => 'appt_cost',
		  'label' => "Cost",
		  'rules' => 'trim|required|xss_clean'
		),
	);
	function __construct() {
		parent::__construct();
	}
	public function apply_filter($once = false){
		if(!empty($_GET) && empty($_GET["search"])){
			if(!empty($_GET["s"]) || (!empty($_GET["order_by"]) && $_GET["order_by"] == "patient_key")){
				$this->db->join($this->db->dbprefix."patients", 'cld_patients.patient_id = cld_appointments.appt_patient_id');
			}
			if(!empty($_GET["order_by"]) && $_GET["order_by"] == "clinic_title"){
				$this->db->join($this->db->dbprefix."clinics", 'cld_clinics.clinic_id = cld_appointments.appt_clinic_id');
			}
			foreach($_GET as $key=>$value){
				if(empty($value))continue;
				switch($key){
					case "s":
						$this->db->where("patient_key LIKE '%".$value."%'");
					break;
					case "appt_from":
						$this->db->where("DATE(appt_date) >= DATE('".$value."')");
					break;
					case "appt_to":
						$this->db->where("DATE(appt_date) <= DATE('".$value."')");
					break;
					case "clinic_id":
						$this->db->where("appt_clinic_id",intval($value));
					break;
					case "order_by":
						$this->db->order_by($value." ".$_GET["order_type"]);
					break;
				}
			}
		}
	}

}
