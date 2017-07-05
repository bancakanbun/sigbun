<?php 
class Pelaporan_model extends CI_Model {

    function __construct() { 
        parent::__construct(); 
    }

    private function LoadDatabase() {
        $this->load->database();
    } 

    private function CloseDatabase() {
        $this->db->close();
    }

    public function DaftarKomoditi() {
        $this->LoadDatabase();
        $query = $this->db->get('m_tanaman');
        $this->CloseDatabase();

        return $query;
    }

    public function Opt() {
        $this->LoadDatabase();

        $this->db->select('id_opt,m_opt.id_tanaman,nm_tanaman,nm_opt,nm_latinopt,persentase_hilang');
        $this->db->from('m_opt');
        $this->db->join('m_tanaman', 'm_opt.id_tanaman = m_tanaman.id_tanaman', 'left');
        $query = $this->db->get();

        $this->CloseDatabase();

        return $query;
    }

    public function LahanPerkebunan() {
        $this->LoadDatabase();

        $this->db->select('id_wilayah,m_wilayah.id_tanaman,nm_tanaman,nm_desa,nm_kota,luasdaerah,to_char(harga,\'999,999,990\') as harga');
        $this->db->from('m_wilayah');
        $this->db->join('m_tanaman', 'm_wilayah.id_tanaman = m_tanaman.id_tanaman', 'left');
        $this->db->join('m_desa', 'm_wilayah.id_desa = m_desa.id_desa', 'left');
        $this->db->join('m_kota', 'm_desa.id_kota = m_kota.id_kota', 'left');
        $query = $this->db->get();

        $this->CloseDatabase();

        return $query;
    }
} 
?> 