<?php
class Patient_m extends MY_Model{
	protected $_table_name = PATIENTS_TABLE;
	public $_order_by = ' patient_id DESC ';
	protected $_table_prefix = "patient_";
	function __construct() {
		parent::__construct();
	}

}
