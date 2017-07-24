<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['active_menu'] = "dashboard";
		$data['template'] = 'dashboard/Index';
		$data['custom_js'] = 'dashboard/custom_js';
		$data['load_chart'] = true;

		$this->load->model('Dashboard_model'); 

		$data['tahun'] = $this->Dashboard_model->DaftarTahun();
		$datachart['kota'] = $this->Dashboard_model->DaftarKota();
		$datachart['max_tahun'] = $this->Dashboard_model->GetMaxTahunOptData();

		$this->LoadIupData($datachart);
		$this->LoadSipKebunData($datachart);
		$this->LoadSp2bks($datachart);

		$data['custom_js_data'] = $datachart;

		$this->load->view('master',$data);
	}

	private function LoadIupData(&$datachart) 
	{
		$this->load->model('Admin_model'); 
		$url = $this->Admin_model->LoadWfs();
		$json = file_get_contents($url);
		$datachart['iup_data'] = $json;
	}

	private function LoadSipKebunData(&$datachart) {
		$url = "http://sipkebun.kaltimprov.go.id/index.php/webjson/tabel/tb_produksi";
		$json = file_get_contents($url);
		$datachart['sipkebun_data'] = $json;
	}

	private function LoadSp2bks(&$datachart) {
		$url = "http://sp2bks.kaltimprov.go.id/baru/json/jumlah_permohonan/9e4b2c87c10c30fa31706d4de171bd60/2017";
		$json = file_get_contents($url);
		$datachart['sp2bks'] = $json;
	}

	public function GetSeranganOptLuas($tahun)
	{
		$this->load->model('Dashboard_model'); 
		$data = $this->Dashboard_model->SeranganOpt($tahun);

		$data = json_encode($data->result());
		echo $data;
	}

	public function GetSeranganOptRugi($tahun)
	{
		$this->load->model('Dashboard_model'); 
		$data = $this->Dashboard_model->SeranganOptRugi($tahun);

		$data = json_encode($data->result());
		echo $data;
	}

}
