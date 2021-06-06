<?php
include 'config/IsRegisteredController.php';

class MarketingInformationController extends IsRegisteredController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MarketingInfo_model', 'marketinginfo_model');
    }

 
    public function news($id = NULL)
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $news_data = $this->marketinginfo_model->get_news();
            $news_data = (!empty($news_data)) ? $news_data : NULL;
            $data['news_data'] = $news_data;
            $data['id'] = $id;
            $where=array('vic_sectors_industry_category'=>'market_info');
            $sector_data = $this->marketinginfo_model->getSector($where);
            $sector_data = (!empty($sector_data)) ? $sector_data : NULL;
            $data['sector_list'] = $sector_data;

            $data['activePage'] = "marketInfo";
            $this->load->view('css_js_helpers');
            $this->load->view('market_info/news/n_css_js_helpers');
            $this->load->view('market_info/news/news', $data);
        }
    }


    public function get_company_by_id()
    {   
        $id = $this->uri->segment(3);
            $news_data = $this->marketinginfo_model->get_company_by_id($id);
            $news_data = (!empty($news_data)) ? $news_data : NULL;
            $data['news_data'] = $news_data;
            $this->load->view('meta_helper', $data);
    }

    public function interview()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $interview_data = $this->marketinginfo_model->get_interview();
            $interview_data = (!empty($interview_data)) ? $interview_data : NULL;
            $data['interview_data'] = $interview_data;

            $where=array('vic_sectors_industry_category'=>'market_info');
            $sector_data = $this->marketinginfo_model->getSector($where);
            $sector_data = (!empty($sector_data)) ? $sector_data : NULL;
            $data['sector_list'] = $sector_data;

            $data['activePage'] = "marketInfo";
            $this->load->view('css_js_helpers');
            $this->load->view('market_info/interviews/i_css_js_helpers');
            $this->load->view('market_info/interviews/interviews', $data);
        }
    }
 
    public function articles()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $article_data = $this->marketinginfo_model->get_article();
            $article_data = (!empty($article_data)) ? $article_data : NULL;
            $data['article_data'] = $article_data;

            $where=array('vic_sectors_industry_category'=>'market_info');
            $sector_data = $this->marketinginfo_model->getSector($where);
            $sector_data = (!empty($sector_data)) ? $sector_data : NULL;
            $data['sector_list'] = $sector_data;

            $publisher_data = $this->marketinginfo_model->getPublisher();
            $publisher_data = (!empty($publisher_data)) ? $publisher_data : NULL;
            $data['publisher_list'] = $publisher_data;

            $data['activePage'] = "marketInfo";
            $this->load->view('css_js_helpers');
            $this->load->view('market_info/articles/a_css_js_helpers');
            $this->load->view('market_info/articles/articles', $data);
        }
    }

    public function search_blog_news()
    {
        $data = $this->marketinginfo_model->search_data($_GET);
        echo json_encode($data);
    }
    public function readmore($id)
    {
        if ($this->session->userdata('userId')) {
            $this->news($id);
            exit;
            if (!$this->session->userdata('userId')) {
                redirect('register');
            }
            $news_data = $this->marketinginfo_model->getBlogByid($id);
            $news_data = (!empty($news_data)) ? $news_data : NULL;
            $data['news_data'] = $news_data;

            $sector_data = $this->marketinginfo_model->getSector();
            $sector_data = (!empty($sector_data)) ? $sector_data : NULL;
            $data['sector_list'] = $sector_data;

            $data['activePage'] = "marketInfo";
            $this->load->view('css_js_helpers');
            $this->load->view('market_info/news/n_css_js_helpers');
            $this->load->view('market_info/news/news_readmore', $data);
        } else {
            redirect('register');
        }
    }
    public function new_sector($id)
    {
        if ($this->session->userdata('userId')) {
            
            $data['news_data'] = $this->marketinginfo_model->news_sector($id);
            $where=array('vic_sectors_industry_category'=>'market_info');
            $sector_data = $this->marketinginfo_model->getSector($where);
            $sector_data = (!empty($sector_data)) ? $sector_data : NULL;
            $data['sector_list'] = $sector_data;
            $data['sector'] = str_replace('-',' ',$id);;

            $data['activePage'] = "marketInfo";
            $this->load->view('css_js_helpers');
            $this->load->view('market_info/news/n_css_js_helpers');
            $this->load->view('market_info/news/news', $data);
        } else {
            redirect('register');
        }
    }
}
