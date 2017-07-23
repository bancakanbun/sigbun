<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peta extends CI_Controller {

	public function index()
	{
		$data['load_map'] = true;
		$data['load_datatable'] = false;
		$data['template'] = 'peta/Index';
		$data['custom_css'] = 'peta/custom_css';
		$data['custom_js'] = 'peta/custom_js';
		$data['active_menu'] = "peta";
		$this->load->view('master',$data);
	}
}
