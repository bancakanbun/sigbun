<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends CI_Controller {

	private function InitiateTemplate($load_map,$load_datatable,$template_path,$custom_css_path,$custom_js_path) {
		$data['load_map'] = $load_map;
		$data['load_datatable'] = $load_datatable;
		$data['template'] = $template_path;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = "admin";

		return $data;	
	}

	private function OpenView($data) {
		$this->load->view('master',$data);
	}

	public function index()
	{
		$data = $this->InitiateTemplate(false,false,'administrasi/Index','','');
		$this->OpenView($data);
	}

	public function akun() 
	{
		$data = $this->InitiateTemplate(false,true,'administrasi/Akun','','administrasi/Akun_js');

		$this->load->model('Kota_model'); 
		$data['kota'] = $this->Kota_model->LoadAll();
		$this->load->model('Akun_model'); 
		$data['data'] = $this->Akun_model->LoadAll();

		$this->OpenView($data);
	}
}
