<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    function __construct() { 
        parent::__construct(); 
        $this->CheckUserAccess();
    }
    
	private function CheckUserAccess() {
		if( !CheckAksesGroup(["Administrator","Operator"]) ) { redirect('home/unauthorized'); }
	}

	private function InitiateTemplate($load_map,$load_datatable,$template_path,$custom_css_path,$custom_js_path) {
		$data['load_map'] = $load_map;
		$data['load_datatable'] = $load_datatable;
		$data['template'] = $template_path;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = "update";

		return $data;	
	}

	private function OpenView($data) {
		$this->load->view('master',$data);
	}

	public function index()
	{
		$data = $this->InitiateTemplate(false,true,'edit/Index','','edit/Index_js');
		$this->OpenView($data);
	}

	public function tahun() 
	{
		$data = $this->InitiateTemplate(false,true,'edit/Tahun','','edit/Tahun_js');

		$this->load->model('Tahun_model'); 
		$data['data'] = $this->Tahun_model->LoadAll();

		$this->OpenView($data);
	}

	public function kota() 
	{
		$data = $this->InitiateTemplate(false,true,'edit/Kota','','edit/Kota_js');

		$this->load->model('Kota_model'); 
		$data['data'] = $this->Kota_model->LoadAll();

		$this->OpenView($data);
	}

	public function desa() 
	{
		$data = $this->InitiateTemplate(false,true,'edit/Desa','','edit/Desa_js');

		$this->load->model('Kota_model'); 
		$data['kota'] = $this->Kota_model->LoadAll();
		$this->load->model('Desa_model'); 
		$data['data'] = $this->Desa_model->LoadAll();

		$this->OpenView($data);
	}

	public function komoditi() 
	{
		$data = $this->InitiateTemplate(false,true,'edit/Tanaman','','edit/Tanaman_js');

		$this->load->model('Tanaman_model'); 
		$data['data'] = $this->Tanaman_model->LoadAll();

		$this->OpenView($data);
	}

	public function lahankebun() {
		$data = $this->InitiateTemplate(false,true,'edit/Wilayah','','edit/Wilayah_js');

		$this->load->model('Wilayah_model'); 
		$data['data'] = $this->Wilayah_model->LoadAll();
		$this->load->model('Kota_model'); 
		$data['kota'] = $this->Kota_model->LoadAll();
		$this->load->model('Tanaman_model'); 
		$data['komoditi'] = $this->Tanaman_model->LoadAll();

		$this->OpenView($data);
	}

	public function opt()
	{
		$data = $this->InitiateTemplate(false,true,'edit/Opt','','edit/Opt_js');

		$this->load->model('Opt_model'); 
		$data['data'] = $this->Opt_model->LoadAll();
		$this->load->model('Tanaman_model'); 
		$data['tanaman'] = $this->Tanaman_model->LoadAll();

		$this->OpenView($data);
	}

	public function pengamatan($mode="index",$id = "") {
		if($mode=="index") {
			$data = $this->InitiateTemplate(false,true,'edit/PengamatanOpt','','edit/PengamatanOpt_js');

			$this->load->model('Pengamatan_model'); 
			$data['data'] = $this->Pengamatan_model->LoadAll();

			$this->OpenView($data);
		}
		else if($mode=="tambah") {
			$data = $this->InitiateTemplate(false,true,'edit/PengamatanAdd','','edit/PengamatanAdd_js');

			$this->load->model('Tahun_model'); 
			$data['tahun'] = $this->Tahun_model->LoadAll();
			$this->load->model('Wilayah_model'); 
			$data['komoditi'] = $this->Wilayah_model->GetKomoditi();

			$this->OpenView($data);
		}
		else if($mode=="update") {
			$data = $this->InitiateTemplate(false,true,'edit/PengamatanEdit','','edit/PengamatanEdit_js');

			$this->load->model('Tahun_model'); 
			$data['tahun'] = $this->Tahun_model->LoadAll();
			$this->load->model('Wilayah_model'); 
			$data['komoditi'] = $this->Wilayah_model->GetKomoditi();

			$this->load->model('Pengamatan_model'); 
			$datajs['info'] = $this->Pengamatan_model->Load($id)->row();
			$data['detail'] = $this->Pengamatan_model->LoadDetail($id);
			$data['custom_js_data'] = $datajs;

			$this->OpenView($data);
		}
	}
	
}
