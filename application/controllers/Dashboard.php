<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['template'] = 'dashboard/Index';
		$data['custom_js'] = 'dashboard/custom_js';
		$data['load_chart'] = true;

		$this->load->model('Dashboard_model'); 

		$datachart['tahun'] = $this->Dashboard_model->DaftarTahun();
		$datachart['kota'] = $this->Dashboard_model->DaftarKota();
		$datachart['content'] = $this->Dashboard_model->SeranganOpt('2016');
		$datachart['content2'] = $this->Dashboard_model->SeranganOptRugi('2016');
		$data['custom_js_data'] = $datachart;

		$this->load->view('master',$data);
	}

	
}
