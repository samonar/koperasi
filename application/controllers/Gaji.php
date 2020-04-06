<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Gaji extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Setoran_model','Pos_model','Sadur_model','SimpanPinjam_model','ModelAnggota','Pakan_model','ModelToko','Sp_model','Keswan_model','Harga_model'));
        $this->load->library(array('form_validation','upload','image_lib','template','session','format_in'));
        $this->load->helper(array('form', 'url', 'html'));
    }

    function index(){
        $data_anggota=$this->SimpanPinjam_model->get_all_peternak()->result();
       $data=array(
        'title' => 'Gaji Peternak',
        'active_header' => 'gaji',
        'active'    => '-',
        'data_anggota'  =>$data_anggota,
       );
       $this->template->display('gaji/anggota_list',$data);
    }

    function gaji_peternak($id_anggota){
        $identitas=$this->ModelAnggota->get_by_id($id_anggota)->row();
        $data_setoran=$this->Setoran_model->get_Setoran_byId($id_anggota)->result();
        $data_pakanPakai= $this->Pakan_model->pakan_bulanan($id_anggota)->result();
        $data_pakanBayar=$this->Pakan_model->pakan_bayar($id_anggota)->result();
        $data_toko=$this->ModelToko->get_utangToko_byId($id_anggota)->result();
        $data_angsuran=$this->Sp_model->get_sp_byId($id_anggota)->result();
        $data_bayar=$this->SimpanPinjam_model->get_bayar_byId($id_anggota)->result();
        $data_keswan=$this->Keswan_model->get_Keswan_byId($id_anggota)->result();
        $data_hargaAktif=$this->Harga_model->harga_aktif('susu')->row();
        $data=array(
        'title' => 'Gaji Peternak',
        'active_header' => 'gaji',
        'active'        => '-',
        'identitas'     => $identitas,
        'data_setoran'  => $data_setoran,
        'data_pakanPakai' => $data_pakanPakai,
        'data_pakanBayar' => $data_pakanBayar,
        'data_toko'     => $data_toko,
        'data_angsuran' => $data_angsuran,
        'data_bayar'    => $data_bayar,
        'data_keswan'   => $data_keswan,
        'data_hargaAktif' => $data_hargaAktif,
        );
        $this->template->display('gaji/tampilan_gajian',$data);
    } 

    function gaji_peternak_actio(){
        if ($_GET ==! null) {
            echo "masuk";
        }
    }
}
?>