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

		$data['custom_js_data'] = $datachart;

		$this->load->view('master',$data);
	}

	private function LoadIupData(&$datachart) 
	{
		$this->load->model('Admin_model'); 
		$url = $this->Admin_model->LoadWfs();
		// $url = "http://103.253.107.103:8088/geoserver/disbun/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=disbun:ZD_IjinUsahaPerkebunan_AR&outputformat=json";
		$json = file_get_contents($url);
		$datachart['iup_data'] = $json;
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
