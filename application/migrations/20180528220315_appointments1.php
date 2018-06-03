<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Appointments1 extends CI_Migration {
	public function __construct(){
		parent::__construct();
	    $this->load->dbforge();
	}
	public function up(){
		$this->create_clinics();
	}
	
	public function down(){
		$this->dbforge->drop_table('clinics');
		//$this->dbforge->drop_table('patients');
		//$this->dbforge->drop_table('appointments');
	}
	protected function add_meta_fields($table_prefix){
		return array(				
			$table_prefix.'created_at' => array(
					'type' => 'TIMESTAMP',
					'null' => TRUE,
					'default' => NULL
			),
			$table_prefix.'updated_at' => array(
					'type' => 'TIMESTAMP',
					'null' => TRUE,
					'default' => NULL
			),
			$table_prefix.'author_id' => array(
					'type' => 'INT',
					'constraint' => 11
			),
		);
	}
	public function creat_clinics(){
		$t_fields = array(
			'clinic_id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
			),
			'clinic_title' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
			),
		);
		//$t_fields = $t_fields + $this->add_meta_fields("clinic_");
		$this->dbforge->add_field($t_fields);
		$this->dbforge->add_key('clinic_id', TRUE);
		$this->dbforge->create_table('clinics');
	}
}