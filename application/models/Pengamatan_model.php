<?php 
class Pengamatan_model extends CI_Model {

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
        $strfield = "";
        $strfield .= "p_info.idinfo,cast(tanggal as date) as tanggal,nm_tahun,triwulan,nm_kota,nm_desa";
        $strfield .= ",nm_tanaman,nm_opt,p_info.hargapanen,p_info.luasdaerah,total_rugi";
        $strfield .= ",Ringan,Sedang,Berat";
        $this->LoadDatabase();
        $this->db->select($strfield);
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

    public function Load($id) {
        $strfield = "";
        $strfield .= "idinfo,id_tahun,triwulan,hargapanen";
        $strfield .= ",p_info.luasdaerah,total_rugi,awal,akhir,tanggal";
        $strfield .= ",p_info.id_wilayah,m_wilayah.id_desa,id_kota,m_wilayah.id_tanaman";

        $this->LoadDatabase();
        $this->db->select($strfield);
        $this->db->from('p_info');
        $this->db->join('m_wilayah', 'p_info.id_wilayah = m_wilayah.id_wilayah', 'left');
        $this->db->join('m_desa', 'm_wilayah.id_desa = m_desa.id_desa', 'left');
        $this->db->where("idinfo",$id);
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function LoadDetail($id) {
        $strfield = "";
        $strfield .= "iddetailinfo,p_dinfo.id_opt,nm_opt,persentaseserang,APBN,APBD1,APBD2,Masyarkat";
        $strfield .= ",Ringan,Sedang,Berat,p_info.hargapanen,RugiHasil,ProdukHasil,CaraKendali,iddetailinfo";

        $this->LoadDatabase();
        $this->db->select($strfield);
        $this->db->from('p_dinfo');
        $this->db->join('m_opt', 'p_dinfo.id_opt = m_opt.id_opt', 'left');
        $this->db->join('p_info', 'p_dinfo.idinfo = p_info.idinfo', 'left');
        $this->db->where("p_dinfo.idinfo",$id);
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function SavePengamatan($info) { 
        $this->LoadDatabase();
        $data = array(  'idinfo' => $info->id, 'tanggal' => $info->tanggal
                        , 'id_wilayah' => $info->wilayah, 'id_tahun' => $info->tahun
                        , 'triwulan' => $info->triwulan, 'hargapanen' => $info->hargapanen
                        , 'luasdaerah' => $info->luaslahan, 'total_rugi' => $info->totalrugi
                        , 'id' => "1", 'awal' => $info->awal, 'akhir' => $info->akhir);
        $this->db->insert('p_info', $data);
        $this->CloseDatabase();
    }

    public function SavePengamatanDetail($detail) {
        $this->LoadDatabase();
        $data = array(  'iddetailinfo' => $detail->id, 'id_opt' => $detail->organisme, 'idinfo' => $detail->kode
                        , 'APBN' => $detail->apbn, 'APBD1' => $detail->apbd1, 'APBD2' => $detail->apbd2
                        , 'Masyarkat' => $detail->masyarakat, 'Ringan' => $detail->ringan, 'Sedang' => $detail->sedang
                        , 'Berat' => $detail->berat, 'HilangProduksi' => $detail->hilangproduksi, 'hargapanen' => $detail->hargapanen
                        , 'persentaseserang' => $detail->persentaseserang, 'RugiHasil' => $detail->rugihasil
                        , 'ProdukHasil' => $detail->produkhasil, 'CaraKendali' => $detail->carakendali);
        $this->db->insert('p_dinfo', $data);
        $this->CloseDatabase();
    }

    public function DeletePengamatan($id) {
        $this->LoadDatabase();
        $this->db->where('idinfo',$id);
        $this->db->delete('p_info');
        $this->CloseDatabase();
    }

    public function DeletePengamatanDetail($id) {
        $this->LoadDatabase();
        $this->db->where('idinfo',$id);
        $this->db->delete('p_dinfo');
        $this->CloseDatabase();
    }
} 
?> 