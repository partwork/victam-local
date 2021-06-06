<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrivacyPolicyController extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct();       
    // }
	
	public function index(){
        // try {
            $this->load_privacy_policy_view();
        // } catch (\Throwable $th) {
            // throw $th;
        // }
    }

    public function load_privacy_policy_view(){
        $data['activePage'] = "home";
        $this->load->view('css_js_helpers');
        $this->load->view('privacy_policy/pp_css_js_helpers');
        $this->load->view('privacy_policy/privacy_policy', $data);
    }

}