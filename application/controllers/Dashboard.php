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
	  
			// $data_report = array(
			//   'id_report'        => 'RP-'.date("Y").random_string('numeric', 8),
			//   'user_report'      => $this->session->userdata('name'),
			//   'jenis_report'     => 'report_barang',
			//   'note'             => 'Add Barang '.$id_transaksi. ' (' .$nama_barang. ')' 
			// );
	  
			$this->KerusakanJalan_model->insert('kerusakan_jalan',$data);
			// $this->KerusakanJalan_model->insert('tb_report',$data_report);
	  
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

	//public function tabel_kerusakanjalan()
  //	{
    
    //  $data['list_data'] = $this->KerusakanJalan_model->select('kerusakan_jalan');
    //  $data['nav'] = 100;

      // Load View
     // $this->load->view('component/header');
     // $data['main_header'] = $this->load->view('component/main_header', $data, TRUE);
     // $data['sidebar'] = $this->load->view('component/sidebar', NULL, TRUE);
    // $this->load->view('coba',$data);
     // $this->load->view('component/footer');
  	//}
	####################################
           // End Dashboard
  	####################################
}
