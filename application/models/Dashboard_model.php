<?php 
class Dashboard_model extends CI_Model {

    function __construct() { 
        parent::__construct(); 
    }

    private function LoadDatabase() {
        $this->load->database();
    } 

    private function CloseDatabase() {
        $this->db->close();
    }

    public function DaftarTahun() {
        $this->LoadDatabase();
        $query = $this->db->get('m_tahun');
        $this->CloseDatabase();

        return $query;
    }

    public function DaftarKota() {
        $this->LoadDatabase();
        $query = $this->db->get('m_kota');
        $this->CloseDatabase();

        return $query;
    }

    public function SeranganOpt($tahun) {
        $this->LoadDatabase();

        $sql = "";
        $sql .= "select a.nm_tanaman,a.nm_kota,sum(coalesce(b.luasdaerah,0)) as luasdaerah ";
        $sql .= "from ( select id_tanaman,nm_tanaman,id_kota,nm_kota from m_tanaman,m_kota) a ";
        $sql .= "left join ( ";
        $sql .= "select nm_tahun,m_tanaman.id_tanaman,nm_tanaman,m_kota.id_kota,nm_kota,sum(p_info.luasdaerah) as luasdaerah ";
        $sql .= "from p_info ";
        $sql .= "left join m_tahun on p_info.id_tahun = m_tahun.id_tahun ";
        $sql .= "left join p_dinfo on p_info.idinfo = p_dinfo.idinfo ";
        $sql .= "left join m_opt on p_dinfo.id_opt = m_opt.id_opt ";
        $sql .= "left join m_tanaman on m_opt.id_tanaman = m_tanaman.id_tanaman ";
        $sql .= "left join m_wilayah on p_info.id_wilayah = m_wilayah.id_wilayah ";
        $sql .= "left join m_desa on m_wilayah.id_desa = m_desa.id_desa ";
        $sql .= "left join m_kota on m_desa.id_kota = m_kota.id_kota ";
        $sql .= "where m_kota.id_kota in (select distinct id_kota from m_kota) and nm_tanaman <> '' and nm_tahun='".$tahun."' ";
        $sql .= "group by nm_tahun,m_tanaman.id_tanaman,nm_tanaman,m_kota.id_kota,nm_kota ";
        $sql .= ") b on a.id_kota=b.id_kota and a.id_tanaman=b.id_tanaman ";
        $sql .= "group by a.nm_kota,a.nm_tanaman ";
        $sql .= "order by a.nm_tanaman,a.nm_kota ";

        $query = $this->db->query($sql);

        $this->CloseDatabase();

        return $query;
    }

    public function SeranganOptRugi($tahun) {
        $this->LoadDatabase();

        $sql = "";
        $sql .= "select a.nm_tanaman,a.nm_kota,sum(coalesce(b.total_rugi,0)) as total_rugi ";
        $sql .= "from ( select id_tanaman,nm_tanaman,id_kota,nm_kota from m_tanaman,m_kota) a ";
        $sql .= "left join ( ";
        $sql .= "select nm_tahun,m_tanaman.id_tanaman,nm_tanaman,m_kota.id_kota,nm_kota,sum(p_info.total_rugi) as total_rugi ";
        $sql .= "from p_info ";
        $sql .= "left join m_tahun on p_info.id_tahun = m_tahun.id_tahun ";
        $sql .= "left join p_dinfo on p_info.idinfo = p_dinfo.idinfo ";
        $sql .= "left join m_opt on p_dinfo.id_opt = m_opt.id_opt ";
        $sql .= "left join m_tanaman on m_opt.id_tanaman = m_tanaman.id_tanaman ";
        $sql .= "left join m_wilayah on p_info.id_wilayah = m_wilayah.id_wilayah ";
        $sql .= "left join m_desa on m_wilayah.id_desa = m_desa.id_desa ";
        $sql .= "left join m_kota on m_desa.id_kota = m_kota.id_kota ";
        $sql .= "where m_kota.id_kota in (select distinct id_kota from m_kota) and nm_tanaman <> '' and nm_tahun='".$tahun."' ";
        $sql .= "group by nm_tahun,m_tanaman.id_tanaman,nm_tanaman,m_kota.id_kota,nm_kota ";
        $sql .= ") b on a.id_kota=b.id_kota and a.id_tanaman=b.id_tanaman ";
        $sql .= "group by a.nm_kota,a.nm_tanaman ";
        $sql .= "order by a.nm_tanaman,a.nm_kota ";

        $query = $this->db->query($sql);

        $this->CloseDatabase();

        return $query;
    }
} 
?> 