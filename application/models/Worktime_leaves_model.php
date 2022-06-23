<?php

class Worktime_leaves_model extends CI_Model {

    function __construct() {
      
        parent::__construct();

        $this->load->model('Activity_log_model');
        $this->load->model('Tools_docno_model');
        $this->load->model('Tools_info_model');
        
    }

	public function get_leaves_model()
	{

		$this->db = $this->load->database('default', TRUE);

		$_data = $_REQUEST;

		$PerPage = $_data['PerPage'];
		$pageNumber = $_data['pageNumber'] * $PerPage;
	
		$search_text	= '';
		$search_date	= '';
		$search_division  = '';
		$search_approve = '';
		$search_type_leave = '';
		$search_organization = '';

		$search_text = explode(" ",$_data['search_text']);
		$count_search_text = count($search_text);
		$search_date	= $_data['search_date'];
		$search_division	= $_data['search_division_id'];
		$search_approve = $_data['search_approve'];
		$search_type_leave = $_data['search_type_leave'];
		$search_organization = $_data['search_organization'];

		$this->db->select("
			worktime_leaves.* , 
			worktime_leave_types.fld_name_th AS leave_types_name_th,
			worktime_leave_types.fld_name_en AS leave_types_name_en,

		");
		$this->db->from('worktime_leaves');
		$this->db->join('worktime_leave_types','worktime_leave_types.fld_id = worktime_leaves.fld_type_leave_id');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('worktime_leaves.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leaves.fld_docno',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leaves.fld_other_details',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_date != ''){
			$this->db->where('worktime_leaves.fld_date_str',$search_date);
		}
		if($search_division != ''){
			$this->db->where('worktime_leaves.fld_division_id',$search_division);
		}
		if($search_approve != ''){
			$this->db->where('worktime_leaves.fld_approve_status',$search_approve);
		}
		if($search_type_leave != ''){
			$this->db->where('worktime_leaves.fld_type_leave_id',$search_type_leave);
		}
		if($search_organization != ''){
			$this->db->where('worktime_leaves.fld_organization_id',$search_organization);
		}
		$this->db->where('worktime_leaves.fld_trash',1);
		$this->db->limit($PerPage,$pageNumber);
		$this->db->order_by('worktime_leaves.fld_date','ASC'); 
		$data['data'] = $this->db->get()->result_array();


		$this->db->from('worktime_leaves');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('worktime_leaves.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leaves.fld_docno',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leaves.fld_other_details',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_date != ''){
			$this->db->where('worktime_leaves.fld_date_str',$search_date);
		}
		if($search_division != ''){
			$this->db->where('worktime_leaves.fld_division_id',$search_division);
		}
		if($search_approve != ''){
			$this->db->where('worktime_leaves.fld_approve_status',$search_approve);
		}
		if($search_type_leave != ''){
			$this->db->where('worktime_leaves.fld_type_leave_id',$search_type_leave);
		}
		if($search_organization != ''){
			$this->db->where('worktime_leaves.fld_organization_id',$search_organization);
		}
		$this->db->where('worktime_leaves.fld_trash',1);
		$data['total'] =  $this->db->count_all_results();

		return $data;
		
	}

	// public function get_leaves_byid_model() 
    // {

	// 	$this->db = $this->load->database('default', TRUE);

	// 	$_data  = $_REQUEST;

    //     $this->db->select('
	// 		worktime_leaves.*,
			
	// 	');
	// 	$this->db->from('worktime_leaves');
	// 	$this->db->where('worktime_leaves.fld_id',$_data['fld_id']); 
	// 	$data['data'] = $this->db->get()->result_array()[0];

	// 	return $data;
    // }

	public function post_leaves_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		//-------------------------------------tools-------------------------------------------------

				// $name_table => table name
				// $name_fld_id => fld name (id)
				// $name_fld_date => fld name (date)
				// $name_fld_docno => fld name (docno)
				// $name_title => title name 

				$name_table = 'worktime_leaves';
				$name_fld_id = 'fld_id';
				$name_fld_date = 'fld_created_at';
				$name_fld_docno = 'fld_docno';
				$name_title  = 'PLE';
				$data_docno = $this->Tools_docno_model->get_create_docno_1_model(
					$name_table,
					$name_fld_id,
					$name_fld_date,
					$name_fld_docno,
					$name_title
				);

			// -------------------------------------------------

				$convert_startdate = intval(strtotime($_data['fld_date_str']));
				$convert_emergency = intval(strtotime(date('Y-m-d'))) + 172800;

				if($convert_startdate > $convert_emergency){
					$data_type_emergency = 0;
				}else{
					$data_type_emergency = 1;
				}

		// ------------------------------------------------------------------------------------------

		$this->db->set('fld_employee_id',$_data['fld_employee_id']);
		$this->db->set('fld_organization_id',$_data['fld_organization_id']);
		$this->db->set('fld_holiday_date_id',$_data['fld_holiday_date_id']);
		$this->db->set('fld_division_id',$_data['fld_division_id']);
		$this->db->set('fld_type_leave_id',$_data['fld_type_leave_id']);
		$this->db->set('fld_type_salary_id',$_data['fld_type_salary_id']);
		$this->db->set('fld_type_emergency',$data_type_emergency);
		$this->db->set('fld_docno',$data_docno);
		$this->db->set('fld_date_str',$_data['fld_date_str']);
		$this->db->set('fld_date_end',$_data['fld_date_end']);
		$this->db->set('fld_point_in',$_data['fld_point_in']);
		$this->db->set('fld_point_out',$_data['fld_point_out']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_contact_name',$_data['fld_contact_name']);
		$this->db->set('fld_contact_type',$_data['fld_contact_type']);
		$this->db->set('fld_medical_certificate_status',$_data['fld_medical_certificate_status']);
		$this->db->set('fld_medical_certificate_details',$_data['fld_medical_certificate_details']);
		$this->db->set('fld_medical_certificate_date',$_data['fld_medical_certificate_date']);
		$this->db->set('fld_trash',1);
		$this->db->set('fld_created_id',$_SESSION['people_id']);
		$this->db->set('fld_created_at',date('Y-m-d H:i:s'));
		$this->db->insert('worktime_leaves');

		$id = $this->db->insert_id();

		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'เพิ่ม' ,
				"fld_table_name" => 'worktime_leaves',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_leaves_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		//-------------------------------------tools-------------------------------------------------

			$convert_startdate = intval(strtotime($_data['fld_date_str']));
			$convert_emergency = intval(strtotime(date('Y-m-d'))) + 172800;

			if($convert_startdate > $convert_emergency){
				$data_type_emergency = 0;
			}else{
				$data_type_emergency = 1;
			}

		// ------------------------------------------------------------------------------------------

		$this->db->set('fld_organization_id',$_data['fld_organization_id']);
		$this->db->set('fld_holiday_date_id',$_data['fld_holiday_date_id']);
		$this->db->set('fld_division_id',$_data['fld_division_id']);
		$this->db->set('fld_type_leave_id',$_data['fld_type_leave_id']);
		$this->db->set('fld_type_salary_id',$_data['fld_type_salary_id']);
		$this->db->set('fld_type_emergency',$data_type_emergency);
		$this->db->set('fld_date_str',$_data['fld_date_str']);
		$this->db->set('fld_date_end',$_data['fld_date_end']);
		$this->db->set('fld_point_in',$_data['fld_point_in']);
		$this->db->set('fld_point_out',$_data['fld_point_out']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_contact_name',$_data['fld_contact_name']);
		$this->db->set('fld_contact_type',$_data['fld_contact_type']);
		$this->db->set('fld_medical_certificate_status',$_data['fld_medical_certificate_status']);
		$this->db->set('fld_medical_certificate_details',$_data['fld_medical_certificate_details']);
		$this->db->set('fld_medical_certificate_date',$_data['fld_medical_certificate_date']);
		$this->db->set('fld_updated_id',$_SESSION['people_id']);
		$this->db->set('fld_updated_at',date('Y-m-d H:i:s'));
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_leaves');

		$id = $_data['fld_id'];
      
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'แก้ไข' ,
				"fld_table_name" => 'worktime_leaves',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_leaves_approve_model() 
	{
	
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$leave_id = $_data['fld_id'];

		$id = $leave_id;

		$this->db->set('fld_approve_status',$_data['fld_approve_status']);
		$this->db->set('fld_approve_id',$_SESSION['people_id']);
		$this->db->set('fld_approve_date',date('Y-m-d H:i:s'));
		$this->db->where('fld_id',$leave_id);
		$this->db->update('worktime_leaves');

		if($_data['fld_approve_status'] == 1)
		{
				
			$this->db->select('*');
			$this->db->from('worktime_leaves');
			$this->db->where('fld_id',$leave_id);
			$data_leave = $this->db->get()->result_array()[0];

			$timeDiff = strtotime($data_leave['fld_date_end']) - strtotime($data_leave['fld_date_str']) ;

			for($i = 1 ; $i <= ($timeDiff/86400) + 1 ; $i++){

				$this->db->select('count(id) AS count');
				$this->db->from('worktime_employees');
				$this->db->where('fld_date',$time);
				$this->db->where('fld_employee_id',$data_leave['fld_employee_id']);
				$count = $this->db->get()->result_array()[0]['count'];

				$changedate = strtotime($data_leave['fld_date_str']);
				$plusdate  =  ($changedate + (86400*$i))-86400;
				$time = date("Y-m-d",$plusdate);
					
				if($i == 1){
					if($data_leave['fld_point_out'] == 1 ){
						$this->db->set('fld_leave_morning',0.5);
						$this->db->set('fld_leave_afternoon',0.5);
					}
					if($data_leave['fld_point_out'] == 2 ){
						$this->db->set('fld_leave_morning',0.5);	
						$this->db->set('fld_leave_afternoon',null);	
					}
					if($data_leave['fld_point_out'] == 3 ){
						$this->db->set('fld_leave_morning',null);	
						$this->db->set('fld_leave_afternoon',0.5);	
					}
				}else if($i == ($timeDiff/86400) + 1 ){
					if($data_leave['fld_point_in'] == 1 ){
						$this->db->set('fld_leave_morning',0.5);
						$this->db->set('fld_leave_afternoon',0.5);
					}
					if($data_leave['fld_point_in'] == 2 ){
						$this->db->set('fld_leave_morning',0.5);
						$this->db->set('fld_leave_afternoon',null);	
					}
					if($data_leave['fld_point_in'] == 3 ){
						$this->db->set('fld_leave_morning',null);	
						$this->db->set('fld_leave_afternoon',0.5);
					}
				}else{
					$this->db->set('fld_leave_id',$leave_id);
					$this->db->set('fld_leave_morning',0.5);	
					$this->db->set('fld_leave_afternoon',0.5);
				}

				$this->db->set('fld_employee_id',$data_leave['fld_employee_id']);
				$this->db->set('fld_leave_id',$leave_id);
				$this->db->set('fld_date',$time);
				
				if($count > 0){
					$this->db->where('fld_date',$time);
					$this->db->where('fld_employee_id',$data_leave['fld_employee_id']);
					$this->db->update('worktime_employees');
				}else{
					$this->db->insert('worktime_employees');
				}
				
			}
				
		}
		
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'อนุมัติ สถานะ ' . $_data['fld_approve_status'] ,
				"fld_table_name" => 'worktime_leaves',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';

	}

	public function put_leaves_unlock_approve_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_approve_status',null);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_leaves');
		
		$this->db->set('fld_leave_morning',null);
		$this->db->set('fld_leave_afternoon',null);
		$this->db->set('fld_leave_id',null);
		$this->db->set('fld_deduction_id',null);
		$this->db->set('fld_deduction_amount',null);
		$this->db->set('fld_income_id',null);
		$this->db->set('fld_income_amount',null);
		$this->db->where('fld_leave_id', $_data['fld_id']);
		$this->db->update('worktime_employees');

		$id = $_data['fld_id'];
		
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'ปลดล็อก ใบลา' ,
				"fld_table_name" => 'worktime_leaves',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------
	
		return 'success';
	
    }

	public function delete_leaves_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_trash',0);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_leaves');

		$id = $_data['fld_id'];
		
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'ลบ' ,
				"fld_table_name" => 'worktime_leaves',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------
	
		return 'success';
	
    }
  
}

?>
