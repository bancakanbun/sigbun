<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

	public function Save()
	{
		$this->load->model('Desa_model'); 

		$kode_desa = $this->input->post("kodedesa");
		$nama_desa = $this->input->post("namadesa");
		$kode_kota = $this->input->post("kodekota");
		$mode = $this->input->post("editmode");

		if($mode=="edit")
			$this->Desa_model->UpdateData($kode_desa,$nama_desa,$kode_kota);
		else
			$this->Desa_model->NewData($nama_desa,$kode_kota);
	}

	public function Delete() {
		$this->load->model('Desa_model'); 

		$kode_desa = $this->input->post("kodedesa");

		$this->Desa_model->DeleteData($kode_desa);
	}

	public function GetByCity($kodekota) {
		$this->load->model('Desa_model'); 
		$data = $this->Desa_model->LoadByKota($kodekota);

		$data = json_encode($data->result());
		echo $data;
	}

}
