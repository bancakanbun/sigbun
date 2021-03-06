<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun extends CI_Controller {

	public function Save()
	{
		$kodetahun = $this->input->post("kodetahun");
		$namatahun = $this->input->post("namatahun");
		$mode = $this->input->post("editmode");

		$this->load->model('Tahun_model'); 
		if($mode=="edit")
			$this->Tahun_model->UpdateData($kodetahun,$namatahun);
		else
			$this->Tahun_model->NewData($namatahun);
	}

	public function Delete() {
		$kodetahun = $this->input->post("kodetahun");

		$this->load->model('Tahun_model'); 
		$this->Tahun_model->DeleteData($kodetahun,$namatahun);
	}

}
