<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class ResetPasswordController extends AdminController
{

    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/usermanagement/Resetpassword_model','user'); 
    }

    public function index()
    {
        $data['activePage'] = "resetPassword";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/reset_password/rp_css_js_helpers');
        $this->load->view('admin/reset_password/reset_password', $data);
    }

    public function reset_password()
    {
        try {
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required');

            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  

                $userid = $this->session->userdata('userId');

                $oldpass = $form_data['old_password'];

                $newpassword = $form_data['new_password'];

                $result = $this->user->change_password_ifmatch($userid, $oldpass, $newpassword);

                echo json_encode($result);
                
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}