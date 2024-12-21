<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('KerusakanJalan_model');
    }

	private function hash_password($password)
	{
		return password_hash($password,PASSWORD_DEFAULT);
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	
	####################################
           // Dashboard
  	####################################
	public function index()
	{
		$data['nav'] = 1;
		$data['pengaduan_baru'] = $this->KerusakanJalan_model->count('kerusakan_jalan','Diajukan');
		$data['pengaduan_proses'] = $this->KerusakanJalan_model->count('kerusakan_jalan','Diproses');
		$data['pengaduan_selesai'] = $this->KerusakanJalan_model->count('kerusakan_jalan','Selesai');
		$data['pengaduan_ditolak'] = $this->KerusakanJalan_model->count('kerusakan_jalan','Ditolak');
		$data['kerusakan'] = $this->KerusakanJalan_model->getAllKerusakan();
		$this->load->view('home_menu', $data);
	}


	 public function baru()
	 {
		if($this->session->userdata('status') == 'login'){
			$data['list_data'] = $this->KerusakanJalan_model->selecttabel('kerusakan_jalan','Diajukan');
			$data['nav'] = 2;

			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('tabel/tabel_pengaduan_baru', $data);
			$this->load->view('component/footer');
		} else {
			redirect(base_url());
		}
		
	}

	public function form_baru()
  	{
		if($this->session->userdata('status') == 'login'){
		$data['nav'] = 1;

		// Load View
		$this->load->view('component/header');
		$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
		$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
		$this->load->view('form/form_baru(bck)', $data);
		$this->load->view('component/footer');  

		}else {
			$this->load->view('form/form_baru');
		}

  	}

	public function proses_pengaduan_baru(){
		// if($this->session->userdata('status') == 'login'){
			$this->form_validation->set_rules('nama_jalan','Nama Jalan','required');
			$this->form_validation->set_rules('latitude1','Latitude','required');
			$this->form_validation->set_rules('longitude1','Longitude','required');
			$this->form_validation->set_rules('jenis_kerusakan','Jenis Kerusakan','required');
			$this->form_validation->set_rules('tingkat_kerusakan','Tingkat Kerusakan','required');

			if ($this->input->post('latitude2') == 0 && $this->input->post('longitude2') == 0){
				$lat2  = $this->input->post('latitude1');
				$long2 = $this->input->post('longitude2');
			}
	  
		  if($this->form_validation->run() == TRUE)
		  {
			$nama_jalan         = $this->input->post('nama_jalan',TRUE);
			$latitude1          = $this->input->post('latitude1',TRUE);
			$longitude1         = $this->input->post('longitude1',TRUE);
			$latitude2          = $this->input->post('latitude2',TRUE);
			$longitude2         = $this->input->post('longitude2',TRUE);
			$jenis_kerusakan    = $this->input->post('jenis_kerusakan',TRUE);
			$tingkat_kerusakan  = $this->input->post('tingkat_kerusakan',TRUE);

			$latitude2 = $this->input->post('latitude2');
			$longitude2 = $this->input->post('longitude2');

			if (empty($latitude2) || empty($longitude2) || ($latitude2 == 0 && $longitude2 == 0)) {
				$lat2  = $this->input->post('latitude1');
				$long2 = $this->input->post('longitude1');
			} else {
				$lat2  = $latitude2;
				$long2 = $longitude2;
			}

	  
			$data = array(
				  'nama_jalan'         => $nama_jalan,
				  'latitude1'          => $latitude1,
				  'longitude1'         => $longitude1,
				  'latitude2'          => $lat2,
				  'longitude2'         => $long2,
				  'jenis_kerusakan'    => $jenis_kerusakan,
				  'tingkat_kerusakan'  => $tingkat_kerusakan,
				  'kategori'		   => 'Diajukan'
			);
	  
			$data_report = array(
			  'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
			  'user_report'      => $this->session->userdata('name'),
			  'jenis_report'     => 'Pengaduan Baru',
			  'note'             => 'Tambah Kerusakan Jalan '.' (' .$nama_jalan. ')' 
			);
	  
			$this->KerusakanJalan_model->insert('kerusakan_jalan',$data);
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
	  
			$this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
			redirect(base_url('dashboard/baru'));
		  }else {
			$data['nav'] = 1;
      
			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('form/form_baru', $data);
			$this->load->view('component/footer');
		  }
		//   }else {
		// 	$this->load->view('login/login');
		//   }
	}

	public function proses()
	 {
		if($this->session->userdata('status') == 'login'){
	 		$data['nav'] = 3;
			$data['list_data'] = $this->KerusakanJalan_model->selecttabel('kerusakan_jalan','Diproses');
			
	 		// Load View
	 		$this->load->view('component/header');
	 		$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
	 		$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('tabel/tabel_pengaduan_proses', $data);
	 		$this->load->view('component/footer');
		} else {
			redirect(base_url());
		}
	}

	public function selesai()
	 {
		if($this->session->userdata('status') == 'login'){
	 		$data['nav'] = 4;
			$data['list_data'] = $this->KerusakanJalan_model->selecttabel('kerusakan_jalan','Selesai');

	 		// Load View
	 		$this->load->view('component/header');
	 		$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
	 		$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('tabel/tabel_pengaduan_selesai', $data);
	 		$this->load->view('component/footer');
		} else {
			redirect(base_url());
		}
	}

	public function ditolak()
	 {
		if($this->session->userdata('status') == 'login'){
	 		$data['nav'] = 5;
			$data['list_data'] = $this->KerusakanJalan_model->selecttabel('kerusakan_jalan','Ditolak');

	 		// Load View
	 		$this->load->view('component/header');
	 		$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
	 		$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('tabel/tabel_pengaduan_ditolak', $data);
	 		$this->load->view('component/footer');
		} else {
			redirect(base_url());
		}
	}

	public function proses_pengaduan($id){
		if($this->session->userdata('status') == 'login'){
			$where = array('id' => $id);

			$data = array(
				'Kategori'   => "Diproses"
			);	
			
			$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'Proses Pengaduan',
			  	'note'             => 'Proses Pengaduan jalan '.' ('.'ID Jalan = ' .$id. ')' 
			);
			
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
			$this->KerusakanJalan_model->update('kerusakan_jalan',$data,$where);
		
			$this->session->set_flashdata('msg_berhasil','Data Jalan Diproses');
			redirect(base_url('Dashboard/proses'));
		} else {
			redirect(base_url());
		}
	}

	public function selesai_perbaikan($id){
		if($this->session->userdata('status') == 'login'){
			$where = array('id' => $id);

			$data = array(
				'Kategori'   => "Selesai"
			);
		
			$this->KerusakanJalan_model->update('kerusakan_jalan',$data,$where);
			
			$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'Selesao Perbaikan',
				'note'             => 'Selesai Perbaikan jalan '.' ('.'ID Jalan = ' .$id. ')' 
			);
			
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
		
			$this->session->set_flashdata('msg_berhasil','Jalan Selesai Diperbaiki');
			redirect(base_url('Dashboard/selesai'));
		} else {
			redirect(base_url());
		}
	}

	public function tolak($id){
		if($this->session->userdata('status') == 'login'){
			$where = array('id' => $id);

			$data = array(
				'Kategori'   => "Ditolak"
			);
		
			$this->KerusakanJalan_model->update('kerusakan_jalan',$data,$where);
			
			$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'Penolakan Perbaikan',
				'note'             => 'Penolakan Perbaikan jalan '.' ('.'ID Jalan = ' .$id. ')' 
			);
			
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
		
			$this->session->set_flashdata('msg_berhasil','Data Jalan Ditolak');
			redirect(base_url('Dashboard/ditolak'));
		} else {
			redirect(base_url());
		}
	}

	####################################
              // Users
	####################################
	public function users()
	{
		if($this->session->userdata('status') == 'login'){
			$data['list_users'] = $this->KerusakanJalan_model->read('user',$this->session->userdata('name'));
			$this->session->set_userdata($data);
			$data['nav'] = 8;
	
			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('tabel/tabel_user', $data);
			$this->load->view('component/footer');
		}else {
			redirect(base_url());
		} 
	}

	public function form_user()
	{
		if($this->session->userdata('status') == 'login'){
			$data['nav'] = 9;
		
			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('form/form_users',$data);
			$this->load->view('component/footer');
		}else {
			redirect(base_url());
		} 
	}

	public function proses_tambah_user()
	{
		if($this->session->userdata('status') == 'login'){
	
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirm_password','Confirm password','required|matches[password]');
	
		if($this->form_validation->run() == TRUE)
		{	
			$username     = $this->input->post('username',TRUE);
			$email        = $this->input->post('email',TRUE);
			$password     = $this->input->post('password',TRUE);
	
			if($this->KerusakanJalan_model->cek_username('user',$username)){
				$this->session->set_flashdata('msg','Username Telah Digunakan');
				redirect(base_url('Dashboard/form_user'));
		
			}else{
				$data = array(
					'username'   => $username,
					'email' 	 => $email,
					'password'   => $this->hash_password($password)
				);
	
				$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'report_user',
				'note'             => 'Add User'. ' (' .$username. ')' 
				);
				
				$this->KerusakanJalan_model->insert('tb_report',$data_report);
		
				$this->KerusakanJalan_model->insert('user',$data);
		
				$this->session->set_flashdata('msg_terdaftar','User Berhasil Ditambahkan');
				redirect(base_url('Dashboard/users'));
			}
			}else {
			$data['nav'] = 9;
	
			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('form/form_users', $data);
			$this->load->view('component/footer');   
		}
		}else {
			redirect(base_url());
		} 
	}

	public function edit_user()
	{
		if($this->session->userdata('status') == 'login'){
		
			$id = $this->uri->segment(3);
			$where = array('id' => $id);
			$data['list_data'] = $this->KerusakanJalan_model->get_data('user',$where);
			$data['nav'] = 6;
		
			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('form/form_users',$data);
			$this->load->view('component/footer');
		}else {
			redirect(base_url());
		}
	}

	public function proses_update_user()
	{
		if($this->session->userdata('status') == 'login'){
		
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
	
		
		if($this->form_validation->run() == TRUE)
		{
			
			$id           = $this->input->post('id',TRUE);        
			$username     = $this->input->post('username',TRUE);
			$email        = $this->input->post('email',TRUE);
	
			$where = array('id' => $id);
			$data = array(
					'username'     => $username,
					'email'        => $email,
			);
	
			$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'report_user',
				'note'             => 'Update User'. ' (' .$username. ')' 
			);
			
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
	
			$this->KerusakanJalan_model->update('user',$data,$where);
			$this->session->set_flashdata('msg_berhasil','Data User Berhasil Diupdate');
			redirect(base_url('Dashboard/users'));
			
		}else{
			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('form/form_users',$data);
			$this->load->view('component/footer');
		}
		}else {
			redirect(base_url());
		}
	}

	public function proses_delete_user()
	{
		if($this->session->userdata('status') == 'login'){
	
			$username = $this->uri->segment(3);
		
			$where = array('username' => $username);
		
			$this->KerusakanJalan_model->delete('user',$where);
			
			$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'report_user',
				'note'             => 'Delete User'. ' (' .$username. ')' 
			);
			
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
		
			$this->session->set_flashdata('msg_berhasil','Data User Behasil Dihapus');
			redirect(base_url('Dashboard/users'));
		}else {
			redirect(base_url());
		}
	}

	public function proses_reset_user()
	{
		if($this->session->userdata('status') == 'login'){

			$reset = $this->uri->segment(3);
		
			$data = array(
				'password' => $this->hash_password($reset)
			);
		
			$where = array(
				'username' =>$reset
			);
		
			$data_report = array(
				'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
				'user_report'      => $this->session->userdata('name'),
				'jenis_report'     => 'report_user',
				'note'             => 'Reset Password User'. ' (' .$reset. ')' 
			);
			
			$this->KerusakanJalan_model->insert('tb_report',$data_report);
		
			$this->KerusakanJalan_model->update_password('user',$where,$data);
		
			$this->session->set_flashdata('msg_berhasil','Password Telah Direset');
			redirect(base_url('Dashboard/users'));
		}else {
			redirect(base_url());
		}
	}

	####################################
           // End User
  	####################################

	####################################
           // Profile
  	####################################

	public function profile()
	{
		if($this->session->userdata('status') == 'login'){
			$data['nav'] = 7;

			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('profile',$data);
			$this->load->view('component/footer');
		}else {
			redirect(base_url());
		}  
	}

	public function proses_new_password()
	{
		if($this->session->userdata('status') == 'login'){
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('new_password','New Password','required');
		$this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|matches[new_password]');

		if($this->form_validation->run() == TRUE)
		{
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$new_password = $this->input->post('new_password');

			$data = array(
				'email'    => $email,
				'password' => $this->hash_password($new_password)
			);

			$where = array(
				'id' =>$this->session->userdata('id')
			);

			$data_report = array(
			'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
			'user_report'      => $this->session->userdata('name'),
			'jenis_report'     => 'report_user',
			'note'             => 'Change Profile User '.$this->session->userdata('name')
			);

			$this->KerusakanJalan_model->insert('tb_report',$data_report);

			$this->KerusakanJalan_model->update_password('user',$where,$data);

			$this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
			redirect(base_url('Dashboard/profile'));
		
		}else {
			// Load View
			$data['nav'] = 7;

			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('profile',$data);
			$this->load->view('component/footer');
		}
		}else {
			redirect(base_url());
		} 
	}

	public function proses_gambar_upload()
	{
		if($this->session->userdata('status') == 'login'){
			$config =  array(
				'upload_path'     => "./upload/user/img/",
				'allowed_types'   => "gif|jpg|png|jpeg",
				'max_size'        => "50000",  // ukuran file gambar
				'max_height'      => "9680",
				'max_width'       => "9024"
			);
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if( ! $this->upload->do_upload('userpicture'))
			{
				$this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
				$this->load->view('profile',$data);

			}else{
				$upload_data = $this->upload->data();
				$nama_file = $upload_data['file_name'];
				$ukuran_file = $upload_data['file_size'];

				//resize img + thumb Img -- Optional
				$config['image_library']     = 'gd2';
				$config['source_image']      = $upload_data['full_path'];
				$config['create_thumb']      = FALSE;
				$config['maintain_ratio']    = TRUE;
				$config['width']             = 150;
				$config['height']            = 150;

				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);

				if($this->session->userdata('photo') !== 'nopic.png'){
					unlink('./upload/user/img/' . $this->session->userdata('photo'));
				}
				

			$where = array(
				'username' => $this->session->userdata('name')
			);

			$data_report = array(
			'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
			'user_report'      => $this->session->userdata('name'),
			'jenis_report'     => 'report_user',
			'note'             => 'Change Photo User '.$this->session->userdata('name')
			);

			$data = array(
			'photo' => $nama_file
			);

			$this->session->set_userdata('photo', $this->upload->data('file_name'));
			$this->KerusakanJalan_model->update('user',$data,$where);

			$this->KerusakanJalan_model->insert('tb_report',$data_report);

			$this->session->set_flashdata('msg_berhasil_gambar','Gambar Berhasil Di Upload');
			redirect(base_url('Dashboard/profile'));
		}
		}else {
			redirect(base_url());
		} 
	}

	####################################
           // End Profile
  	####################################

	####################################
           // End Dashboard
  	####################################

	public function report()
	{
		if($this->session->userdata('status') == 'login'){
			
			$data['list_data'] = $this->KerusakanJalan_model->select('tb_report');
			$data['nav'] = 6;

			// Load View
			$this->load->view('component/header');
			$data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
			$data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
			$this->load->view('tabel/report',$data);
			$this->load->view('component/footer');
		}else {
			redirect(base_url());
		}
	}

	####################################
           // End Report
  	####################################

}
