<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetPasswordController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user'); 
    }

    public function index()
    {
        try {
            if ($this->input->post('action') == 'Reset') {
               $this->reset_password();
            }
            $this->load_reset_password_View();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_reset_password_View(){

        $this->load->view('css_js_helpers');
        $this->load->view('reset_password/r_css_js_helpers');
        $this->load->view('reset_password/reset_password');
    }
    public function reset_password(){
        $encrypted_string = $this->input->post('query');
        $email = base64_decode(strtr($encrypted_string, '-_,', '+/='));

        $date_time1 = $this->input->post('query1'); 
        $date_time2 = strtotime(date('Y-m-d H:i:s')); 
        $minutes = round(abs($date_time2 - $date_time1) / 60,1);

        if($minutes < 60){
            $this->form_validation->set_rules('password', 'password', 'required'); 
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 

            if($this->form_validation->run() == true){
                $new_password = $this->input->post('password');

                $update = $this->user->reset_password(md5($new_password),$email);
                if($update){
                    $this->session->set_flashdata('flash_success', 'Password changed successfully.');
                    redirect('reset_password');
                }else{
                    $this->session->set_flashdata('flash_error', 'Something went wrong. Please try again');
                    redirect('reset_password?q='.$encrypted_string.'&t='.$date_time1);
                }
            }else{
                $error =(array) validation_errors(); 
                $msg = implode(" ",$error);
                $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
                $this->session->set_flashdata('flash_error',$msg);
                redirect('reset_password?q='.$encrypted_string.'&t='.$date_time1);
            }
        }else{
                $this->session->set_flashdata('flash_error', 'This link is expired');
                redirect('reset_password');
        }
    }
}
