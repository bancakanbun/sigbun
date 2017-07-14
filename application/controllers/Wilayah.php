<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

	public function Save()
	{
		$this->load->model('Wilayah_model'); 

		$kodewilayah = $this->input->post("kodewilayah");
		$kodedesa = $this->input->post("kodedesa");
		$kodetanaman = $this->input->post("kodetanaman");
		$luas = $this->input->post("luas");
		$harga = $this->input->post("harga");
		$mode = $this->input->post("editmode");

		if($mode=="edit")
			$this->Wilayah_model->UpdateData($kodewilayah,$kodedesa,$kodetanaman,$luas,$harga);
		else
			$this->Wilayah_model->NewData($kodedesa,$kodetanaman,$luas,$harga);
	}

	public function Delete() {
		$this->load->model('Wilayah_model'); 

		$kodewilayah = $this->input->post("kodewilayah");

		$this->Wilayah_model->DeleteData($kodewilayah);
	}

}
