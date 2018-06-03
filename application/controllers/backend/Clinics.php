<?php
class Clinics extends Admin_Module {
	protected $_module = "Clinics";
	protected $_trash = false;
	protected $_model = "clinic_m";
	protected $table_prefix = "clinic_";
	protected $views = "clinics";
	protected $objects_name = "clinics";
	protected $object_name = "clinic";
	protected $form_fields = array('clinic_title');
    public function __construct(){
        parent::__construct();
		$this->data["Module_title"] = _lang("Clinics");
		$this->load->model("clinic_m");
    }
}