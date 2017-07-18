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
		// $datachart['content'] = $this->Dashboard_model->SeranganOpt('2016');
		// $datachart['content2'] = $this->Dashboard_model->SeranganOptRugi('2016');
		$data['custom_js_data'] = $datachart;

		$this->load->view('master',$data);
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
