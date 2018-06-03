<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_table_prefix = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	public $_order_by = '';
	public $limit = '';
	public $offset = '';
	public $rules = array();
	public $filters = array();
	public $ignored_keys = array("order","orderby","limit");
	protected $_except_tables = array();
	protected $_timestamps = TRUE;
	
	function __construct() {
		parent::__construct();
		$this->_primary_key = $this->_table_prefix.$this->_primary_key;
		
	}
	
	function apply_filter(){}
	
	public function array_from_post($fields,$data = array()){
		foreach ($fields as $field) {
			$post_val = $this->input->post($field);
			if(!empty($post_val) || $post_val == "0" )
				$data[$field] = $this->input->post($field);
		}
		return $data;
	}
	
	function get_all($once = false,$get_also_trashed = false){
		$this->apply_filter($once);
		/*if(!$get_also_trashed)
			$this->db->where("(".$this->get_field_prefixed("is_deleted")." != '1' OR ".$this->get_field_prefixed("is_deleted")."  IS NULL )");
		elseif($get_also_trashed==="trash")
			$this->db->where($this->get_field_prefixed("is_deleted")." ='1'");*/
		$query  = $this->db->get($this->_table_name);
		return $query->result();
	}
	
	public function get($id = NULL, $single = FALSE,$once = false,$get_also_trashed = false,$is_deleted_prefix ="",$ignore_filter = false){
		if(!$ignore_filter)
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
		/*if(!$get_also_trashed)
			$this->db->where("(".$this->get_field_prefixed($is_deleted_prefix."is_deleted")." != '1' OR ".$this->get_field_prefixed($is_deleted_prefix."is_deleted")."  IS NULL )");
		elseif($get_also_trashed==="trash")
			$this->db->where($this->get_field_prefixed($is_deleted_prefix."is_deleted")." ='1'");*/
		$this->db->order_by($this->_order_by);

		if(isset($this->limit) && isset($this->offset)){
			return $this->db->get($this->_table_name,$this->limit,$this->offset)->$method();
		}else{
			
			return $this->db->get($this->_table_name)->$method();
		}
	}
	
	public function get_with_fields($id=NULL,$fields="*"){
		$this->db->select($fields);
		$this->db->from($this->_table_name);
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}else $method = 'result';
			//$this->db->where("(".$this->get_field_prefixed("is_deleted")." != '1' OR ".$this->get_field_prefixed("is_deleted")."  IS NULL )");
		$this->db->order_by($this->_order_by);
		return $this->db->get()->$method();
	}
	
	public function record_count($get_also_trashed=false){
		$this->db->select("COUNT(".$this->_primary_key.") as _count");
		$this->db->from($this->_table_name);
		/*if(!$get_also_trashed)
			$this->db->where("(".$this->get_field_prefixed("is_deleted")." != '1' OR ".$this->get_field_prefixed("is_deleted")."  IS NULL )");
		elseif($get_also_trashed==="trash")
			$this->db->where($this->get_field_prefixed("is_deleted")." ='1'");*/
		$_count = $this->db->get()->row();
		$_count = $_count->_count;
		return $_count;
	}
	
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}
	
	public function save($data, $id = NULL,$allow=false){
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data[$this->get_field_prefixed('created_at')] = $now;
			if(!in_array($this->_table_name,$this->_except_tables))
				$data[$this->get_field_prefixed('updated_at')] = $now;
		}
		if (empty($id) || $id === NULL) {
			$user_id = $this->session->userdata('id');
			if(!empty($user_id)){
				$data[$this->get_field_prefixed('author_id')] = $user_id;
			}
		}
		// Insert
		
		/*if(empty($data[$this->get_field_prefixed('is_deleted')]))
			$data[$this->get_field_prefixed('is_deleted')] = 0;*/
		
		
		if (empty($id) || $id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			//$data[$this->get_field_prefixed('updated_by')] = $this->session->userdata('id');
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		return $id;
	}
	
	/*public function delete($id,$restore=false,$all=""){
		if(empty($all)){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			if (!$id) return FALSE;
			$this->db->where($this->_primary_key, $id);
			$this->db->limit(1);
		}
		if($restore)$data[$this->_table_prefix.'is_deleted'] = "0";
		else $data[$this->_table_prefix.'is_deleted'] = "1";
		$data[$this->_table_prefix.'deleted_by'] = $this->session->userdata('id');
		$data[$this->_table_prefix.'deleted_at'] = date("Y-m-d H:i:s");
		return $this->db->update($this->_table_name,$data);
	}
	
	public function remove($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if (!$id) return FALSE;
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		return $this->db->delete($this->_table_name);
	}
	*/
	public function set_order_by($orderby){
		$this->_order_by = $orderby;
	}
	
	public function get_new(){
		$_r = array("id","created_at","updated_by","updated_at","is_deleted","deleted_by","deleted_at");
		$cols = $this->db->query("SHOW COLUMNS FROM ".$this->db->dbprefix.$this->_table_name)->result();
		$obj = new stdClass();
		$_fields = array();
		foreach($cols as $_col)
			if(!in_array(str_replace($this->_table_prefix,"",$_col->Field),$_r))$_fields[] = $_col->Field;
		return $this->add_fields_to_object($_fields,$obj,true);
	}
	
	public function get_field_prefixed($_field=""){
		return $this->_table_prefix.$_field;
	}
	
	public function add_fields_to_object($_field_names = array(),$obj='',$without_prefix=false){
		foreach($_field_names as $_field){
			if(!$without_prefix)	
				$f = $this->get_field_prefixed($_field);
			else $f  = $_field;
			$obj->$f = '';
		}
		return $obj;
	}
	
	public function media_linked_to_item($id,$item_id){
		/*$this->db->where("(".$this->get_field_prefixed("is_deleted")." != '1' OR ".$this->get_field_prefixed("is_deleted")."  IS NULL )");*/
		$media_name = $this->_table_prefix."media_id";
		$this->db->where($media_name,$id);
		$this->db->where($this->item_id_name,$item_id);
		return $this->db->get($this->_table_name)->row();
	}
	public function increase_num_download($id,$new_downloads){
		//$this->db->where($this->get_field_prefixed("id"),$id);
		$data[$this->get_field_prefixed('downloads')] = $new_downloads;//$this->get_field_prefixed('downloads')."+1";
		$this->db->set($data);
		$this->db->where($this->_primary_key, $id);
		return $this->db->update($this->_table_name);		
	}
	public function hash_adv_password($string){
		$enc = md5($string).config_item('encryption_key');
		return hash('sha512', $enc);
	}
    
    
        	public function find_by_id($id = 0,$value) {
		$row = $this -> db -> query("SELECT * FROM " . $this -> _table_name . " WHERE ".$id."=" . (int)$value . " LIMIT 1");
		return !empty($row) ? $row -> row() : FALSE;
	}

	public function is_login_in_admin() {
		return ($this -> session -> userdata('is_login_in_admin'))? TRUE : FALSE  ;
	}


    	public function is_login_in_user() {
		return ($this -> session -> userdata('is_login_in_user'))? TRUE : FALSE  ;
	}


	public function is_logged() {
		return ($this -> session -> userdata('is_logged'))? TRUE : FALSE  ;
	}
	
	public function find_all() {
		$all = $this -> db -> get($this -> _table_name);
		return $all -> result();
	}
    
    	public function find_all_desc($id) {
    	 $this->db->order_by($id,'desc');   
		$all = $this -> db -> get($this -> _table_name);
		return $all -> result();
	}
    
    
        	public function find_all_asc($id) {
    	 $this->db->order_by($id,'asc');
		$all = $this -> db -> get($this -> _table_name);
		return $all -> result();
	}
    
         	public function find_all_asc_limit($id,$limit) {
     	  $this->db->limit($limit);
    	 $this->db->order_by($id,'asc');   
		$all = $this -> db -> get($this -> _table_name);
		return $all -> result();
	}
     	public function find_all_desc_limit($id,$limit) {
     	  $this->db->limit($limit);
    	 $this->db->order_by($id,'desc');   
		$all = $this -> db -> get($this -> _table_name);
		return $all -> result();
	}

	public function find_all_where ($where,$value) {
 	      $this->db->where($where,$value);
           return $this->db->get($this->_table_name);
	}
    
    	public function find_all_where_desc ($where,$value,$id) {
    	   $this->db->order_by($id,'desc');   
 	      $this->db->where($where,$value);
           return $this->db->get($this->_table_name);
	}
    
    
        	public function find_all_like_desc ($where,$value,$id) {
    	   $this->db->order_by($id,'desc');   
 	      $this->db->like($where,$value);
           return $this->db->get($this->_table_name);
	}

        	public function find_all_where_desc1 ($where,$id) {
    	   $this->db->order_by($id,'desc');   
 	      $this->db->where($where);
           return $this->db->get($this->_table_name);
	}
    
    
            	public function find_all_where_asc1 ($where,$id) {
    	   $this->db->order_by($id,'asc');   
 	      $this->db->where($where);
           return $this->db->get($this->_table_name);
	}
    
        	public function find_all_where_desc_limit ($where,$value,$id,$limit) {
        	  $this->db->limit($limit);
    	   $this->db->order_by($id,'desc');   
 	      $this->db->where($where,$value);
           return $this->db->get($this->_table_name);
	}
	public function find_all_where_desc_limit1 ($where,$id,$limit) {
        	  $this->db->limit($limit);
    	   $this->db->order_by($id,'desc');   
 	      $this->db->where($where);
           return $this->db->get($this->_table_name);
	}
	public function find_last_id($id) {
           $this->db->order_by($id,'desc');
           $this->db->limit(1);
           $all = $this->db->get($this->_table_name); 
           return $all -> row();
	}

	public function pagination($limit = 0, $offset = 0, $order = "DESC" , $id) {
		$this -> db -> order_by($id , $order);
        $this->db->limit($limit,$offset);
		$query = $this -> db -> get($this -> _table_name, $limit, $offset);
		return $query -> result();
	}
	
	public function pagination_where($limit = 0, $offset = 0, $order = "DESC" , $by , $where) {
		$this -> db -> order_by($by , $order);
        $this->db->limit($limit,$offset);
        $this->db->where($where);
		$query = $this -> db -> get($this -> _table_name, $limit, $offset);
		return $query -> result();
	}

	public function count_all() {
		$all = $this -> db -> get($this -> _table_name);
		return $all -> num_rows();
	}

	public function count_all_where($where,$value) {
	    $this->db->where($where,$value);
	    $all = $this -> db -> get($this -> _table_name);
		return $all -> num_rows();
	}
    
    	public function count_all_where1($where) {
	    $this->db->where($where);
	    $all = $this -> db -> get($this -> _table_name);
		return $all -> num_rows();
	}

	public function update($where,$value,$data= array()) {
		$this -> db -> where($where,$value);
		return $this -> db -> update($this -> _table_name, $data);
	}

	public function create($data = array()) {
		$q = $this -> db -> insert($this -> _table_name, $data);
		return ($q) ? $this -> db -> insert_id() : FALSE;
	}

