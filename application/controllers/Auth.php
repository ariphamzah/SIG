<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
	}

    ####################################
           // Login
  	####################################
	public function login()
	{
		$this->load->view('login');
	}

	public function proses_login(){
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == TRUE){
			$username = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);

		
			$cek =  $this->M_login->cek_user('user',$username);
			if( $cek->num_rows() != 1){
				$this->session->set_flashdata('msg','Username Belum Terdaftar Silahkan Register Dahulu');
				redirect(base_url('Auth/login'));
			}else {

				$isi = $cek->row();
				if(password_verify($password,$isi->password) === TRUE){
					$data_session = array(
									'id' => $isi->id,
									'name' => $username,
									'email' => $isi->email,
									'status' => 'login',
									'role' => $isi->role,
									'photo' => $isi->photo,
									'last_login' => $isi->last_login
					);

					$this->session->set_userdata($data_session);

					$this->M_login->edit_user(['username' => $username],['last_login' => date('d-m-Y G:i')]);

						if($isi->role == 1){
							redirect(base_url('Dashboard'));
						}else {
							redirect(base_url('Dashboard'));
						}

				}else {
					$this->session->set_flashdata('msg','Username Dan Password Salah');
					redirect(base_url('Auth/login'));
				}
			}
		}	
	}

	####################################
           // End Login
  	####################################

	####################################
           // Logout
  	####################################
	public function sigout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	####################################
           // End Logout
  	####################################

	
	####################################
           // Profile
  	####################################
	public function profile()
	{
        $data['nav'] = 2;
        $data['header'] = $this->load->view('templates/header', $data, TRUE);

		$this->load->view('home_menu', $data);
	}

	####################################
           // End Profile
  	####################################
}