<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['load_map'] = true;
		$data['load_datatable'] = false;
		$data['template'] = 'home/Home';
		$data['custom_css'] = '';
		$data['custom_js'] = 'home/home_custom_js';
		$this->load->view('master',$data);
	}

	public function unauthorized()
	{
		$data['show_left_menu'] = false;
		$data['template'] = 'home/unauthorize';
		$data['custom_css'] = '';
		$data['custom_js'] = '';

		$this->load->view('master',$data);		
	}
}
