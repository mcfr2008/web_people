<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_prefix extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		// $this->load->model('Activity_log_model');
		$this->load->model('Employee_prefix_model');
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
			$this->load->view('employee_prefix/prefix-home');
			$this->load->view('template/footer');

			$this->load->view('template/js/con-js-1');
			$this->load->view('template/js/all-js-1');
			$this->load->view('employee_prefix/js/prefix-home-js');

		}else{

			$this->Main_model->error_403();

		}

	}

	public function get_prefix_active_status() 
	{
		$data = $this->Employee_prefix_model->get_prefix_active_status_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_prefix_all() 
	{
		$data = $this->Employee_prefix_model->get_prefix_all_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_prefix() 
	{
		$data = $this->Employee_prefix_model->get_prefix_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_prefix_byid() 
	{
		$data = $this->Employee_prefix_model->get_prefix_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function post_prefix() 
	{
		$data = $this->Employee_prefix_model->post_prefix_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_prefix() 
	{
		$data = $this->Employee_prefix_model->put_prefix_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_prefix_active() 
	{
		$data = $this->Employee_prefix_model->put_prefix_active_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_prefix() 
	{
		$data = $this->Employee_prefix_model->delete_prefix_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

