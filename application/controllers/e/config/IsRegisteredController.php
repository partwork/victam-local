<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IsRegisteredController extends CI_Controller
{
    public function __construct(){
        parent::__construct(); 
        $this->isUserRegistered = $this->session->userdata('isUserRegistered');      
    }
}