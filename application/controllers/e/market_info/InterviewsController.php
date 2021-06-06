<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InterviewsController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();       
        $this->load->model('marketinginfo_model');
    }
    
    public function index(){
        try {
            $this->load_articles_view();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_articles_view(){

        $interview_data=$this->marketinginfo_model->get_interview();
        $interview_data=(!empty($interview_data))? $interview_data : NULL;
        $data['interview_data']=$interview_data;

        $sector_data=$this->marketinginfo_model->getSector();
        $sector_data=(!empty($sector_data))? $sector_data : NULL;
        $data['sector_list']=$sector_data;

        $data['activePage'] = "marketInfo";
        $this->load->view('css_js_helpers');
        $this->load->view('market_info/interviews/i_css_js_helpers');
        $this->load->view('market_info/interviews/interviews', $data);
    }
    public function search_blog_news(){
        if ($this->input->is_ajax_request()) {
            $data=$this->marketinginfo_model->search_data($_GET);
            echo json_encode($data);    
        }
        else
        {
            exit('No direct script access allowed');
        } 
    }

}