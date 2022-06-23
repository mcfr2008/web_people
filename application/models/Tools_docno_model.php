<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools_docno_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	
	public function get_create_docno_1_model(
		$name_table,
		$name_fld_id,
		$name_fld_date,
		$name_fld_docno,
		$name_title
	)
	{

		$this->db->select($name_fld_docno);
		$this->db->from($name_table);
		$this->db->where('DATE('.$name_fld_date.')',date('Y-m-d'));
		$this->db->where($name_fld_docno . ' is NOT NULL', NULL, FALSE);
		$this->db->order_by($name_fld_id,'DESC');
		$this->db->limit(1);
		$check_docno = $this->db->get()->result_array();

		if(count($check_docno) > 0 ){

			$check_docno[0][$name_fld_docno];
			$substr_docno = substr($check_docno[0][$name_fld_docno],10,3) + 1;
			$data = $name_title . date('Ym'). sprintf("%04s",$substr_docno);

		}else if(count($check_docno) == 0) {
			$data = $name_title . date('Ym'). '0001';
		}
		
		return $data;

	}

	public function get_check_duplicate_1_model(
		$name_select ,
		$name_table ,
		$name_fld_id ,
		$name_fld_employee_id ,
		$name_fld_approve ,
		$name_fld_trash ,
		$name_join_1 ,
		$name_join_sub_1 ,
		$data_fld_trash,
		$data_employee_id
	)
	{

		$this->db->select($name_select);
		$this->db->from($name_table);
		$this->db->join($name_join_1,$name_join_sub_1);
		$this->db->where($name_fld_employee_id,$data_employee_id);
		$this->db->where($name_fld_approve .' is NULL', NULL, FALSE);
		$this->db->where($name_fld_trash,$data_fld_trash);
		$this->db->order_by($name_fld_id,'DESC');
		$this->db->limit(1);
		$check_duplicate = $this->db->get()->result_array();

		if(count($check_duplicate) > 0 )
		{
			$data = 'duplicate';
		}else if(count($check_duplicate) == 0)
		{
			$data = 'notduplicate';
		}
		
		return $data;

	}

	public function get_check_duplicate_leave_model(
		$name_select ,
		$name_table ,
		$name_fld_id ,
		$name_fld_employee_id ,
		$name_fld_approve ,
		$name_fld_trash ,
		$name_join_1 ,
		$name_join_sub_1 ,
		$name_fld_startdate,
		$data_fld_trash,
		$data_employee_id,
		$data_fld_startdate
	)
	{

		$this->db->select($name_select);
		$this->db->from($name_table);
		$this->db->join($name_join_1,$name_join_sub_1);
		$this->db->where($name_fld_employee_id,$data_employee_id);
		$this->db->where_in($name_fld_approve , array('0','1'));
		// $this->db->where($name_fld_trash,$data_fld_trash);
		$this->db->where($name_fld_startdate,$data_fld_startdate);
		$this->db->order_by($name_fld_id,'DESC');
		$this->db->limit(1);
		$check_duplicate = $this->db->get()->result_array();

		if(count($check_duplicate) > 0 )
		{
			$data = 'duplicate';
		}else if(count($check_duplicate) == 0)
		{
			$data = 'notduplicate';
		}
		
		return $data;

	}

	public function get_check_date_1_model($date)
	{

		$str_date = intval(substr($date,0,4));
		$current_year  = intval(date('Y'));
		$cal_date = $str_date - $current_year;
		if($str_date == $current_year){
	
			$data = $date;
	
		}else if($cal_date > -5 && $cal_date < 5){
	
			$data = $date;
			
		}else if($cal_date > 538 && $cal_date < 548){
	
			$cal_date2 = strval($str_date - 543);
			$data = substr_replace($date,$cal_date2,0,4);
	
		}else{
			$data = 'errordate';
		}
		
		return $data;

	}


}
