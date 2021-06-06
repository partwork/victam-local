<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPasswordController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SES_model');      
    }
	
	public function index(){
        try {
            if($this->input->post('resetlink') == 'sendEmail'){
                $this->send_reset_link();
            }else{
                $this->load_forgot_password_view();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_forgot_password_view(){
        $this->load->view('css_js_helpers');
        $this->load->view('forgot_password/f_css_js_helpers');
        $this->load->view('forgot_password/forgot_password');
    }
    public function send_reset_link(){
        $email = $this->input->post('email');
        $datetime = date('Y-m-d H:i:s');
        $encrypted_string=strtr(base64_encode($email), '+/=', '-_,');
        $current_time = strtotime($datetime);
        $resetLink = base_url().'reset_password?q='.$encrypted_string.'&t='.$current_time;
        // $resetLink = 'http://localhost/victam-dev/reset_password?q='.$encrypted_string.'&t='.$current_time;
        
        $response = $this->SES_model->send_password_reset_link($email,$resetLink);
        $this->session->set_flashdata('flash_success', 'Reset password link successfully sent to your email. Please check your registered email.');
        return redirect('forgotPassword');
    }
}