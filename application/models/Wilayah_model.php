<?php 
class Wilayah_model extends CI_Model {

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
        $fields = 'id_wilayah,m_wilayah.id_tanaman,m_wilayah.id_desa,m_desa.id_kota';
        $fields .= ',nm_tanaman,nm_desa,nm_kota,luasdaerah,harga';

        $this->LoadDatabase();
        $this->db->select($fields);
        $this->db->from('m_wilayah');
        $this->db->join('m_tanaman', 'm_wilayah.id_tanaman = m_tanaman.id_tanaman', 'left');
        $this->db->join('m_desa', 'm_wilayah.id_desa = m_desa.id_desa', 'left');
        $this->db->join('m_kota', 'm_desa.id_kota = m_kota.id_kota', 'left');
        $this->db->where("m_kota.id_kota in (select distinct id_kota from m_kota) and nm_tanaman <> ''");
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    private function GetNewId($kodedesa) {
        $this->LoadDatabase();
        $this->db->select_max('id_wilayah');
        $this->db->where('id_desa',$kodedesa);
        $query = $this->db->get('m_wilayah');
        $this->CloseDatabase();

        $row = $query->row();
        $id = explode($kodedesa,$row->id_wilayah);
        return $id[0].$kodedesa.str_pad($id[1]+1, 2, "0", STR_PAD_LEFT);;
    }

    public function NewData($kodedesa,$kodetanaman,$luas,$harga) {
        $kodewilayah = $this->GetNewId($kodedesa);

        $this->LoadDatabase();

        $data = array('id_wilayah' => $kodewilayah, 'id_desa' => $kodedesa, 'id_tanaman' => $kodetanaman
                    , 'luasdaerah' => $luas, 'harga' => $harga);
        $this->db->insert('m_wilayah', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kodewilayah,$kodedesa,$kodetanaman,$luas,$harga) {
        $this->LoadDatabase();

        $data = array('id_desa' => $kodedesa, 'id_tanaman' => $kodetanaman, 'luasdaerah' => $luas, 'harga' => $harga);
        $this->db->where('id_wilayah',$kodewilayah);
        $this->db->update('m_wilayah', $data);

        $this->CloseDatabase();
    }

    public function DeleteData($kodewilayah) {
        $this->LoadDatabase();

        $this->db->where('id_wilayah',$kodewilayah);
        $this->db->delete('m_wilayah');
        $this->CloseDatabase();
    }

} 
?> 