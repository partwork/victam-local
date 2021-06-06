<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();       
        $this->load->model('marketinginfo_model');
    }
    
    public function index(){
        try {
            $this->load_news_view();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_news_view(){

        $news_data=$this->marketinginfo_model->get_news();
        $news_data=(!empty($news_data))? $news_data : NULL;
        $data['news_data']=$news_data;

        $sector_data=$this->marketinginfo_model->getSector();
        $sector_data=(!empty($sector_data))? $sector_data : NULL;
        $data['sector_list']=$sector_data;

        $data['activePage'] = "marketInfo";
        $this->load->view('css_js_helpers');
        $this->load->view('market_info/news/n_css_js_helpers');
        $this->load->view('market_info/news/news', $data);
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
    public function readmore($id){

        $news_data=$this->marketinginfo_model->getBlogByid($id);
        $news_data=(!empty($news_data))? $news_data : NULL;
        $data['news_data']=$news_data;

        $sector_data=$this->marketinginfo_model->getSector();
        $sector_data=(!empty($sector_data))? $sector_data : NULL;
        $data['sector_list']=$sector_data;
        $data['activePage'] = "marketInfo";

        $this->load->view('css_js_helpers');
        $this->load->view('market_info/news/n_css_js_helpers');
        $this->load->view('market_info/news/news_readmore', $data);
    }

}