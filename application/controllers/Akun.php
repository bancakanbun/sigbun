<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function Save()
	{
		$kode = $this->input->post("kode");
		$nama = $this->input->post("nama");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$level = $this->input->post("level");
		$kode_kota = $this->input->post("kodekota");
		$mode = $this->input->post("editmode");

		$this->load->model('Akun_model'); 
		if($mode=="edit")
			$this->Akun_model->UpdateData($kode,$nama,$username,$level,$kode_kota);
		else
			$this->Akun_model->NewData($nama,$username,$password,$level,$kode_kota);
	}

	public function Delete() {
		$kode = $this->input->post("kode");

		$this->load->model('Akun_model'); 
		$this->Akun_model->DeleteData($kode);
	}

}
