<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Gaji extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Setoran_model','Simpanan_model','Gaji_model','Sadur_model','SimpanPinjam_model','ModelAnggota','Pakan_model','ModelToko','Sp_model','Keswan_model','Harga_model'));
        $this->load->library(array('form_validation','upload','image_lib','template','session','format_in'));
        $this->load->helper(array('form', 'url', 'html'));
        if(empty($this->session->userdata('id_user'))){
            redirect('user');
        }
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
        'action' => site_url('gaji/gaji_peternak_action'),
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

    function gaji_peternak_action(){
        if ($_POST['id_anggota'] ==! null) {
        $id_anggota = $this->input->post('id_anggota');
        $setoran= $this->input->post('setoran');
        $simpanan_wajib = $this->input->post('simpanan_wajib');
        $simpanan_sukarela     = $this->input->post('simpanan_sukarela');
        $kesehatan_hewan = $this->input->post('keswan');
        $dana_desa    = $this->input->post('dana_desa');
        $konsentrat   = $this->input->post('konsentrat');
        $simpan_pinjam = $this->input->post('sp');
        $utang_toko = $this->input->post('toko');
        $pot_lain=$this->input->post('pot_lain');
        
        echo $bulan=date('m')-1;
        $gaji=array(
            'id_anggota' => $id_anggota,
            'setoran'   => $setoran,
            'sim_wajib' =>$simpanan_wajib,
            'sim_sukarela' => $simpanan_sukarela,
            'keswan'    => $kesehatan_hewan,
            'dana_desa' => $dana_desa,
            'pakan' => $konsentrat,
            'sp' =>$simpan_pinjam,
            'toko'  => $utang_toko,
            'pot_lain' => $pot_lain,
            'bulan' => date('Y-'.$bulan.'-d'),
        );
        
        $sim_wajib=array(
            'id_anggota' => $id_anggota,
            'nominal'   =>$simpanan_wajib,
            'jenis'     => '1',
            'tgl'       => date('Y-m-d'),
            'ket'       => 'D',
        );
        $sim_sukarela=array(
            'id_anggota' => $id_anggota,
            'nominal'   =>$simpanan_sukarela,
            'jenis'     => '2',
            'tgl'       => date('Y-m-d'),
            'ket'       => 'D',
        );
        $keswan=array(
            'id_anggota' => $id_anggota,
            'nominal'   => $kesehatan_hewan,
            'tgl'   => date('Y-m-d'),
            'jenis' => 'D'
        );
        $pakan=array(
            'id_anggota' => $id_anggota,
            'nominal_byr' => $konsentrat,
            'tgl_byr_pkn' =>  date('Y-m-d'),
        );
        $sp=array(
            'id_anggota'    => $id_anggota,
            'nominal'       => $simpan_pinjam,
            'tgl'           => date('Y-m-d'),
        );
        $toko=array(
            'id_anggota' => $id_anggota,
            'jml_tagihan' => $utang_toko,
            'tgl'       => date('Y-m-d'),
            'jenis'     => 'D',
        );
        $this->Gaji_model->insert($gaji);
        $this->Simpanan_model->insert_simpanan($sim_wajib);
        $this->Simpanan_model->insert_simpanan($sim_sukarela);
        $this->Keswan_model->insert($keswan);
        $this->Pakan_model->insert_bayar($pakan);
        $this->SimpanPinjam_model->insert($sp);
        $this->ModelToko->save($toko);

        $this->session->set_flashdata('mesage','Simpan Data Berhasil');
        redirect(site_url('gaji'));    
        }
    }
}
?>