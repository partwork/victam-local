<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticlesController extends CI_Controller {

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

        $article_data=$this->marketinginfo_model->get_article();
        $article_data=(!empty($article_data))? $article_data : NULL;
        $data['article_data']=$article_data;

        /*$publisher_data=$this->marketinginfo_model->getSector();
        $publisher_data=(!empty($publisher_data))? $publisher_data : NULL;
        $data['publisher_list']=$publisher_data;*/

        $sector_data=$this->marketinginfo_model->getSector();
        $sector_data=(!empty($sector_data))? $sector_data : NULL;
        $data['sector_list']=$sector_data;


        $data['activePage'] = "marketInfo";
        $this->load->view('css_js_helpers');
        $this->load->view('market_info/articles/a_css_js_helpers');
        $this->load->view('market_info/articles/articles', $data);
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