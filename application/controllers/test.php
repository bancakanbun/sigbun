<?php 
class Test extends CI_Controller {  

	public function index() { 
		$this->load->view('test'); 
	} 

	public function hello() { 
		echo "This is hello function."; 
	} 

	public function data() {
		// echo "This is data function.";
		$this->load->database();

		$query = $this->db->get('m_tahun');
		foreach ($query->result() as $row) { echo $row->nm_tahun; }
	}
} 
?>