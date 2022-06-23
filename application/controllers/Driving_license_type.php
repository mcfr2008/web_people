<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Driving_license_type extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		// $this->load->model('Activity_log_model');
		$this->load->model('Driving_license_type_model');
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
			$this->load->view('driving_license_type/driving-license-type-home');
			$this->load->view('template/footer');

			$this->load->view('template/js/con-js-1');
			$this->load->view('template/js/all-js-1');
			$this->load->view('driving_license_type/js/driving-license-type-home-js');

		}else{

			$this->Main_model->error_403();

		}

	}

	public function get_driving_license_type_active_status() 
	{
		$data = $this->Driving_license_type_model->get_driving_license_type_active_status_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_driving_license_type_all() 
	{
		$data = $this->Driving_license_type_model->get_driving_license_type_all_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_driving_license_type() 
	{
		$data = $this->Driving_license_type_model->get_driving_license_type_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_driving_license_type_byid() 
	{
		$data = $this->Driving_license_type_model->get_driving_license_type_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function post_driving_license_type() 
	{
		$data = $this->Driving_license_type_model->post_driving_license_type_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_driving_license_type() 
	{
		$data = $this->Driving_license_type_model->put_driving_license_type_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_driving_license_type_active() 
	{
		$data = $this->Driving_license_type_model->put_driving_license_type_active_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_driving_license_type() 
	{
		$data = $this->Driving_license_type_model->delete_driving_license_type_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

