<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_dismissal extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		// $this->load->model('Activity_log_model');
		$this->load->model('Employee_dismissal_model');
		// $this->Main_model->check_session();
	}

	public function index() 
	{

		// $check_user_access = $this->Main_model->check_user_access();

		// if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/index"])) {

			$this->load->view('template/header');
			$this->load->view('template/css/con-css-1');
			$this->load->view('template/navbar');
			$this->load->view('template/sidebar');
			$this->load->view('Employee_dismissal/dismissal-home');
			$this->load->view('template/footer');

			$this->load->view('template/js/con-js-1');
			$this->load->view('template/js/all-js-1');
			
			$this->load->view('Employee_dismissal/js/dismissal-home-js');

		// }else{

		// 	$this->Main_model->error_403();

		// }

	}

	public function goto_manage($lang,$type,$id) 
	{

		$data['lang'] = $lang;
		$data['type'] = $type;
		$data['id'] = $id;

		if($lang == 'th'){
			if($type == 'add'){
				$data['type_name'] = 'เพิ่ม';
			}else if($type == 'edit'){
				$data['type_name'] = 'แก้ไข';
			}
		}else if($lang == 'en'){
			if($type == 'add'){
				$data['type_name'] = 'Add';
			}else if($type == 'edit'){
				$data['type_name'] = 'Edit';
			}
		}
		

		// $check_user_access = $this->Main_model->check_user_access();

		// if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/index"])) {

			$this->load->view('template/header');
			$this->load->view('template/css/con-css-1');
			$this->load->view('template/navbar');
			$this->load->view('template/sidebar');
			$this->load->view('Employee_dismissal/dismissal-manage',$data);
			$this->load->view('template/footer');

			$this->load->view('template/js/con-js-1');
			$this->load->view('template/js/all-js-1');
			$this->load->view('template/js/autocomplete-js-1');
			$this->load->view('template/js/select-option-js-1');
			
			$this->load->view('Employee_dismissal/js/dismissal-manage-js',$data);

		// }else{

		// 	$this->Main_model->error_403();

		// }

	}
	

	// public function get_dismissal() 
	// {
	// 	$data = $this->Employee_dismissal_model->get_dismissal_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	public function get_dismissal_byid() 
	{
		$data = $this->Employee_dismissal_model->get_dismissal_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function post_dismissal() 
	{
		$data = $this->Employee_dismissal_model->post_dismissal_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_dismissal() 
	{
		$data = $this->Employee_dismissal_model->put_dismissal_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// public function put_dismissal_unlock_approve() 
	// {
	// 	$data = $this->Employee_dismissal_model->put_dismissal_unlock_approve_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// public function delete_dismissal() 
	// {
	// 	$data = $this->Employee_dismissal_model->delete_dismissal_model();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

}

