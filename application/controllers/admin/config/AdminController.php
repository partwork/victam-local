<?php

class AdminController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('isUserLoggedIn')) {
			if ($this->session->userdata('usertype') == NULL) {
				// echo 'Directory access is forbidden.';
				// exit();
				redirect('register');
			}
		} else {
				redirect('register');
			// echo 'Directory access is forbidden.';
			// exit();
		}
	}
}
