<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

	public function Save()
	{
		$kodewilayah = $this->input->post("kodewilayah");
		$kodedesa = $this->input->post("kodedesa");
		$kodetanaman = $this->input->post("kodetanaman");
		$luas = $this->input->post("luas");
		$harga = $this->input->post("harga");
		$mode = $this->input->post("editmode");

		$this->load->model('Wilayah_model'); 
		if($mode=="edit")
			$this->Wilayah_model->UpdateData($kodewilayah,$kodedesa,$kodetanaman,$luas,$harga);
		else
			$this->Wilayah_model->NewData($kodedesa,$kodetanaman,$luas,$harga);
	}

	public function Delete() {
		$kodewilayah = $this->input->post("kodewilayah");

		$this->load->model('Wilayah_model'); 
		$this->Wilayah_model->DeleteData($kodewilayah);
	}

	public function GetKotaByKomoditi($komoditi) {
		$this->load->model('Wilayah_model'); 
		$data = $this->Wilayah_model->GetKotaByKomoditi($komoditi);

		$data = json_encode($data->result());
		echo $data;
	}

	public function GetDesaByKomoditiAndKota($komoditi,$kota) {
		$this->load->model('Wilayah_model'); 
		$data = $this->Wilayah_model->GetDesaByKomoditiAndKota($komoditi,$kota);

		$data = json_encode($data->result());
		echo $data;
	}

	public function GetWilayah($komoditi,$desa) {
		$this->load->model('Wilayah_model'); 
		$data = $this->Wilayah_model->GetWilayah($komoditi,$desa);

		$data = json_encode($data->result());
		echo $data;
	}

}
