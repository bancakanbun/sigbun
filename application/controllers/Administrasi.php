<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends CI_Controller {

    function __construct() { 
        parent::__construct(); 
        $this->CheckUserAccess();
    }
    
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

	private function CheckUserAccess() {
		if(!CheckAkses("Administrator")) { redirect('home/unauthorized'); }
	}

	public function index()
	{
		//$this->CheckUserAccess();
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

	public function wfs() {
		$data = $this->InitiateTemplate(false,false,'administrasi/wfs','','administrasi/wfs_js');
		$this->load->model('Admin_model'); 
		$data['url'] = $this->Admin_model->LoadWfs();
		$this->OpenView($data);		
	}

	public function savewfs() {
		$url = $this->input->post("url");

		$this->load->model('Admin_model'); 
		$this->Admin_model->SaveWfs($url);
	}


	public function Log() {
		$data = $this->InitiateTemplate(false,true,'administrasi/Log','','administrasi/Log_js');

		$this->load->model('Akun_model'); 
		$data['data'] = $this->Akun_model->GetUserActivities();

		$this->OpenView($data);
	}
}
