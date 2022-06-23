<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Worktime_holiday_dates extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		// $this->load->model('Activity_log_model');
		$this->load->model('Worktime_holiday_dates_model');
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
			$this->load->view('worktime_holiday_dates/holiday_dates-home');
			$this->load->view('template/footer');

			$this->load->view('template/js/con-js-1');
			$this->load->view('template/js/all-js-1');
			$this->load->view('worktime_holiday_dates/js/holiday_dates-home-js');

		}else{

			$this->Main_model->error_403();

		}

	}

	public function get_holiday_dates_active_status() 
	{
		$data = $this->Worktime_holiday_dates_model->get_holiday_dates_active_status_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_holiday_dates_type_stop_working_status_all() 
	{
		$data = $this->Worktime_holiday_dates_model->get_holiday_dates_type_stop_working_status_all_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_holiday_dates_type_stop_working_status() 
	{
		$data = $this->Worktime_holiday_dates_model->get_holiday_dates_type_stop_working_status_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_holiday_dates() 
	{
		$data = $this->Worktime_holiday_dates_model->get_holiday_dates_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_holiday_dates_byid() 
	{
		$data = $this->Worktime_holiday_dates_model->get_holiday_dates_byid_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function post_holiday_dates() 
	{
		$data = $this->Worktime_holiday_dates_model->post_holiday_dates_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_holiday_dates() 
	{
		$data = $this->Worktime_holiday_dates_model->put_holiday_dates_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function put_holiday_dates_active() 
	{
		$data = $this->Worktime_holiday_dates_model->put_holiday_dates_active_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_holiday_dates() 
	{
		$data = $this->Worktime_holiday_dates_model->delete_holiday_dates_model();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

