<?php defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->userId = $this->session->userdata('userId');
        $this->load->model('SES_model');
    }

    public function welcomemail()
    {
       try {
             $this->SES_model->sendwelcome();
       } catch (\Throwable $th) {
           throw $th;
       }
    }

    public function otpmail()
    {
        try {
            $this->SES_model->sendotp();
      } catch (\Throwable $th) {
          throw $th;
      }
    }
}