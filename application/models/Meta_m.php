<?php
class Meta_m extends MY_Model
{
	protected $_table_name = META_TABLE;
	public $_order_by = 'id desc';
	protected $_timestamps = TRUE;
	public $rules = array(
		'meta_type' => array(
			'field' => 'meta_type', 
			'label' => 'meta type', 
			'rules' => 'trim|required|exact_length[10]|xss_clean'
		), 
		'item_id' => array(
			'field' => 'item_id', 
			'label' => 'Item', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		'meta_key' => array(
			'field' => 'meta_key', 
			'label' => 'Key', 
			'rules' => 'trim|required|max_length[100]|url_title|xss_clean'
		), 
		'meta_value' => array(
			'field' => 'meta_value', 
			'label' => 'Value', 
			'rules' => 'trim|required'
		)
	);
	
	public $settings = array(
		'submitter' => array(
			'field' => 'submitter', 
			'label' => 'Value', 
			'rules' => 'trim'
	));

	public function get_new ()
	{
		$meta = new stdClass();
		$meta->meta_type = '';
		$meta->item_id = '';
		$meta->meta_key = '';
		$meta->meta_value = '';
		return $meta;
	}
	
	public function update_usermeta($user_id='',$key='',$data=array()){
		$meta_before = $this->get_usermeta($user_id,$key);
		if(!empty($meta_before)){
			if($key == "avatar")
				@unlink(FCPATH.'media/'.$meta_before->meta_value);
			$this->db->where('id', $meta_before->id);
			return $this->db->update($this->_table_name,$data);
		}else{
			$data["meta_type"] = "user";
			$data["item_id"] = $user_id;
			return $this->save($data);
		}
	}

	public function get_usermeta($user_id='',$key = ''){
		$user_id = (empty($user_id))?((strlen($this->session->userdata('id')))?$this->session->userdata('id'):''):$user_id;
		if(!empty($key))$this->db->where('meta_key', $key);
		$this->db->where('item_id', $user_id);
		$this->db->where('meta_type', 'user');
		if(!empty($key))$func_name = 'row';else $func_name = 'result';
		$q = $this->db->get($this->_table_name);
		return $q->$func_name();
	}
	
	public function get_meta($item_id='',$key = '',$type = ''){
		if(!empty($key))$this->db->where('meta_key', $key);
		$this->db->where('item_id', $item_id);
		if(!empty($type))	
			$this->db->where('meta_type', $type);
		if(!empty($key))$func_name = 'row';else $func_name = 'result';
		$q = $this->db->get($this->_table_name);
		return $q->$func_name();
	}
	
	public function update_meta($item_id='',$key='',$data=array()){
		$meta_before = $this->get_meta($item_id,$key,$data["meta_type"]);
		if(!empty($meta_before)){
			return $this->save($data,$meta_before->id);
		}else return $this->save($data);
	}
	
}