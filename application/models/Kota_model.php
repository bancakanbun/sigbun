<?php 
class Kota_model extends CI_Model {

    function __construct() { 
        parent::__construct(); 
    }

    private function LoadDatabase() {
        $this->load->database();
    } 

    private function CloseDatabase() {
        $this->db->close();
    }

    public function LoadAll() {
        $this->LoadDatabase();
        $query = $this->db->get('m_kota');
        $this->CloseDatabase();

        return $query;
    }

    public function NewData($kodekota,$namakota) {
        $this->LoadDatabase();

        $data = array('id_kota' => $kodekota, 'nm_kota' => $namakota);
        $this->db->insert('m_kota', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kodekota,$namakota,$kodelama,$namalama) {
        $this->LoadDatabase();

        $data = array('id_kota' => $kodekota, 'nm_kota' => $namakota);
        $this->db->where('id_kota',$kodelama);
        $this->db->where('nm_kota',$namalama);
        $this->db->update('m_kota', $data);

        $this->CloseDatabase();
    }

    public function DeleteData($kodekota,$namakota) {
        $this->LoadDatabase();

        $this->db->where('id_kota',$kodekota);
        $this->db->where('nm_kota',$namakota);
        $this->db->delete('m_kota');
        $this->CloseDatabase();
    }

} 
?> 