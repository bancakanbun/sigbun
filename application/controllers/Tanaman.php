<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanaman extends CI_Controller {

	public function Save()
	{
		$this->load->model('Tanaman_model'); 

		$id_tanaman = $this->input->post("idtanaman");
		$nama_tanaman = $this->input->post("namatanaman");
		$produktivitas = $this->input->post("produktivitas");
		$mode = $this->input->post("editmode");

		if($mode=="edit")
			$this->Tanaman_model->UpdateData($id_tanaman,$nama_tanaman,$produktivitas);
		else
			$this->Tanaman_model->NewData($nama_tanaman,$produktivitas);
	}

	public function Delete() {
		$this->load->model('Tanaman_model'); 

		$id_tanaman = $this->input->post("idtanaman");

		$this->Tanaman_model->DeleteData($id_tanaman);
	}

}
