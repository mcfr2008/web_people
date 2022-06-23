<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Worktime_leave_types extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		// $this->load->model('Activity_log_model');
		$this->load->model('Worktime_leave_types_model');
		// $this->Main_model->check_session();
	}

	public function index() 
	{

		$check_user_access = $this->Main_model->check_user_access();

		if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/index"])) {

			$this->load->view('template/header');
			$this->load->view('template/css/con-css-1');
			$this->load->view('template/navbar');
			$this->load->view('template/sidebar');
			$this->load->view('worktime_leave_types/leave_types-home');
			$this->load->view('template/footer');

			$this->load->view('template/js/con-js-1');
			$this->load->view('template/js/all-js-1');
			$this->load->view('worktime_leave_types/js/leave_types-home-js');

		}else{

			$this->Main_model->error_403();

		}

	}

	public function get_leave_types_active_status() 
	{
		$data = $this->Worktime_leave_types_model->get_leave_types_active_status_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_leave_types_all() 
	{
		$data = $this->Worktime_leave_types_model->get_leave_types_all_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_leave_types() 
	{
		$data = $this->Worktime_leave_types_model->get_leave_types_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_leave_types_byid() 
	{
		$data = $this->Worktime_leave_types_model->get_leave_types_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function post_leave_types() 
	{
		$data = $this->Worktime_leave_types_model->post_leave_types_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_leave_types() 
	{
		$data = $this->Worktime_leave_types_model->put_leave_types_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_leave_types_active() 
	{
		$data = $this->Worktime_leave_types_model->put_leave_types_active_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_leave_types() 
	{
		$data = $this->Worktime_leave_types_model->delete_leave_types_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

