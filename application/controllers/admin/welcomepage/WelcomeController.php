<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class WelcomeController extends AdminController
{
    public function index()
    {
    	
        $data['activePage'] = "welcomePage";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/welcomepage/welcome-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/welcomepage/welcome', $data);
    }


}