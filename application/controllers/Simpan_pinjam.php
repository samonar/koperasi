<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpan_pinjam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Setoran_model','Pos_model','Sadur_model','SimpanPinjam_model','ModelAnggota','Pakan_model','Sp_model'));
        $this->load->library(array('form_validation','upload','image_lib','template','session'));
        $this->load->helper(array('form', 'url', 'html'));
    }

    function index(){
        $data_anggota=$this->SimpanPinjam_model->get_all_peternak()->result();
        $data=array(
            'title' => 'Simpan Pinjam Peternak',
            'active_header' =>'sp',
            'active'        =>'',
            'show'          => 'histori',
            'jn_form'       => 'form_pinjaman',
            'data_anggota'  =>$data_anggota,
        );
        $this->template->display('simpan_pinjam/anggota_list',$data);
    }

    //fungsi angsuran sp bulanan
    function angsuran($id_anggota){
        $identitas=$this->ModelAnggota->get_by_id($id_anggota)->row();
        $data_angsuran=$this->Sp_model->get_sp_byId($id_anggota)->result();
        $data_bayar=$this->SimpanPinjam_model->get_bayar_byId($id_anggota)->result();
        $data=array(
            'title' => 'Pinjaman Peternak',
            'active_header' =>'sp',
            'active'        =>'',
            'show'          => 'bayar',
            'jn_form'       => 'form_pinjaman',
            'action'        => site_url('simpan_pinjam/pinjam_action'),
            'identitas'     => $identitas,
            'data_angsuran' => $data_angsuran,
            'data_bayar'    => $data_bayar,
        );
        $this->template->display('simpan_pinjam/sp_form',$data);
    }

    function bayar_action(){
        $harga_aktif=$this->Pakan_model->harga_aktif('susu')->row();
        if(isset($_POST)){
            $data=array(
            'id_anggota'    => $this->input->post('id_anggota'),
            'angsuran'      => $this->input->post('angsuran'),
            'nominal'       => $this->input->post('nominal'),
            'tgl'           => date('Y-m-d'),
            );
            $this->Sp_model->save($data);
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam/pinjam/".$data['id_anggota']));
        }else {
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam"));
        }
    }

    function edit_angsuran($id){
        $data_ssp=$this->Sp_model->getOne_angsuran($id);
        $identitas=$this->ModelAnggota->get_by_id($data_ssp->id_anggota)->row();
        $data_angsuran=$this->Sp_model->get_sp_byId($data_ssp->id_anggota)->result();
        $data_bayar=$this->SimpanPinjam_model->get_bayar_byId($data_ssp->id_anggota)->result();
        $data=array(
            'title' => 'Pinjaman Peternak',
            'active_header' =>'sp',
            'active'        =>'',
            'show'          => 'pinjam',
            'jn_form'       => 'form_angsuran',
            'action'        => site_url('simpan_pinjam/editAngsuran_action'),
            'id_sp'         => $id,
            'id_anggota'    => $data_ssp->id_anggota,
            'nominal'       => $data_ssp->nominal,
            'data_angsuran' => $data_angsuran,
            'data_bayar'    => $data_bayar,
            'identitas'     => $identitas,
        );
        $this->template->display('simpan_pinjam/sp_form',$data);
    }

    function editAngsuran_action(){
        if(isset($_POST)){
            $data=array(
            'id_ssp'         => $this->input->post('id_ssp'),
            'id_anggota'    => $this->input->post('id_anggota'),
            'nominal'       => $this->input->post('nominal'),
            );
            $this->SimpanPinjam_model->update($data);
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam/angsuran/".$data['id_anggota']));
        }else {
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam"));
        }
    }

    function delete_angsuran($data,$id){
		
		if (!null==$data) {
			$row=$this->SimpanPinjam_model->delete($data);
            $this->session->set_flashdata('message', 'Hapus Data Berhasil');
            redirect(site_url('simpan_pinjam/angsuran/'.$id));
        } else {
            $this->session->set_flashdata('message', 'Record User Found');
            redirect(site_url('user'));
        }
	}

    // pinjaman peternak
    function pinjam($id_anggota){
        $identitas=$this->ModelAnggota->get_by_id($id_anggota)->row();
        $data_angsuran=$this->Sp_model->get_sp_byId($id_anggota)->result();
        $data_bayar=$this->SimpanPinjam_model->get_bayar_byId($id_anggota)->result();
        $data=array(
            'title' => 'Pinjaman Peternak',
            'active_header' =>'sp',
            'active'        =>'',
            'show'          => 'histori',
            'jn_form'       => 'form_pinjaman',
            'action'        => site_url('simpan_pinjam/pinjam_action'),
            'identitas'     => $identitas,
            'data_angsuran' => $data_angsuran,
            'data_bayar'    => $data_bayar,
        );
        $this->template->display('simpan_pinjam/sp_form',$data);
    }

    function pinjam_action(){
        $harga_aktif=$this->Pakan_model->harga_aktif('susu')->row();
        if(isset($_POST)){
            $data=array(
            'id_anggota'    => $this->input->post('id_anggota'),
            'angsuran'      => $this->input->post('angsuran'),
            'nominal'       => $this->input->post('nominal'),
            'tgl'           => date('Y-m-d'),
            );
            $this->Sp_model->save($data);
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam/pinjam/".$data['id_anggota']));
        }else {
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam"));
        }
    }

    function edit_pinjam($id){
        $data_sp=$this->Sp_model->getOne($id);
        $identitas=$this->ModelAnggota->get_by_id($data_sp->id_anggota)->row();
        $data_angsuran=$this->Sp_model->get_sp_byId($data_sp->id_anggota)->result();
        $data_bayar=$this->SimpanPinjam_model->get_bayar_byId($data_sp->id_anggota)->result();
        $data=array(
            'title' => 'Pinjaman Peternak',
            'active_header' =>'sp',
            'active'        =>'',
            'show'          =>'pinjam',
            'action'        => site_url('simpan_pinjam/editPinjam_action'),
            'id_sp'         => $id,
            'id_anggota'    => $data_sp->id_anggota,
            'angsuran'      => $data_sp->angsuran,
            'nominal'       => $data_sp->nominal,
            'data_angsuran' => $data_angsuran,
            'data_bayar'    => $data_bayar,
            'identitas'     => $identitas,
        );
        $this->template->display('simpan_pinjam/sp_form',$data);
    }

    function editPinjam_action(){
        if(isset($_POST)){
            $data=array(
            'id_sp'         => $this->input->post('id_sp'),
            'id_anggota'    => $this->input->post('id_anggota'),
            'angsuran'      => $this->input->post('angsuran'),
            'nominal'       => $this->input->post('nominal'),
            );
            $this->Sp_model->update($data);
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam/pinjam/".$data['id_anggota']));
        }else {
            $this->session->set_flashdata('message','Pencatatan Berhasil');
            redirect(site_url("simpan_pinjam"));
        }
    }

    function delete_pinjam($data,$id){
		
		if (!null==$data) {
			$row=$this->Sp_model->delete($data);
            $this->session->set_flashdata('message', 'Hapus Data Berhasil');
            redirect(site_url('simpan_pinjam/pinjam/'.$id));
        } else {
            $this->session->set_flashdata('message', 'Record User Found');
            redirect(site_url('user'));
        }
	}
}
?>