<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools_info_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	
	public function get_user_1_model() 
    {

        // $this->db = $this->load->database($data['database'], TRUE);

		$this->db = $this->load->database('default', TRUE);
		
        $this->db->select('
			users.fld_id,
			users.fld_name,
			users.fld_username,
			users.fld_password,
			users.fld_lastlogin,
			users.fld_employee_id,
			users.fld_creator_id,
			users.fld_create_date,
			user_access.fld_role_id
        ');
        $this->db->from('users');
        $this->db->join('user_access','user_access.fld_user_id = users.fld_id','left');	
        $this->db->where('users.fld_id',$_SESSION['people_id']);
        $data = $this->db->get()->result_array()[0];

        return $data;
    }

	public function get_auto_employees_model(
		$data_search_text ,
		$data_employee_status
	) 
    {

		$this->db = $this->load->database('default', TRUE);
		
		$search_text = explode(" ",$data_search_text);
		$count_search_text = count($search_text);

		// 1	Working	ทำงาน
		// 2	Not working	ยกเลิก
		// 3	Furlough	พักงาน
		$employee_status = $data_employee_status;
		
        $this->db->select('

			employees.*,

			employee_organizations.fld_id AS organization_id,
			employee_organizations.fld_name_th AS organization_name_th,
			employee_organizations.fld_name_en AS organization_name_en,

			employee_divisions.fld_id AS division_id,
			employee_divisions.fld_name_th AS division_name_th,
			employee_divisions.fld_name_en AS division_name_en,

			employee_positions.fld_id AS position_id,
			employee_positions.fld_name_th AS position_name_th,
			employee_positions.fld_name_en AS position_name_en,


        ');
        $this->db->from('employees');

        $this->db->join('employee_organizations','employees.fld_organizations_id = employee_organizations.fld_id');
        $this->db->join('employee_divisions','employees.fld_latest_division_id = employee_divisions.fld_id');
        $this->db->join('employee_positions','employees.fld_latest_position_id = employee_positions.fld_id');
       
        if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('employees.fld_give_name',$search_text[$i],'both');
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('employees.fld_family_name',$search_text[$i],'both');
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('employees.fld_nick_name',$search_text[$i],'both');
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('employees.fld_card_id',$search_text[$i],'after');
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('employees.fld_card_barcode',$search_text[$i],'after');
				}
			$this->db->group_end();
		}

		if($employee_status != 'none'){
			$this->db->where('employees.fld_employee_status_id',$employee_status);
		}
		$this->db->limit(10);
        $data = $this->db->get()->result_array();


        return $data;
    }


}
