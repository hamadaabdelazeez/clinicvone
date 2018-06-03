<?php
class clinic_m extends MY_Model{
	protected $_table_name = CLINICS_TABLE;
	public $_order_by = ' clinic_id DESC ';
	protected $_table_prefix = "clinic_";
	public $rules = array(
		'clinic_title' => array(
			'field' => 'clinic_title',
			'label' => "Clinic title",
			'rules' => 'trim|required|xss_clean'
		),
	);
	function __construct() {
		parent::__construct();
	}
	public function apply_filter($once = false){
		if(!empty($_GET) && empty($_GET["search"])){
			foreach($_GET as $key=>$value){
				if(empty($value))continue;
				switch($key){
					case "s":
						$this->db->where("clinic_title LIKE '%".$value."%'");
					break;
				}
			}
		}
	}
}
