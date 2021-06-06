<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // $this->userId = $this->session->userdata('userId');
        $this->load->model('search_model');
        $this->load->model('SES_model');
        $this->load->model('home_model');
    }
    
    public function index()
    {
        $data['company_logo'] = $this->home_model->get_active_banner();
        if(isset($_GET['q'])){
            $val =  $_GET ['q'];
            if($val){
                $value = urldecode($val);
                $data['result'] = $this->search_model->get_value_by_q($value);
                $data['activePage'] = "home";
                $this->load->view('css_js_helpers');
                $this->load->view('shared/search/s_css_js_helpers');
                $this->load->view('shared/search/search', $data);
            }else{
                $data['activePage'] = "home";
                $this->load->view('css_js_helpers');
                $this->load->view('shared/search/s_css_js_helpers');
                $this->load->view('shared/search/search', $data);
            }
        }else{
                $data['activePage'] = "home";
                $this->load->view('css_js_helpers');
                $this->load->view('shared/search/s_css_js_helpers');
                $this->load->view('shared/search/search', $data);
        }
    } 

    public function ajax_request_by_value()
    {
        try {
            if ($this->input->is_ajax_request()) {
                $valueencode = $this->uri->segment(4);
                $value = urldecode($valueencode);
                $result =  $this->search_model->get_value_by_q($value);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}