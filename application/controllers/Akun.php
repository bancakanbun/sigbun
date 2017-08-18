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
		$telp = $this->input->post("telp");
		$email = $this->input->post("email");

		$this->load->model('Akun_model'); 
		if($mode=="edit")
			$this->Akun_model->UpdateData($kode,$nama,$username,$level,$kode_kota,$telp,$email);
		else
			$this->Akun_model->NewData($nama,$username,$password,$level,$kode_kota,$telp,$email);
	}

	public function Delete() {
		$kode = $this->input->post("kode");

		$this->load->model('Akun_model'); 
		$this->Akun_model->DeleteData($kode);
	}

	public function Login() {
		$data['show_left_menu'] = false;
		$data['template'] = 'administrasi/login';
		$data['custom_css'] = '';
		$data['custom_js'] = 'administrasi/login_js';

		$this->load->view('master',$data);		
	}

	public function DoLogin() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$this->load->model('Akun_model');

		$row =  $this->Akun_model->GetUser($username,$password);

		if (count($row)==0) echo("ERROR");
		else if (count($row)==1) {
			$user = array( "username"=>$row->username,"name"=>$row->name,"type"=>$row->type,"kota"=>$row->nm_kota);
			$this->session->set_userdata("userinfo",$user);
			echo("SUCCESS");
		}
	}

	public function Logout() {
		$this->session->unset_userdata('userinfo');
		redirect('akun/login');
	}

	public function Approve() {
		$kode = $this->input->post("kode");

		$this->load->model('Akun_model'); 
		$this->Akun_model->ApproveUser($kode);
	}

	public function UbahPassword() {
		$user = $this->session->userdata("userinfo");
		if(!$user) redirect('akun/login');

		$data['template'] = 'administrasi/ubah_password';
		$data['custom_css'] = '';
		$data['custom_js'] = 'administrasi/ubah_password_js';

		$this->load->view('master',$data);				
	}

	public function CheckPassword() {
		$user = $this->session->userdata("userinfo");
		$username = $user["username"];
		$password = $this->input->post("password");

		$this->load->model('Akun_model');

		$row =  $this->Akun_model->GetUser($username,$password);

		if (count($row)==0) echo("ERROR-".$username);
		else if (count($row)==1) echo("SUCCESS");

	}

	public function SavePassword() {
		$user = $this->session->userdata("userinfo");
		$username = $user["username"];
		$password = $this->input->post("password");

		$this->load->model('Akun_model'); 
		$this->Akun_model->UpdatePassword($username,$password);
	}

}
