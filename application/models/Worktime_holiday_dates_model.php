<?php

class Worktime_holiday_dates_model extends CI_Model {

    function __construct() {
      
        parent::__construct();

        $this->load->model('Activity_log_model');
        
    }

	public function get_holiday_dates_active_status_model()
	{

		$this->db = $this->load->database('default', TRUE);

		$data = array();

		$data = array(

			
			array(
				'id' => '0',
				'name' => 'ไม่ใช้งาน'
			),
			array(
				'id' => '1',
				'name' => 'ใช้งาน'
			),
			
		);

		return $data;
		
	}

	public function get_holiday_dates_type_stop_working_status_model()
	{

		$this->db = $this->load->database('default', TRUE);

		$data = array();

		$data = array(

			
			array(
				'id' => '0',
				'name' => 'ไม่หยุด'
			),
			array(
				'id' => '1',
				'name' => 'หยุด'
			),
			
		);

		return $data;
		
	}

	public function get_holiday_dates_all_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$active  = $_data['active'];
		$trash  = $_data['trash'];

		if($active != 'none')
		{
			$this->db->where('fld_active',$active); 
		}

		if($trash != 'none')
		{
			$this->db->where('fld_trash',$trash); 
		}

        $this->db->select('*');
		$this->db->from('worktime_holiday_dates');
		$this->db->order_by('fld_id','ASC'); 
		$data['data'] = $this->db->get()->result_array();

		return $data;
    }

	public function get_holiday_dates_model()
	{

		$this->db = $this->load->database('default', TRUE);

		$_data = $_REQUEST;

		$PerPage = $_data['PerPage'];
		$pageNumber = $_data['pageNumber'] * $PerPage;

		$search_text = explode(" ",$_data['search_text']);
		$count_search_text = count($search_text);
		$search_active = $_data['search_active'];
		$search_organization = $_data['search_organization'];

		$this->db->select("
			worktime_holiday_dates.* , 
			CASE
				WHEN worktime_holiday_dates.fld_active = 1  THEN '<span class=\"text-primary\"><i class=\"fa fa-eye\"></i>  ใช้งาน</span>'
				WHEN worktime_holiday_dates.fld_active = 0  THEN '<span class=\"text-black\"><i class=\"fa fa-eye-slash\"></i> ไม่ใช้งาน</span>'
				ELSE ''
			END AS html_active_status,

			CASE
				WHEN worktime_holiday_dates.fld_type_stop_working = 1  THEN '<span class=\"text-primary\"><i class=\"fa fa-calendar-check\"></i>  หยุด</span>'
				WHEN worktime_holiday_dates.fld_type_stop_working = 0  THEN '<span class=\"text-black\"><i class=\"fa fa-calendar-times\"></i> ไม่หยุด</span>'
				ELSE ''
			END AS html_type_stop_working_status,
		");
		$this->db->from('worktime_holiday_dates');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('worktime_holiday_dates.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_holiday_dates.fld_name_th',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_holiday_dates.fld_name_en',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_active != ''){
			$this->db->where('worktime_holiday_dates.fld_active',$search_active);
		}
		if($search_organization != ''){
			$this->db->where('worktime_holiday_dates.fld_organization_id',$search_organization);
		}
		$this->db->where('worktime_holiday_dates.fld_trash',1);
		$this->db->limit($PerPage,$pageNumber);
		$this->db->order_by('worktime_holiday_dates.fld_date','ASC'); 
		$data['data'] = $this->db->get()->result_array();


		$this->db->select('count(*) AS count');
		$this->db->from('worktime_holiday_dates');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('worktime_holiday_dates.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_holiday_dates.fld_name_th',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_holiday_dates.fld_name_en',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_active != ''){
			$this->db->where('worktime_holiday_dates.fld_active',$search_active);
		}
		if($search_organization != ''){
			$this->db->where('worktime_holiday_dates.fld_organization_id',$search_organization);
		}
		$this->db->where('worktime_holiday_dates.fld_trash',1);
		$data['total'] = $this->db->get()->result_array()[0]['count'];

		return $data;
		
	}

	public function get_holiday_dates_byid_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

        $this->db->select('
			worktime_holiday_dates.*,
			
		');
		$this->db->from('worktime_holiday_dates');
		$this->db->where('worktime_holiday_dates.fld_id',$_data['fld_id']); 
		$data['data'] = $this->db->get()->result_array()[0];

		return $data;
    }

	public function post_holiday_dates_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;
	
		$this->db->set('fld_name_th',$_data['fld_name_th']);
		$this->db->set('fld_name_en',$_data['fld_name_en']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_organization_id',$_data['fld_organization_id']);
		$this->db->set('fld_date',$_data['fld_date']);
		$this->db->set('fld_type_stop_working',$_data['fld_type_stop_working']);
		$this->db->set('fld_active',1);
		$this->db->set('fld_trash',1);
		$this->db->set('fld_created_at',date('Y-m-d H:i:s'));
		$this->db->insert('worktime_holiday_dates');

		$id = $this->db->insert_id();

		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'เพิ่ม' ,
				"fld_table_name" => 'worktime_holiday_dates',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_holiday_dates_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_name_th',$_data['fld_name_th']);
		$this->db->set('fld_name_en',$_data['fld_name_en']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_organization_id',$_data['fld_organization_id']);
		$this->db->set('fld_date',$_data['fld_date']);
		$this->db->set('fld_type_stop_working',$_data['fld_type_stop_working']);
		$this->db->set('fld_updated_at',date('Y-m-d H:i:s'));
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_holiday_dates');

		$id = $_data['fld_id'];
      
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'แก้ไข' ,
				"fld_table_name" => 'worktime_holiday_dates',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_holiday_dates_active_model() 
	{
	
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_active',$_data['fld_active']);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_holiday_dates');

		$id = $_data['fld_id'];

		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'การใช้งาน ' . $_data['fld_active'] ,
				"fld_table_name" => 'worktime_holiday_dates',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';

	}

	public function delete_holiday_dates_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_trash',0);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_holiday_dates');

		$id = $_data['fld_id'];
		
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'ลบ' ,
				"fld_table_name" => 'worktime_holiday_dates',
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
