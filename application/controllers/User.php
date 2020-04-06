<?php

class User extends CI_Controller{

	function __construct(){		
		parent::__construct();

	$this->load->model(array('Admin_model'));
    $this->load->library(array('form_validation','upload','image_lib','template','session'));
    $this->load->helper(array('form', 'url', 'html'));
	}

	//load form login
	function index(){
		if($this->session->userdata('id_user')){ // utk cek apakah session masih aktif / tidak
            $username      = $this->session->userdata('id_user'); // mengambil username dari session
            $cek_siswa     = $this->User_model->cek_sesion_siswa($username); // cek status = siswa
            $cek_kepsek     = $this->User_model->cek_sesion_kepsek($username); // cek status = guru
            $cek_admin     = $this->User_model->cek_sesion_admin($username); // cek status = admin

			if($cek_siswa->num_rows()>0){
                //jika status = siswa >> lanjut ke beranda untuk siswa
						redirect('spp_siswa');
            }
            else if($cek_admin->num_rows()>0){
                redirect('welcome');
            }
            else if($cek_kepsek->num_rows()>0){
                redirect('spp_kepsek');
            }else{
            	$this->logout();
            }
        }
        else{
            $this->load->view('user/login');
        }
	}

	public function login(){
		$this->load->library('form_validation'); // mengaktifkan form validation dari library
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Username dan password harus di isi');
            // redirect('user');
        }else{
			
			$username  = $this->input->post('username');
			$password  = $this->input->post('password');
			$where = array(
				'username' => $username,
				'password' => ($password),
				);
			$cek= $this->Admin_model->cek_login($where)->row();
			print_r($cek);
            if(isset($cek)){
				$data_session = array(
					'id' => $cek->id,
					'logged_in' => true,
					'jabatan'	=>$cek->bagian,
					);
				$this->session->set_userdata($data_session);
				redirect(base_url("welcome"));
			}elseif(!$cek2==null){
				$data_session = array(
					'id' => $cek2->id_camaba,
					'nama' => $cek2->nama_camaba,
					'logged_in' => true,
					'jabatan'	=>'siswa',
					);
				$this->session->set_userdata($data_session);
				redirect(base_url("camaba/welcome"));
			}else{
				$this->session->set_flashdata('message', 'Login Gagal');
				redirect(site_url('user'));
				  
			}
        }

	}

	//cek password dan username
	function proses_login(){
		$session_login=$this->session->userdata('logged_in');
		if($session_login==true){
			redirect('welcome');
		}

		//menangkap input
		$username=$this->input->post('username','true');
		$password=$this->input->post('password','true');

		//pencarian data di databasr
		$temp_account=$this->User_model->check_user_account($username,$password)->row();

		//cek jumlah data dari hasil pencarian
		$num_account=count($temp_account);

		//validation
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()==FALSE){
			$this->load->view('user/login');
		}
		else{
			if($num_account>0){

				$session_nik=$this->session->userdata('id_user');

				$array_items=array(
					'id_user'			=> $temp_account->id_user,
					'username'		=> $temp_account->username,
					'nama_jabatan'	=> $temp_account->jabatan,
					'nama_user'	=> $temp_account->nama_user,
					'image'			=> $temp_account->image,
					'logged_in'		=> true,
				);
        			$this->session->set_userdata($array_items);
					redirect(site_url('welcome'));
			}
			else{
				$this->session->set_flashdata('notification','Username dan Password Salah');
				redirect(site_url('user'));
			}
		}
	}

	//logout
	function logout(){
		$this->session->sess_destroy();
		redirect(site_url('user'));
	}
}
?>
