<?php
class Language_m extends MY_Model
{
	
	protected $_table_name = LANG_TABLE;
	public $_order_by = 'lang_order , lang_name ';
	protected $_timestamps = TRUE;
	public $rules = array(
		'lang_name' => array(
			'field' => 'lang_name', 
			'label' => 'Language name', 
			'rules' => 'trim|required|max_length[150]|xss_clean'
		), 
		'lang_slug' => array(
			'field' => 'lang_slug', 
			'label' => 'Slug', 
			'rules' => 'trim|max_length[100]|xss_clean'
		), 
		'lang_flag' => array(
			'field' => 'lang_flag', 
			'label' => 'Flag', 
			'rules' => 'trim|xss_clean'
		), 
		'lang_order' => array(
			'field' => 'lang_order', 
			'label' => 'Order', 
			'rules' => 'trim|intval|xss_clean'
		)
	);
	
	public $rules1 = array(
		'site_lang' => array(
			'field' => 'site_lang', 
			'label' => 'Language name', 
			'rules' => 'trim'
		)
	);
	

	public function get_new()
	{
		$lang = new stdClass();
		$lang->lang_name = '';
		$lang->lang_slug = '';
		$lang->lang_flag = '';
		$lang->lang_order = '';
		return $lang;
	}
	
	public function get($id = NULL, $single = FALSE,$once = false,$get_also_trashed = false,$is_deleted_prefix =""){
		$this->apply_filter($once);
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		$this->db->where("lang_active","1");
		//if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
		//}
		if(isset($this->limit) && isset($this->offset)){
			return $this->db->get($this->_table_name,$this->limit,$this->offset)->$method();
		}else{
			return $this->db->get($this->_table_name)->$method();
		}
	}

}