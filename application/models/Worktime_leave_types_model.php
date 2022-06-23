<?php

class Worktime_leave_types_model extends CI_Model {

    function __construct() {
      
        parent::__construct();

        $this->load->model('Activity_log_model');
        
    }

	public function get_leave_types_active_status_model()
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

	public function get_leave_types_all_model()
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
		$this->db->from('worktime_leave_types');
		$this->db->order_by('fld_id','ASC'); 
		$data['data'] = $this->db->get()->result_array();

		return $data;
		
	}

	public function get_leave_types_model()
	{

		$this->db = $this->load->database('default', TRUE);

		$_data = $_REQUEST;

		$PerPage = $_data['PerPage'];
		$pageNumber = $_data['pageNumber'] * $PerPage;

		$search_text = explode(" ",$_data['search_text']);
		$count_search_text = count($search_text);
		$search_active = $_data['search_active'];

		$this->db->select("
			worktime_leave_types.* , 
			CASE
				WHEN worktime_leave_types.fld_active = 1  THEN '<span class=\"text-primary\"><i class=\"fa fa-eye\"></i>  ใช้งาน</span>'
				WHEN worktime_leave_types.fld_active = 0  THEN '<span class=\"text-black\"><i class=\"fa fa-eye-slash\"></i> ไม่ใช้งาน</span>'
				ELSE ''
			END AS html_active_status,
		");
		$this->db->from('worktime_leave_types');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('worktime_leave_types.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leave_types.fld_name_th',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leave_types.fld_name_en',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_active != ''){
			$this->db->where('worktime_leave_types.fld_active',$search_active);
		}
		$this->db->where('worktime_leave_types.fld_trash',1);
		$this->db->limit($PerPage,$pageNumber);
		$this->db->order_by('worktime_leave_types.fld_order','ASC'); 
		$data['data'] = $this->db->get()->result_array();


		$this->db->select('count(*) AS count');
		$this->db->from('worktime_leave_types');
		if($search_text != ''){
			$this->db->group_start();
				for($i=0;$i<$count_search_text;$i++){
					$this->db->like('worktime_leave_types.fld_id',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leave_types.fld_name_th',$search_text[$i]);
				}
				for($i=0;$i<$count_search_text;$i++){
					$this->db->or_like('worktime_leave_types.fld_name_en',$search_text[$i]);
				}
			$this->db->group_end();
		}
		if($search_active != ''){
			$this->db->where('worktime_leave_types.fld_active',$search_active);
		}
		$this->db->where('worktime_leave_types.fld_trash',1);
		$data['total'] = $this->db->get()->result_array()[0]['count'];

		return $data;
		
	}

	public function get_leave_types_byid_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

        $this->db->select('
			worktime_leave_types.*,
			
		');
		$this->db->from('worktime_leave_types');
		$this->db->where('worktime_leave_types.fld_id',$_data['fld_id']); 
		$data['data'] = $this->db->get()->result_array()[0];

		return $data;
    }

	public function post_leave_types_model() 
    {

		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;
	
		$this->db->set('fld_name_th',$_data['fld_name_th']);
		$this->db->set('fld_name_en',$_data['fld_name_en']);
		$this->db->set('fld_group',$_data['fld_group']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_active',1);
		$this->db->set('fld_trash',1);
		$this->db->set('fld_created_at',date('Y-m-d H:i:s'));
		$this->db->insert('worktime_leave_types');

		$id = $this->db->insert_id();

		//-------------------------------------run_order-------------------------------------------------

			$this->db->select_max('fld_order');
			$this->db->from('worktime_leave_types');
			$this->db->where('fld_trash', 1);
			$data_order_max = $this->db->get()->result_array();

			if(count($data_order_max) > 0){
				$data2_order_max = $data_order_max[0]['fld_order'] + 1;
			}else{
				$data2_order_max = 1;
			}

			// $id id table
			// $value1 NewOrderVal
			// $value2 OriginalOrderVal

			$this->run_order($id,$_data['order_new'],$data2_order_max);

		//-------------------------------------END-run_order---------------------------------------------

		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'เพิ่ม' ,
				"fld_table_name" => 'worktime_leave_types',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_leave_types_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		//-------------------------------------run_order-------------------------------------------------

			// $id id table
			// $value1 NewOrderVal
			// $value2 OriginalOrderVal

			$this->run_order($_data['fld_id'],$_data['order_new'],$_data['order_old']);

		//-------------------------------------END-run_order---------------------------------------------
	
		$this->db->set('fld_name_th',$_data['fld_name_th']);
		$this->db->set('fld_name_en',$_data['fld_name_en']);
		$this->db->set('fld_group',$_data['fld_group']);
		$this->db->set('fld_other_details',$_data['fld_other_details']);
		$this->db->set('fld_updated_at',date('Y-m-d H:i:s'));
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_leave_types');

		$id = $_data['fld_id'];
      
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'แก้ไข' ,
				"fld_table_name" => 'worktime_leave_types',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';
    }

	public function put_leave_types_active_model() 
	{
	
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_active',$_data['fld_active']);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_leave_types');

		$id = $_data['fld_id'];

		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'การใช้งาน ' . $_data['fld_active'] ,
				"fld_table_name" => 'worktime_leave_types',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		return 'success';

	}

	public function delete_leave_types_model() 
    {
       
		$this->db = $this->load->database('default', TRUE);

		$_data  = $_REQUEST;

		$this->db->set('fld_trash',0);
		$this->db->set('fld_order', 'NULL', false);
		$this->db->where('fld_id',$_data['fld_id']);
		$this->db->update('worktime_leave_types');

		$id = $_data['fld_id'];
		
		//-------------------------------------Activity_log-------------------------------------------------
			$data_activity_log = array();
			$data_activity_log = array(
				"fld_activity" => 'ลบ' ,
				"fld_table_name" => 'worktime_leave_types',
				"fld_table_id" => $id,
				"fld_creator_id" => $_SESSION['people_id'],
				"fld_creator_date" => date('Y-m-d H:i:s')
			);
			$this->Activity_log_model->add_activity_log_1_model($data_activity_log);
		//-------------------------------------END-Activity_log--------------------------------------------

		
	
		return 'success';
	
    }

	function run_order($id,$value1,$value2)
	{

		// $id id table
		// $value1 NewOrderVal
		// $value2 OriginalOrderVal

		if($value1 < $value2){
			$this->db->set('fld_order', 'fld_order+1', FALSE);
			$this->db->where('fld_order >=', $value1);
			$this->db->where('fld_order <=', $value2-1);
			$this->db->update('worktime_leave_types');
		}


		if($value1 > $value2){
			$this->db->set('fld_order', 'fld_order-1', FALSE);
			$this->db->where('fld_order >=', $value2+1);
			$this->db->where('fld_order <=', $value1);
			$this->db->update('worktime_leave_types');
		}

		$this->db->set('fld_order',$value1);
		$this->db->where('fld_id',$id);
		$this->db->update('worktime_leave_types');

		return 'success';
		
	}
  
}

?>
