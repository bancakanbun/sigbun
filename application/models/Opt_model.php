<?php 
class Opt_model extends CI_Model {

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
        $this->db->select('id_opt,m_opt.id_tanaman,nm_tanaman,nm_opt,nm_latinopt,persentase_hilang');
        $this->db->from('m_opt');
        $this->db->join('m_tanaman', 'm_opt.id_tanaman = m_tanaman.id_tanaman', 'left');
        $this->db->where("nm_tanaman <> ''");
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    private function GetNewId() {
        $this->LoadDatabase();
        $this->db->select_max('id_opt');
        $query = $this->db->get('m_opt');
        $this->CloseDatabase();

        $row = $query->row();
        $id = explode("-",$row->id_opt);
        return $id[0]."-".str_pad($id[1]+1, 5, "0", STR_PAD_LEFT);
    }

    public function NewData($namaopt,$namalatin,$persentase,$idtanaman) {
        $kodeopt = $this->GetNewId();

        $this->LoadDatabase();

        $data = array('id_opt' => $kodeopt, 'id_tanaman' => $idtanaman
                        , 'nm_opt' => $namaopt, 'nm_latinopt' => $namalatin, 'persentase_hilang' => $persentase);
        $this->db->insert('m_opt', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kodeopt,$namaopt,$namalatin,$persentase,$idtanaman) {
        $this->LoadDatabase();

        $data = array('id_tanaman' => $idtanaman, 'nm_opt' => $namaopt
                    , 'nm_latinopt' => $namalatin, 'persentase_hilang' => $persentase);
        $this->db->where('id_opt',$kodeopt);
        $this->db->update('m_opt', $data);

        $this->CloseDatabase();
    }

    public function DeleteData($kodeopt) {
        $this->LoadDatabase();

        $this->db->where('id_opt',$kodeopt);
        $this->db->delete('m_opt');
        $this->CloseDatabase();
    }

} 
?> 