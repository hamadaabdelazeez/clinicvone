<?php
class Appointments extends Admin_Module {
	protected $_module = "Appointments";
	protected $_trash = false;
	protected $_model = "appointment_m";
	protected $table_prefix = "appt_";
	protected $views = "appointments";
	protected $objects_name = "appointments";
	protected $object_name = "appointment";
	protected $form_fields = array('appt_patient_id','appt_patient_num','patient_name','patient_mobile','patient_gender','appt_clinic_id','appt_status','appt_date','appt_start','appt_end','appt_cost','appt_comments');
    public function __construct(){
        parent::__construct();
		$this->data["Module_title"] = "Appointments";
		$this->load->model("appointment_m");
    }

}
