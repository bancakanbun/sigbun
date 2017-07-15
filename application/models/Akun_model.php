<?php 
class Akun_model extends CI_Model {

    function __construct() { 
        parent::__construct(); 
    }

    private function LoadDatabase() {
        $this->load->database();
    } 

    private function CloseDatabase() {
        $this->db->close();
    }

    public function EncryptPassword($xpass) {
        $strutf8 = utf8_encode($xpass);
        $strhash2 = hash('sha1',$strutf8,true);
        return base64_encode($strhash2);
    }

    public function LoadAll() {
        $this->LoadDatabase();
        $this->db->select('id,name,username,Pass,type,m_user.id_kota,nm_kota');
        $this->db->from('m_user');
        $this->db->join('m_kota', 'm_user.id_kota = m_kota.id_kota', 'left');
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function NewData($nama,$username,$password,$level,$kodekota) {
        $this->LoadDatabase();
        $data = array('name' => $nama, 'username' => $username, '"Pass"' => $this->EncryptPassword($password)
                    , 'type' => $level, 'id_kota' => $kodekota);
        $this->db->insert('m_user', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kode,$nama,$username,$level,$kodekota) {
        $this->LoadDatabase();
        $data = array('name' => $nama, 'username' => $username, 'type' => $level, 'id_kota' => $kodekota);
        $this->db->where('id',$kode);
        $this->db->update('m_user', $data);
        $this->CloseDatabase();
    }

    public function DeleteData($kode) {
        $this->LoadDatabase();
        $this->db->where('id',$kode);
        $this->db->delete('m_user');
        $this->CloseDatabase();
    }

} 
?> 