<?php 
class Tanaman_model extends CI_Model {

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
        $query = $this->db->get('m_tanaman');
        $this->CloseDatabase();

        return $query;
    }

    private function GetNewId() {
        $this->LoadDatabase();
        $this->db->select_max('id_tanaman');
        $query = $this->db->get('m_tanaman');
        $this->CloseDatabase();

        $row = $query->row();
        $id = explode("-",$row->id_tanaman);
        return $id[0]."-".str_pad($id[1]+1, 5, "0", STR_PAD_LEFT);
    }

    public function NewData($namatanaman,$produktivitas) {
        $idtanaman = $this->GetNewId();

        $this->LoadDatabase();
        $data = array(  'id_tanaman' => $idtanaman, 'nm_tanaman' => $namatanaman
                        , 'produktivitas' => $produktivitas, 'imagetanaman' => '');
        $this->db->insert('m_tanaman', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($idtanaman,$namatanaman,$produktivitas) {
        $this->LoadDatabase();

        $data = array('nm_tanaman' => $namatanaman, 'produktivitas' => $produktivitas);
        $this->db->where('id_tanaman',$idtanaman);
        $this->db->update('m_tanaman', $data);

        $this->CloseDatabase();
    }

    public function DeleteData($idtanaman) {
        $this->LoadDatabase();

        $this->db->where('id_tanaman',$idtanaman);
        $this->db->delete('m_tanaman');
        $this->CloseDatabase();
    }

} 
?> 