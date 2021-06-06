<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class MarketInformationController extends AdminController
{

    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/Marketinformation_model','marketing');     
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/contentmanagement/Home_model');     

    }

    public function news(){
        $data['activePage'] = "marketNews";
        // $column = 'news';
        // $data['content'] = $this->Home_model->get_interview_article_news($column);
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/news', $data);
    }

    public function addNews(){
        $data['activePage'] = "Add News";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/addNews', $data);
    }

    public function interviews()
    {
        $data['activePage'] = "marketInterviews";
        $column = 'interview';
        // $result=$this->Home_model->get_interview_article_news($column);
        // $data['content'] =(!empty($result[0])) ? $result : NULL;
        $column = 'interview';
        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/market-info/interviews/pagination";
        $config["total_rows"] = $this->marketing->count_interview_article_news();
        $config["per_page"] = 8;
        $config["uri_segment"] = 6;
        //pagination UI Controls
        $config['num_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="page-item active banner-pagination"><a href="javascript:void(0);">'; 
        $config['cur_tag_close'] = '</a></li>'; 
        $config['next_link'] = '<i class="fa fa-angle-right fs-18  mt-1"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left fs-18  mt-1"></i>';  
        $config['next_tag_open'] = '<li class="pg-next page-item next-page ml-2">'; 
        $config['next_tag_close'] = '</li>'; 
        $config['prev_tag_open'] = '<li class="pg-prev page-item prev-page">'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['first_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
        $data["content"] = $this->marketing->get_interview($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/interviews', $data);

    }
    public function addInterviews()
    {
        $data['activePage'] = "Add Interviews";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/addInterviews', $data);
    }

    public function articles()
    {

        $data['activePage'] = "marketArticles";
        $column = 'article';

        // $list=$this->marketing->getMarketingList(array('vic_bn_type'=>'article'));

        // $data['article_list']=(!empty($list))? $list: NULL;

        // $data['content'] = $this->Home_model->get_interview_article_news($column);

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/articles', $data);
    }
    public function addArticles()
    {
        $data['activePage'] = "Add Articles";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/addArticles', $data);
    }

    public function magazines()
    {
        
        // $list=$this->marketing->getMarketingList(array('vic_bn_type'=>'magzine'));
        // $data['article_list']=(!empty($list))? $list: NULL;
        
        $where=array('vic_bn_type'=>'magzine');

        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/market-info/magazines/pagination";
        $config["total_rows"] = $this->marketing->get_count_magazine($where);
        $config["per_page"] = 8;
        $config["uri_segment"] = 6;
        //pagination UI Controls
        $config['num_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class=" page-item active banner-pagination"><a href="javascript:void(0);">'; 
        $config['cur_tag_close'] = '</a></li>'; 
        $config['next_link'] = '<i class="fa fa-angle-right fs-18  mt-1"></i>'; 
        $config['prev_link'] ='<i class="fa fa-angle-left fs-18  mt-1"></i>';
        $config['next_tag_open'] = '<li class="pg-next page-item">'; 
        $config['next_tag_close'] = '</li>'; 
        $config['prev_tag_open'] = '<li class="pg-prev page-item">'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['first_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
        $data["magzine"] = $this->marketing->get_magazine_list($config["per_page"], $page, $where);
        $data["links"] = $this->pagination->create_links();

        $data['activePage'] = "marketMagazines";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/magazines', $data);
    }
    public function addMagazines()
    {
        $data['activePage'] = "Add Magazines";
        
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/market-info/addMagazines', $data);
    }
    

    //news

    public function get_latest_news_by_id()
    {
        try {
            $data['activePage'] = 'Update News';
            $data['id'] = $this->uri->segment(6);
            $data['content'] = $this->Home_model->get_news_by_id($data);
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/market-info/addNews', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //interviews

    public function get_latest_interview_by_id()
    {
        try {
            $data['activePage'] = 'marketInterviews';
            $data['id'] = $this->uri->segment(6);
            $data['content'] = $this->Home_model->get_news_by_id($data);
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/market-info/addInterviews', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function store_marketing_info(){
        if ($this->input->is_ajax_request())
        {
            $title=$this->input->post('title');
            //$summary=$this->input->post('summary');
            $sector=$this->input->post('sectorFilter');
            $desc=trim($this->input->post('description'));
            $publisher=$this->input->post('publisher');
            $keyword=$this->input->post('keyword');
            $type=$this->input->post('type');
            $status=$this->input->post('status');
            $websiteurl = $this->input->post('websiteurls');
            $id=$this->input->post('id');
            if($type=='interview'){
                $result=$this->add_update_interview($_POST);
                echo $result;
                exit;
            }

            $this->form_validation->set_rules('title', 'Title', 'required');
            //$this->form_validation->set_rules('summary', 'Summary', 'required');
            $this->form_validation->set_rules('sectorFilter', 'Sector', 'required');
            
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('publisher', 'Publisher', 'required');
            $this->form_validation->set_rules('keyword', 'keyword', 'required');
            $this->form_validation->set_rules('websiteurls', 'websiteurl', 'required');

            if ($this->form_validation->run() == FALSE){
                echo json_encode(array('status'=>'fail','msg'=>validation_errors()));
                exit;
            }

            if(isset($_FILES['mkt_file']) && $_FILES['mkt_file']['name']!=''){
               $result = $this->umodel->do_upload('mkt_file', 'jpg|png|jpeg', 'marketing_info');

                if (!$result['error']) {
                    //$column['vic_bn_image'] ='upload/marketing_info/'.$result['file_path'];
                    $column['vic_bn_image'] =$result['file_path'];
                }
                else{
                    echo json_encode(array('status'=>'fail','msg'=>$result['msg']));
                    exit;
                }     
            }
            if(isset($_FILES['interviewvideo']) && $_FILES['interviewvideo']['name']!=''){
                $result = $this->umodel->do_upload('interviewvideo', 'jpg|png|jpeg', 'marketing_info');

                if (!$result['error']) {
                    //$column['vic_bn_image'] ='upload/marketing_info/'.$result['interviewvideo'];
                    $column['vic_bn_image'] =$result['interviewvideo'];
                } 
                else{
                    echo json_encode(array('status'=>'fail','msg'=>$result['msg']));
                    exit;
                }
            }
            
            $company=$this->session->userdata('companyId');
            $column['vic_bn_title']=$title;
            $column['vic_description']=$desc;
            //$column['vic_blogs_article_summary']=$summary;
            $column['vic_news_category']=$sector;
            
            $column['vic_blogs_article_keyword']=$keyword;
            $column['vic_bn_firstname']=$publisher;
            $column['vic_bn_status']=(isset($status))? 'active' :'inactive';
            $column['vic_bn_createdat']=date('Y-m-d H:i:s');
            $column['vic_bn_type']=$type;
            $column['vic_blogs_website_url'] = $websiteurl;
            $column['vic_updated_at']=date('Y-m-d H:i:s');
            
            if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
            }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                $column['vic_modification_status'] = 'Published';
            }else{
                $column['vic_modification_status'] = 'Under Review';
            }
            
            
            $msg=array();
            if($id!=''){

                $msg=array('status'=>'success','msg'=>'Update successfull');
                $where=array('idvic_blogs_news'=>$id);
                $result= $this->marketing->update_data($column,$where);
            }
            else
            {
                $msg=array('status'=>'success','msg'=>'Add successfull');
                $result= $this->marketing->store_data($column);
            }
            if($result){
                echo json_encode($msg);
            }
            else
            {
                echo json_encode(array('type' =>'fail','msg'=>'Fail Operation'));
            }
        }
        else
        {
          exit('No direct script access allowed');
        }
    }
    public function add_update_interview($data){

        $title=$data['title'];
        $type=$data['type'];
        $id=$data['id'];

        $this->form_validation->set_rules('title', 'Title', 'required');
        
        // $this->form_validation->set_rules('description', 'Description', 'required');
        // $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        // $this->form_validation->set_rules('keyword', 'keyword', 'required');
        if(isset($_POST['position'])){
            $this->form_validation->set_rules('position', 'Position', 'required');    
        }
        if ($this->form_validation->run() == FALSE){
            $msg=array('status'=>'error','msg'=>validation_errors());
            return $msg;
        }

        if(isset($_FILES['interviewvideo']) && $_FILES['interviewvideo']['name']!=''){

           $result = $this->umodel->do_upload('interviewvideo', 'mp4', 'interviews');

            if (!$result['error']) {
                //$column['vic_blogs_news_video'] ='upload/marketing_info/'.$result['file_path'];
                $column['vic_blogs_news_video'] =$result['file_path'];
            }   
            else{
                echo json_encode(array('status'=>'fail','msg'=>$result['msg']));
                exit;
            }  
        }

         $company=$this->session->userdata('companyId');
            $column['vic_bn_title']=$data['title'];
            $column['vic_bn_position']=(isset($data['position']))? $data['position'] : NULL;
            $column['duration_from']=date('Y-m-d',strtotime($data['lnInterviewFrom']));
            $column['duration_to']=date('Y-m-d',strtotime($data['lnInterviewTo']));
            $column['vic_bn_youtubeURL']=$data['youtubeurl'];
            $column['vic_bn_status']=(isset($data['status']))? 'active' :'inactive';
            $column['vic_bn_createdat']=date('Y-m-d H:i:s');
            $column['vic_bn_type']=$data['type'];
            $column['vic_news_category']=(isset($data['sectorFilter'])) ? $data['sectorFilter']:NULL; 
                
                
            
            if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
            }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                $column['vic_modification_status'] = 'Published';
            }else{
                $column['vic_modification_status'] = 'Under Review';
            }
            
            
            $msg=array();
            if($id!=''){
                $msg=array('status'=>'success','msg'=>'Update successfull');
                $where=array('idvic_blogs_news'=>$id);
                $result= $this->marketing->update_data($column,$where);
            }
            else
            {
                $msg=array('status'=>'success','msg'=>'Add successfull');
                $result= $this->marketing->store_data($column);
            }
            if($result){
                $result1=json_encode($msg);
            }
            else
            {
                $result1=json_encode(array('type' =>'fail','msg'=>'Fail Operation'));
            }
            return $result1;
    }
    public function reject_data($id){
        if ($this->input->is_ajax_request())
        {
            $where=array('idvic_blogs_news'=>$id);
            $data=array('vic_modification_status'=>'Rejected','vic_bn_status'=>'inactive');
            $result= $this->marketing->update_data($data,$where);
            echo json_encode($result);
        }
        else
        {
            exit('No direct script access allowed');
        }
        
    }
    public function delete_mkt_info($id){
        if ($this->input->is_ajax_request())
        {
         $result=$this->marketing->delete_mkt($id);
         echo json_encode($result);
        }
        else
        {
            exit('No direct script access allowed');
        }
    }
    public function edit_marketing_info($id){
        $list=$this->marketing->getMarketingList(array('idvic_blogs_news'=>$id));
        if(!empty($list[0])){
            $list=$list[0];
            $type=$list->vic_bn_type;
            $file_name='';
            switch ($type) {
                
                case 'article':
                    $file_name='addArticles';
                    break;
                case 'interview':
                    $file_name='addInterviews';
                    break;    
                case 'magzine':
                    $file_name='addMagazines';
                    break;
                
                default:
                    $file_name='addArticles';
                    break;
            }
            $data['activePage'] = $file_name;
            $data['type']=$type;
            $data['mkt_data']=$list;
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/market-info/'.$file_name.'.php', $data);
        }

    }
    public function add_magzine()
    {
        
        if ($this->input->is_ajax_request())
        {
            $title=$this->input->post('title');
            $issue=$this->input->post('issue');
            $valume=$this->input->post('volume');
            $year=$this->input->post('year');
            $status=$this->input->post('status');

            $type=$this->input->post('type');
            $id=$this->input->post('id');


            // $this->form_validation->set_rules('title', 'Title', 'required');
            // $this->form_validation->set_rules('issue', 'Issue', 'required');
            // $this->form_validation->set_rules('volume', 'Volume', 'required');
            // $this->form_validation->set_rules('year', 'Year', 'required');
            

            // if ($this->form_validation->run() == FALSE){
            //     echo validation_errors();
            //     exit;
            // }
               
            
            if(isset($_FILES['upload_pdf_thumb']) && $_FILES['upload_pdf_thumb']['name']!=''){
               $result = $this->umodel->do_upload('upload_pdf_thumb', 'jpg|png', 'marketing_info');

                if (!$result['error']) {
                    //$column['vic_bn_image'] ='upload/marketing_info/'.$result['file_path'];
                    $column['vic_bn_image'] =$result['file_path'];
                }else{
                    echo json_encode(array('status'=>'fail','msg'=>'Image :'.$result['msg']));
                    exit;
                }     
            }
            if(isset($_FILES['mkt_file']) && $_FILES['mkt_file']['name']!=''){
               $result = $this->umodel->do_upload('mkt_file', 'pdf', 'marketing_info');

                if (!$result['error']) {
                    //$column['vic_bn_document_url'] ='upload/marketing_info/'.$result['file_path'];
                    $column['vic_bn_document_url'] =$result['file_path'];
                }
                else{
                 echo json_encode(array('status'=>'fail','msg'=>'PDF :'.$result['msg']));
                 exit;   
                }     
            }
            
            $column['vic_bn_title']=$title;
            $column['vic_description']=$issue;
            $column['vic_bn_storytextdoc']=$valume;
            $column['vic_bn_position']=$year;
            $column['vic_bn_status']=(isset($status))? $status :'inactive';
            $column['vic_bn_createdat']=date('Y-m-d H:i:s');

            $column['vic_bn_type']=$type;

            if($this->session->userdata('usertype') == 'super admin'){
                $column['vic_modification_status'] = 'Published';
        }else if($this->session->userdata('usertype') == 'publisher - moderator'){
            $column['vic_modification_status'] = 'Published';
        }else{
            $column['vic_modification_status'] = 'Under Review';
        }
            
            $msg=array();
            if($id!=''){
                $column['vic_updated_at']=date('Y-m-d H:i:s');
                $msg=array('status'=>'success','msg'=>'Update successfull');
                $where=array('idvic_blogs_news'=>$id);
                $result= $this->marketing->update_data($column,$where);
            }
            else
            {
                $msg=array('status'=>'success','msg'=>'Add successfull');
                $result= $this->marketing->store_data($column);
            }
            if($result){
                echo json_encode($msg);
            }
            else
            {
                echo json_encode(array('type' =>'fail','msg'=>'Fail Operation'));
            }
        }
        else
        {
          exit('No direct script access allowed');
        }
    }
    public function get_json_list()
    {
       
       $result= $this->marketing->datatable_list($_POST);
       echo $result;
    }
    public function edit_marketing_status($id,$status){
        $where=array('idvic_blogs_news'=>$id);
        $data=array('vic_bn_status'=>$status);
        $result=$this->marketing->update_data($data,$where);
        echo json_encode($result);
    }
    public function search_data_ajax(){
       $result=$result= $this->marketing->search_marketing($_POST);
       echo json_encode($result);
    }
}
