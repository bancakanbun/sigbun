<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota extends CI_Controller {

	public function Save()
	{
		$this->load->model('Kota_model'); 

		$kode_kota = $this->input->post("kodekota");
		$nama_kota = $this->input->post("namakota");
		$mode = $this->input->post("editmode");

		if($mode=="edit")
		{
			$kode_lama = $this->input->post("kodelama");
			$nama_lama = $this->input->post("namalama");
			$this->Kota_model->UpdateData($kode_kota,$nama_kota,$kode_lama,$nama_lama);
		}
		else
			$this->Kota_model->NewData($kode_kota,$nama_kota);
	}

	public function Delete() {
		$this->load->model('Kota_model'); 

		$kode_kota = $this->input->post("kodekota");
		$nama_kota = $this->input->post("namakota");

		$this->Kota_model->DeleteData($kode_kota,$nama_kota);
	}

}