/*	public function my_delete($where,$value) {
		$this -> db -> where($where, $value);
		return $this -> db -> delete($this -> _table_name);
	}
    

    	public function delete1($where) {
		$this -> db -> where($where);
		return $this -> db -> delete($this -> _table_name);
	}

	public function delete_array($ids = array()){
		foreach ($ids as  $id) {
		$this -> db -> where('id', $id);
		$this -> db -> delete($this -> _table_name);
		}
		return TRUE;
	}
  */  
    public function select_offset($id,$limit,$offset){
	       $this->db->order_by($id,'desc');
           $this->db->offset($offset);
 	       $this->db->limit($limit);
           return $this->db->get($this->_table_name);
    }

	public function create_capthca_code()
	{
		$this -> load -> helper('captcha');
		$vals = array(
		'img_path' => './public/captcha/' ,
		'img_url' => base_url(). 'public/captcha/' ,
		'img_width' => '150' ,
		'img_height' => '30'   
		);
		$cap = create_captcha($vals);
		$this -> session -> set_userdata('captcha' , $cap['word']);
		return $cap['image'] ;
	}
	
	public function Check_captcha()
	{
	return (strlen($this -> session -> userdata('captcha')) == strlen($this -> input -> post('captcha')))? TRUE : FALSE ;
	}
    
    public function check_captchaa(){
             if($this->input->post('code') !== $this->session->userdata('captcha')){
           return false;
        }else{
            return false;
        }
    }
    
    public function keywords($text){
        $x= explode(' ',$text);
        $y= implode(',',$x);
        return $y;
    }
    
    
    public function date_arabic($t){
    $days=array('الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت');
    $months=array('','يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر');
    $date = getdate($t);
    echo 'تاريخ اليوم '.$days[$date['wday']].' : '.$date['mday'].' / '.$months[$date['mon']].' / '.$date['year'].' الوقت الأن '.$date['hours'].':'.$date['minutes'];
    }
    
    
    public function  queryy($query){
        $q= $this->db->query($query);
        return $q;
    }
    
        public function  queryy_n($query){
        $q= $this->db->query($query);
        return $q->num_rows();
    }
    
    
    
            public function select_sum($field){
            $this->db->select_sum($field);
            $query = $this->db->get($this->_table_name);
    }
    

    public function get_sum($where,$value,$field){
    $this->db->select_sum($field)
            ->where($where, $value);
    $query = $this->db->get($this->_table_name);
    return $query->result();
}






	
}