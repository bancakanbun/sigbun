<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaporan extends CI_Controller {

	private function InitiateTemplate($load_map,$load_datatable,$template_path,$custom_css_path,$custom_js_path) {
		$data['load_map'] = $load_map;
		$data['load_datatable'] = $load_datatable;
		$data['template'] = $template_path;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = "pelaporan";

		return $data;	
	}

	private function OpenView($data) {
		$this->load->view('master',$data);
	}

	public function index()
	{
		$data = $this->InitiateTemplate(false,true,'pelaporan/Index','','pelaporan/custom_js');
		$this->OpenView($data);
	}

	public function komoditi()
	{
		$data = $this->InitiateTemplate(false,true,'pelaporan/Komoditi','','pelaporan/Komoditi_js');

		$this->load->model('Pelaporan_model'); 
		$data['data'] = $this->Pelaporan_model->DaftarKomoditi();

		$this->OpenView($data);
	}

	public function opt()
	{
		$data = $this->InitiateTemplate(false,true,'pelaporan/Opt','','pelaporan/Opt_js');

		$this->load->model('Pelaporan_model'); 
		$data['data'] = $this->Pelaporan_model->Opt();

		$this->OpenView($data);
	}

	public function lahankebun() {
		$data = $this->InitiateTemplate(false,true,'pelaporan/LahanPerkebunan','','pelaporan/LahanPerkebunan_js');

		$this->load->model('Pelaporan_model'); 
		$data['data'] = $this->Pelaporan_model->LahanPerkebunan();

		$this->OpenView($data);
	}

	public function pengamatanopt() {
		$data = $this->InitiateTemplate(false,true,'pelaporan/PengamatanOpt','','pelaporan/PengamatanOpt_js');

		$this->load->model('Pelaporan_model'); 
		$data['data'] = $this->Pelaporan_model->RekapPengamatanOpt();

		$this->OpenView($data);
	}

	public function seranganopt() {
		$data = $this->InitiateTemplate(false,true,'pelaporan/SeranganOpt','','pelaporan/SeranganOpt_js');

		$this->load->model('Pelaporan_model'); 
		$data['data'] = $this->Pelaporan_model->RekapPengamatanOpt();

		$this->OpenView($data);
	}
	
}
