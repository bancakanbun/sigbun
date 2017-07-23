<?php 
class Admin_model extends CI_Model {

    function __construct() { 
        parent::__construct(); 
    }

    private function LoadDatabase() {
        $this->load->database();
    } 

    private function CloseDatabase() {
        $this->db->close();
    }

    public function LoadWfs() {
        $this->LoadDatabase();
        $this->db->select('value');
        $this->db->where('setting','wfs');
        $query = $this->db->get('m_setting');
        $this->CloseDatabase();

        $row = $query->row();

        return $row->value;
    }

    public function SaveWfs($url) {
        $this->LoadDatabase();
        $data = array('value' => $url);
        $this->db->where('setting','wfs');
        $this->db->update('m_setting', $data);
        $this->CloseDatabase();
    }
} 
?> 