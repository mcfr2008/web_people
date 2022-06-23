<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tools_info extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->model('Main_model');
		// $this->load->model('Activity_log_model');
		$this->load->model('Tools_info_model');
		// $this->Main_model->check_session();
	}
	

	public function get_auto_employees() 
	{
		$_data = $_REQUEST;

		$result = $this->Tools_info_model->get_auto_employees_model(
			$_data['search_text'],
			$_data['employee_status'],
		);
		
		foreach($result as $val){

			// for select2 lib
			$arr['text'] = $val['fld_card_id']. ' > ' . $val['fld_give_name'].' '.$val['fld_family_name']  .' > '.$val['fld_nick_name'];
			
			// data
			$arr['id'] = $val['fld_id'];
			$arr['card_id'] = $val['fld_card_id'];
			$arr['card_barcode'] = $val['fld_card_barcode'];

			$arr['organization_id'] = $val['organization_id'];
			$arr['organization_name_th'] = $val['organization_name_th'];
			$arr['organization_name_en'] = $val['organization_name_en'];

			$arr['division_id'] = $val['division_id'];
			$arr['division_name_th'] = $val['division_name_th'];
			$arr['division_name_en'] = $val['division_name_en'];

			$arr['position_id'] = $val['position_id'];
			$arr['position_name_th'] = $val['position_name_th'];
			$arr['position_name_en'] = $val['position_name_en'];

			$arr['fullname'] = $val['fld_give_name'].' '.$val['fld_family_name'].' ('. $val['fld_nick_name'] .')';

			
			$data[] = $arr;
			
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	

}

