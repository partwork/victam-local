<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdvertiseController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();       
    }
	
	public function index(){
        try {
            $this->load_advertise_view();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_advertise_view(){
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
        $data['activePage'] = "home";
        $this->load->view('css_js_helpers');
        $this->load->view('advertise/a_css_js_helpers');
        $this->load->view('advertise/advertise', $data);
        }
    }

}