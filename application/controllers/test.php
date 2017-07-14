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

	public function maks() {
		$kodekota = 'BPN';
		$this->load->database();
		$this->db->select_max('id_desa');
		$this->db->where('id_kota',$kodekota);
        $query = $this->db->get('m_desa');
        $this->db->close();

        $row = $query->row();
        // echo $row->id_desa;
        $id = explode($kodekota,$row->id_desa);
        // echo $id[0]."-".$id[1];
        echo $id[0].$kodekota.str_pad($id[1]+1, 3, "0", STR_PAD_LEFT);
	}
} 
?>