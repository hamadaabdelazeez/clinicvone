<?php
class Admin_m extends MY_Model
{
	
	function __construct() {
		parent::__construct();
		
	}
	
	function save($data, $id = NULL,$allow=false){
		$sess = $this->session->userdata('id');
		if(!empty($sess))$data[$this->get_field_prefixed('author_id')] = $sess;
		else $data[$this->get_field_prefixed('author_id')] = 0;
		return parent::save($data,$id,$allow);
	}
	
	/*
	public function get_new(){
		$obj = parent::get_new();
		$f = $this->get_field_prefixed("author_id");
		$obj->$f = '';
		return $obj;
	}
	*/
	
	public function get_all_with_trash($once=false){
		return $this->get_all($once,true);
	}
	
	public function get_all_only_trashed($once=false){
		return $this->get_all($once,"trash");
	}
	
	public function get_only_trashed($id = NULL, $single = FALSE,$once = false){
		return $this->get($id,$single,$once,"trash");
	}
	
	public function get_with_trashed($id = NULL, $single = FALSE,$once = false){
		return $this->get($id,$single,$once,true);
	}
	
	public function restore($id = NULL){
		return $this->delete($id,true);
	}
	
}