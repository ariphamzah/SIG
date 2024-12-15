<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    ####################################
           // Login
  	####################################
	public function login()
	{
        $data['nav'] = 0;
		$this->load->view('home_menu', $data);
	}

	####################################
           // End Login
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