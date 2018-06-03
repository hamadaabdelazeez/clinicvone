<?php
class Media_m extends MY_Model_sluged
{
	protected $_table_name = MEDIA_TABLE;
	protected $_table_prefix = "media_";
	
	public $rules = array(
		'media_title' => array(
			'field' => 'media_title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		),
		'media_alt' => array(
			'field' => 'media_alt', 
			'label' => 'Alt', 
			'rules' => 'trim|required|xss_clean'
		),  
		'media_slug' => array(
			'field' => 'media_slug', 
			'label' => 'Slug', 
			'rules' => 'trim|max_length[100]|xss_clean'
		)
	);
	
	
	function __construct() {
		parent::__construct();
		
	}
	
	function config_slug(){
		$this->slug_field = 'media_slug';
		$this->title_field = 'media_title';
	}
	
	public function apply_filter(){
		if(!empty($_GET) && empty($_GET["search"])){			
			foreach($_GET as $key=>$value){
				if(empty($value))
					continue;
				if(!in_array($key,$this->ignored_keys)){
					switch($key){
						case "s":
							$this->db->where("(media_title LIKE '%".$value."%' OR media_alt LIKE '%".$value."%')");
						break;
						case "_status":						
							$this->db->where('media_status', $value);
						break;
						case "_type":						
							$this->db->where('media_type', $value);
						break;
					}
				}
			}
		}
	}
	public function get_new(){
		$media = new stdClass();
		$media->media_title = '';
		$media->media_slug = '';
		$media->media_url = '';
		return $media;
	}
	
	public function available_years(){
		$this->db->distinct();
		$this->db->select('YEAR(STR_TO_DATE(created_at, "%Y")) as _y');
		$q = $this->db->get(MEDIA_TABLE);
		return $q->result();
	}

}