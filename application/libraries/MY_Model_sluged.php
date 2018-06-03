<?php
class MY_model_sluged extends MY_Model {
	
	protected $slug_field = '';
	protected $title_field = '';
	
	function __construct() {
		parent::__construct();
	}
	
	function create_dashed_slug($data=array(),$id = ''){
		$this->config_slug();
		if(empty($data[$this->slug_field])){
			$data[$this->slug_field] = strtolower($data[$this->title_field]);
		}
		
		$slug = $data[$this->slug_field];
		
		$slug = str_replace(' ','-',$slug);
		$slug = str_replace(',','-',$slug);
		$slug = str_replace('--','-',$slug);
		$i=0;$q ='';$_slug = $slug;
		do{	
			if($i>0)$_slug = $slug.'-'.$i;
			if(!empty($id))
				$this->db->where($this->_primary_key.' != ',$id);
			$this->db->where($this->slug_field,$_slug);
			$q = $this->db->get($this->_table_name);
			$q  = $q->row();
			$i++;
		}while(!empty($q));
		//$data[$this->slug_field] = strtolower($_slug);
		return $data;
	}
	
	public function save($data, $id = NULL, $allow = false){
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data[$this->get_field_prefixed('created_at')] = $now;
			$data[$this->get_field_prefixed('updated_at')] = $now;
		}
		$data[$this->get_field_prefixed('author_id')] = $this->session->userdata('id');
		// Insert
		
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;			
			
			$data = $this->create_dashed_slug($data);
			
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$data = $this->create_dashed_slug($data,$id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		return $id;
	}
	
}