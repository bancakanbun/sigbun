<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opt extends CI_Controller {

	public function Save()
	{
		$this->load->model('Opt_model'); 

		$kodeopt = $this->input->post("kodeopt");
		$namaopt = $this->input->post("namaopt");
		$namalatin = $this->input->post("namalatin");
		$persen = $this->input->post("persen");
		$idtanaman = $this->input->post("idtanaman");
		$mode = $this->input->post("editmode");

		if($mode=="edit")
			$this->Opt_model->UpdateData($kodeopt,$namaopt,$namalatin,$persen,$idtanaman);
		else
			$this->Opt_model->NewData($namaopt,$namalatin,$persen,$idtanaman);
	}

	public function Delete() {
		$this->load->model('Opt_model'); 

		$kodeopt = $this->input->post("kodeopt");

		$this->Opt_model->DeleteData($kodeopt);
	}

}
