<?php
class Admin_Controller extends MY_Controller{
	protected $_backstage_dir;
	protected $_has_access = FALSE;
	private $_has_error = FALSE;
	public $_page=1;
	public $_per_page=25;
	protected $_special_privilaged_controllers = array('contact');
	protected $privilages = array("customer_service"=>array("order"=>array("index","add","edit","delete","preview"),"project"=>array("index","add","edit","delete")));
	protected $_trash = false;
	protected $_model = "";
	function __construct(){
		parent::__construct();
		$this->load->model('admin_m');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['meta_title'] = config_item("meta_title");
		$this->data['admin_head_title'] = _lang("Dashboard");
		$this->data["Module_title"] = $this->data['site_name'];
		$this->_backstage_dir = config_item("backstage_dir");
		$this->data['_backstage_dir'] = $this->_backstage_dir;		
		$this->data['_per_page'] = $this->_per_page;
		$this->data['_page'] = $this->_page;
		$this->data['basic_actions'] = array('index','add');
		$this->site_lang = "en";
		$this->can_access();		
		$this->site_dir = "ltr";
		$this->data['direction'] = $this->site_dir;
	}
	
	protected function have_customized_privilage(){
		return false;
	}
	
	private function can_access(){
		if($this->uri->segment(4,0)==0 && ($this->_method =='edit')){
			$this->problem_view('access');return;
		}
		//if($this->_method =='delete')
		$this->data['has_access'] = true;
		$this->_has_access = true;

	}
	
	private function user_have_operations(){
		@$priv_controller = $this->data['privilages'][$this->_controller];
		foreach($this->data['basic_actions'] as $action)
			if(is_array($priv_controller))unset($priv_controller[array_search($action,$priv_controller)]);
		return count($priv_controller) > 0?true:false;
	}
	
	protected function problem_view($reason=''){
		$this->site_dir = "rtl";
		$this->data['direction'] = $this->site_dir;
		$this->data['Module_title'] = _lang("Invalid Access");
		$this->data['is_404'] = true;
		$this->data['has_access'] = false;
		$this->sub_view('errors/404');
		$this->load_admin_view();
		$this->_has_error = true;
	}
	
	
	protected function valid_object($obj=''){
		if(!empty($obj))return true;
		$this->problem_view('valid');
		return false;
	}
	
	protected function has_privilage(){
		return true;		
	}
	
	protected function load_admin_view($_login_view=FALSE){
		if($this->_has_error){
			return;
		}
		$this->load->view($this->_backstage_dir.'/components/header', $this->data);
		$this->load->view($this->_backstage_dir.'/mine_layout_main', $this->data);
		$this->load->view($this->_backstage_dir.'/components/footer', $this->data);
	}
	protected function load_modal_view($view_data){
		$this->load->view($this->_backstage_dir.'/mine_layout_modal', $view_data);
	}
	
	protected function sub_view($sub_view){
		$this->data['subview'] = $this->_backstage_dir.'/'.$sub_view;
	}
	
	/*public function trash(){
		$this->_trash = "trash";
		$this->index();
	}*/
}