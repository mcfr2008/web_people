<?php

class Vaccine_covid_19_type_model extends CI_Model {

    function __construct() {
      
        parent::__construct();

        $this->load->model('Activity_log_model');
        
    }

	public function get_vaccine_covid_19_type_active_status_model()
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

	public function get_vaccine_covid_19_type_all_model() 
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
		$this->db->from('vaccine_covid_19_type');
		$this->db->order_by('fld_id','ASC'); 
		$data['data'] = $this->db->get()->result_array();

		return $data;
    }

	public function get_vaccine_covid_19_type_model()
	{

		$this->db = $this->load->database('default', TRUE);

		$_data = $_REQUEST;

		$PerPage = $_data['PerPage'];
		$pageNumber = $_data['pageNumber'] * $PerPage;

		$search_text = explode(" ",$_data['search_text']);
		$count_search_text = count($search_text);
		$search_active = $_data['search_active'];

		$this->db->select("
			vaccine_covid_19_type.* , 
			CASE
				WHEN vaccine_covid_19_type.fld_active = 1  THEN '<span class=\"text-primary\"><i class=\"fa fa-eye\"></i>  ใช้งาน</span>'
				WHEN vaccine_covid_19_type.fld_active = 0  THEN '<span class=\"text-black\"><i class=\"fa fa-eye-slash\"></i> ไม่ใช้งาน</span>'
				ELSE ''
			END AS html_active_status,
		");
		$this->db->from('vaccine_covid_19_type');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('vaccine_covid_19_type.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('vaccine_covid_19_type.fld_name_th',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('vaccine_covid_19_type.fld_name_en',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_active != ''){
			$this->db->where('vaccine_covid_19_type.fld_active',$search_active);
		}
		$this->db->where('vaccine_covid_19_type.fld_trash',1);
		$this->db->limit($PerPage,$pageNumber);
		$this->db->order_by('vaccine_covid_19_type.fld_id','ASC'); 
		$data['data'] = $this->db->get()->result_array();


		$this->db->select('count(*) AS count');
		$this->db->from('vaccine_covid_19_type');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('vaccine_covid_19_type.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('vaccine_covid_19_type.fld_name_th',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('vaccine_covid_19_type.fld_name_en',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_active != ''){
			$this->db->where('vaccine_covid_19_type.fld_active',$search_active);
		}
		$this->db->where('vaccine_covid_19_type.fld_trash',1);
		$data['total'] = $this->db->get()->result_array()[0]['count'];

		return $data;
		
	}

	public function get_vaccine_covid_19_type_byid_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

        $this->db->select('
			vaccine_covid_19_type.*,
			
		');
		$this->db->from('vaccine_covid_19_type');
		$this->db->where('vaccine_covid_19_type.fld_id',$_data['fld_id']); 
		$data['data'] = $this->db->get()->result_array()[0];

		return $data;
    }

	public function post_vaccine_covid_19_type_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;
	
		$this->db->set('fld_name_th',$_data['fld_name_th']);
		$this->db->set('fld_name_en',$_data['fld_name_en']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_active',1);
		$this->db->set('fld_trash',1);
		$this->db->set('fld_created_at',date('Y-m-d H:i:s'));
		$this->db->insert('vaccine_covid_19_type');

		$id = $this->db->insert_id();
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'เพิ่ม' ,
				"fld_table_name" => 'vaccine_covid_19_type',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_vaccine_covid_19_type_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;
	
		$this->db->set('fld_name_th',$_data['fld_name_th']);
		$this->db->set('fld_name_en',$_data['fld_name_en']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_updated_at',date('Y-m-d H:i:s'));
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('vaccine_covid_19_type');

		$id = $_data['fld_id'];
      
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'แก้ไข' ,
				"fld_table_name" => 'vaccine_covid_19_type',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_vaccine_covid_19_type_active_model() 
	{
	
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_active',$_data['fld_active']);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('vaccine_covid_19_type');

		$id = $_data['fld_id'];

		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'การใช้งาน ' . $_data['fld_active'] ,
				"fld_table_name" => 'vaccine_covid_19_type',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';

	}

	public function delete_vaccine_covid_19_type_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_trash',0);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('vaccine_covid_19_type');

		$id = $_data['fld_id'];
		
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'ลบ' ,
				"fld_table_name" => 'vaccine_covid_19_type',
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
