<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengamatan extends CI_Controller {

	public function Save()
	{
		$strinfo = $this->input->post("info");
		$mode = $this->input->post("editmode");

		$info = json_decode($strinfo);

		$this->load->model('Pengamatan_model'); 
		if($mode=="edit") {
			$this->Pengamatan_model->DeletePengamatan($info->idlama);
			$this->Pengamatan_model->DeletePengamatanDetail($info->idlama);
		}

		$this->Pengamatan_model->SavePengamatan($info);
		foreach($info->details as $detail) $this->Pengamatan_model->SavePengamatanDetail($detail);
	}

	public function Delete() {
		$kode_desa = $this->input->post("kodedesa");

		$this->load->model('Pengamatan_model'); 
		$this->Pengamatan_model->DeleteData($kode_desa);
	}

	public function GetByCity($kodekota) {
		$this->load->model('Pengamatan_model'); 
		$data = $this->Pengamatan_model->LoadByKota($kodekota);

		$data = json_encode($data->result());
		echo $data;
	}

}
