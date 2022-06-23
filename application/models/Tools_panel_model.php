<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools_panel_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}


	public function get_status_panel_1_model()
	{
		$_data = $_REQUEST;
		$table_name = $_data['table_name'];
		$approve_name = $_data['approve_name'];

		// foreach array_status
		// 0 ยกเลิก
		// 1 อนุมัติ
		// 2 รออนุมัติ
		// 3 ทั้งหมด
		$array_status = array("0","1","2","3");
		foreach ($array_status as $key => $value_status) {

			$this->db->select('
				COUNT(fld_id) AS count
			');
			$this->db->from($table_name);
			$this->db->where('fld_trash',1);
			
			if($value_status == 0)
			{
				$this->db->where($approve_name,$value_status);
				$data['tools_panel_status_dismiss'] = $this->db->get()->result_array()[0]['count'];
			}else if($value_status == 1) 
			{
				$this->db->where($approve_name,$value_status);	
				$data['tools_panel_status_accept'] = $this->db->get()->result_array()[0]['count'];	
			}else if($value_status == 2) 
			{
				$this->db->where($approve_name . ' IS NULL');	
				$data['tools_panel_status_wait'] = $this->db->get()->result_array()[0]['count'];
			}
			else if($value_status == 3) 
			{
				$data['tools_panel_status_all'] = $this->db->get()->result_array()[0]['count'];	
			}

		}

		return  $data ;
	}

	public function get_status_panel_2_model()
	{
		$_data = $_REQUEST;
		$table_name = $_data['table_name'];
		$approve_name = $_data['approve_name'];
		$type_name = $_data['type_name'];
		$type_data = $_data['type_data'];

		// foreach array_status
		// 0 ยกเลิก
		// 1 อนุมัติ
		// 2 รออนุมัติ
		// 3 ทั้งหมด
		$array_status = array("0","1","2","3");
		foreach ($array_status as $key => $value_status) {

			$this->db->select('
				COUNT(fld_id) AS count
			');
			$this->db->from($table_name);
			$this->db->where('fld_trash',1);
			$this->db->where($type_name,$type_data);
			
			if($value_status == 0)
			{
				$this->db->where($approve_name,$value_status);
				$data['tools_panel_status_dismiss'] = $this->db->get()->result_array()[0]['count'];
			}else if($value_status == 1) 
			{
				$this->db->where($approve_name,$value_status);	
				$data['tools_panel_status_accept'] = $this->db->get()->result_array()[0]['count'];	
			}else if($value_status == 2) 
			{
				$this->db->where($approve_name . ' IS NULL');	
				$data['tools_panel_status_wait'] = $this->db->get()->result_array()[0]['count'];
			}
			else if($value_status == 3) 
			{
				$data['tools_panel_status_all'] = $this->db->get()->result_array()[0]['count'];	
			}

		}

		return  $data ;
	}

}
