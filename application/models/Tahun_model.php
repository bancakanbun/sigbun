<?php 
class Tahun_model extends CI_Model {

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
        $this->db->order_by('nm_tahun');
        $query = $this->db->get('m_tahun');
        $this->CloseDatabase();

        return $query;
    }

    public function NewData($namatahun) {
        $this->LoadDatabase();
        $data = array('nm_tahun' => $namatahun);
        $this->db->insert('m_tahun', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kodetahun,$namatahun) {
        $this->LoadDatabase();
        $data = array('nm_tahun' => $namatahun);
        $this->db->where('id_tahun',$kodetahun);
        $this->db->update('m_tahun', $data);
        $this->CloseDatabase();
    }

    public function DeleteData($kodetahun) {
        $this->LoadDatabase();
        $this->db->where('id_tahun',$kodetahun);
        $this->db->delete('m_tahun');
        $this->CloseDatabase();
    }

} 
?> 