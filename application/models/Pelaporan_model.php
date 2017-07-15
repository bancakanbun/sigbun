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
        $this->db->where("nm_tanaman <> ''");
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function LahanPerkebunan() {
        $this->LoadDatabase();
        $this->db->select('id_wilayah,m_wilayah.id_tanaman,nm_tanaman,nm_desa,nm_kota,luasdaerah,harga');
        $this->db->from('m_wilayah');
        $this->db->join('m_tanaman', 'm_wilayah.id_tanaman = m_tanaman.id_tanaman', 'left');
        $this->db->join('m_desa', 'm_wilayah.id_desa = m_desa.id_desa', 'left');
        $this->db->join('m_kota', 'm_desa.id_kota = m_kota.id_kota', 'left');
        $this->db->where("m_kota.id_kota in (select distinct id_kota from m_kota) and nm_tanaman <> ''");
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function RekapPengamatanOpt() {
        $this->LoadDatabase();
        $this->db->select('p_info.idinfo,cast(tanggal as date) as tanggal,nm_tahun,triwulan,nm_kota,nm_desa,nm_tanaman,nm_opt,p_info.hargapanen,p_info.luasdaerah,total_rugi');
        $this->db->from(' p_info');
        $this->db->join('m_tahun', 'p_info.id_tahun = m_tahun.id_tahun', 'left');
        $this->db->join('m_wilayah', 'p_info.id_wilayah = m_wilayah.id_wilayah', 'left');
        $this->db->join('m_desa', 'm_wilayah.id_desa = m_desa.id_desa', 'left');
        $this->db->join('m_kota', 'm_desa.id_kota = m_kota.id_kota', 'left');
        $this->db->join('p_dinfo', 'p_info.idinfo = p_dinfo.idinfo', 'left');
        $this->db->join('m_opt', 'p_dinfo.id_opt = m_opt.id_opt', 'left');
        $this->db->join('m_tanaman', 'm_opt.id_tanaman = m_tanaman.id_tanaman', 'left');
        $this->db->where("m_kota.id_kota in (select distinct id_kota from m_kota) and nm_tanaman <> ''");
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

} 
?> 