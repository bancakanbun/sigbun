<?php 
class Desa_model extends CI_Model {

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
        $this->db->select('id_desa,nm_desa,m_desa.id_kota,nm_kota');
        $this->db->from('m_desa');
        $this->db->join('m_kota', 'm_desa.id_kota = m_kota.id_kota', 'left');
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function LoadByKota($kodekota) {
        $this->LoadDatabase();
        $this->db->select('id_desa,nm_desa');
        $this->db->from('m_desa');
        $this->db->where('id_kota',strtoupper($kodekota));
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    private function GetNewId($kodekota) {
        $this->LoadDatabase();
        $this->db->select_max('id_desa');
        $this->db->where('id_kota',$kodekota);
        $query = $this->db->get('m_desa');
        $this->CloseDatabase();

        $row = $query->row();
        $id = explode($kodekota,$row->id_desa);
        return $id[0].$kodekota.str_pad($id[1]+1, 3, "0", STR_PAD_LEFT);;
    }

    public function NewData($namadesa,$kodekota) {
        $kodedesa = $this->GetNewId($kodekota);

        $this->LoadDatabase();
        $data = array('id_desa' => $kodedesa, 'nm_desa' => $namadesa, 'id_kota' => $kodekota, 'imagedesa' => '');
        $this->db->insert('m_desa', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kodedesa,$namadesa,$kodekota) {
        $this->LoadDatabase();
        $data = array('id_kota' => $kodekota, 'nm_desa' => $namadesa);
        $this->db->where('id_desa',$kodedesa);
        $this->db->update('m_desa', $data);
        $this->CloseDatabase();
    }

    public function DeleteData($kodedesa) {
        $this->LoadDatabase();
        $this->db->where('id_desa',$kodedesa);
        $this->db->delete('m_desa');
        $this->CloseDatabase();
    }

} 
?> 