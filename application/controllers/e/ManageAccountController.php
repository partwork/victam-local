<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAccountController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile');
        $this->userID = $this->session->userdata('userId');
    }
	
	public function index(){
            $this->load_manage_account_view();
    }

    public function load_manage_account_view(){
        $data['activePage'] = "home";
        $this->load->view('css_js_helpers');
        $this->load->view('manage_account/ma_css_js_helpers');
        $this->load->view('manage_account/manage_account', $data);
    }
    public function delete_account(){
        if($this->userID == NULL){
            redirect('login');
        }
        $password = $this->input->post('password');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/]'); 

        if($this->form_validation->run() == true){
            //check password matches with our db password
            $check = $this->profile->check_password(md5($this->input->post('password')),$this->userID);
            if($check){
                //delete account
                $delete = $this->profile->delete_account($this->userID);
                
                if($delete){
                    $this->session->set_flashdata('flash_success', 'Account deleted successfully');
                    $this->session->set_flashdata('flash_logout', 'logout');

                    redirect('logout');
                }
            }else{
                $this->session->set_flashdata('flash_error', 'Password does not match with our system');
            }
        }else{
            $error =(array) validation_errors(); 
            $msg = implode(" ",$error);
            $msg  = strip_tags($msg);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
        redirect('delete-account');
    }
}