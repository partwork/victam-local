<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/admin/config/AdminController.php';

class HomeController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/Home_model');     
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/others/Notification_model');   
    }

    public function latestNews()
    {
        $data['activePage'] = "news";
        $column = 'news';
        $data['content'] = $this->Home_model->get_interview_article_news($column);
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/latestNews', $data);
    }

    public function addEditLatestNews()
    {
        $data['activePage'] = "Add News";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/addEditLatestNews', $data);
    }
  
    public function latestInterview()
    {
        $data['activePage'] = "interviews";
        $column = 'interview';
        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/home/latest-interview/pagination";
        $config["total_rows"] = $this->Home_model->count_interview_article_news();
        $config["per_page"] = 8;
        $config["uri_segment"] = 6;

        //pagination UI Controls
        $config['num_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="page-item active banner-pagination"><a href="javascript:void(0);">'; 
        $config['cur_tag_close'] = '</a></li>'; 
        $config['next_link'] = '<i class="fa fa-angle-right fs-20 mt-2"></i>'; 
        $config['prev_link'] = '<i class="fa fa-angle-left fs-20 mt-2"></i>';  
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
        $data["content"] = $this->Home_model->get_interview($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/latestInterview', $data);
    }

    public function addEditLatestInterview()
    {   
        $where=array('vic_sectors_industry_category'=>'market_info');
        $sector=$this->Home_model->getSector($where);
        $data['sector']=(!empty($sector))? $sector : NULL;
        $data['activePage'] = "Add Interviews";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/addEditLatestInterview', $data);
    }

    public function banner()
    {
        
        $data['activePage'] = "banner";
        $column = 'slider';
        

        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/home/banners/pagination";
        $config["total_rows"] = $this->Home_model->get_count_banner_logo($column);
        $config["per_page"] = 8;
        $config["uri_segment"] = 6;

        
        //pagination UI Controls
        $config['num_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="page-item active banner-pagination"><a href="javascript:void(0);">'; 
        $config['cur_tag_close'] = '</a></li>'; 
        $config['next_link'] = '<i class="fa fa-angle-right fs-18  mt-1"></i>'; 
        $config['prev_link'] = '<i class="fa fa-angle-left fs-18  mt-1"></i>'; 
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
        // echo $page;
        // exit;
        $data["banner"] = $this->Home_model->get_banner_logo_list($config["per_page"], $page, $column);
        $data["links"] = $this->pagination->create_links();
        
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/banner', $data);
    }

    public function addEditbanner()
    {
        $where_cluase=array('vic_banner_is_active'=>'enable','vic_banner_type'=>'slider');
        $result=$this->Home_model->getPosition_numbers('vic_home_banner','vic_banner_postition',$where_cluase);
        $num_arr=array();
        if(isset($result) && !empty($result)){
            foreach ($result as $key => $value) {
                $num_arr[]=$value->number;

            }
        }
        $data['position']=$num_arr;

        $data['activePage'] = "Add Banner";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/addEditBanner', $data);
    }
    

    public function logos()
    {
        $data['activePage'] = "logos";
        $column = 'banner';
        
        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/home/logos/pagination";
        $config["total_rows"] = $this->Home_model->get_count_banner_logo($column);
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
        $data["logos"] = $this->Home_model->get_banner_logo_list($config["per_page"], $page, $column);
        $data["links"] = $this->pagination->create_links();
        
        
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/logos', $data);
    }

    public function addEditlogos()
    {
        $data['activePage'] = "Add Logo";

        $where_cluase=array('vic_banner_is_active'=>'enable','vic_banner_type'=>'banner');
        $result=$this->Home_model->getPosition_numbers('vic_home_banner','vic_banner_postition',$where_cluase);
        $num_arr=array();
        if(isset($result) && !empty($result)){
            foreach ($result as $key => $value) {
                $num_arr[]=$value->number;

            }
        }
        $data['position']=$num_arr;
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/addEditLogos', $data);
    }
    public function reject_advertisement($id=NULL){
        $id=($id==NULL)? $_POST['id'] : $id;
        
        $data = $this->Home_model->reject_advertisment($id);
        echo json_encode($data);
    }
    public function advertisements()
    {

        $column = 'advertisements';
        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/home/advertisement/pagination";
        $config["total_rows"] = $this->Home_model->count_advertisements();
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
        $data["content"] = $this->Home_model->get_advertisements($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();


        $data['activePage'] = "advertisements";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/advertisements', $data);
    }

    public function addEditAdvertisements()
    {
        $data['activePage'] = "Add Advertisements";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu' , $data);
        $this->load->view('admin/contentmanagement/addEditAdvertisements', $data);
    }


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
            $this->load->view('admin/contentmanagement/addEditLatestNews', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
 
    public function add_new_news()
    {
        try {
            $this->form_validation->set_rules('titles', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('lndatepicker', 'Date', 'required');
            $this->form_validation->set_rules('websiteurl', 'Website URL', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_bn_title'] = trim( $form_data['titles'] );
                $column['vic_description'] = trim( $form_data['description'] );
                //$column['vic_bn_storytext'] = trim( $form_data['description'] );
                $column['vic_bn_createdat'] = trim(date('Y-m-d',strtotime($form_data['lndatepicker'])) ) ;
                $column['vic_updated_at'] = date('Y-m-d H:i:s');

                $column['vic_news_category']=$form_data['category'];
                $column['vic_blogs_website_url']=$form_data['websiteurl'];

                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_modification_status'] = 'Published';
                }else{
                    $column['vic_modification_status'] = 'Under Review';
                }
                $column['vic_bn_tags_idvic_bn_tags'] = 1;
                $column['vic_bn_type'] = 'news';
                $column['vic_bn_status'] = 'active';
                $result = $this->db->insert('vic_blogs_news', $column);
                
                if( $result == true ){
                   
                    $data = (array('status' => 'added'));
                    $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                    //$adminlist = $this->Notification_model->get_admin_list();
                    $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));

                    foreach($adminlist as $li){
                        $val['sender_id'] = $this->session->userdata('userId');
                        $val['receiver_id'] = $li->iduser_details;
                    
                        if(!empty($output)){

                            if($this->session->userdata('usertype') != 'super admin'){
                                $val['title'] = 'News: The '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.' submitted the news on the portal';
                            }else{
                                $val['title'] = 'News: The news '.$form_data['titles'].' was successfully published by '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.' on the portal';
                            }
                            $this->Notification_model->add_notify($val);  
                            
                        }
                    }
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
 
    public function update_latest_news()
    {
        
        try {
            $this->form_validation->set_rules('titles', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('lndatepicker', 'Date', 'required');
            $this->form_validation->set_rules('websiteurl', 'Website URL', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_bn_title'] = trim( $form_data['titles'] );
                //$column['vic_bn_storytext'] = trim( $form_data['description'] );
                $column['vic_description'] = trim( $form_data['description'] );
                // $column['vic_bn_createdat'] = trim(date('Y-m-d',strtotime($form_data['lndatepicker'])) );
                $column['vic_updated_at'] = date('Y-m-d H:i:s');

                $column['vic_bn_status'] = 'active';

                $column['vic_news_category']=$form_data['category'];
                $column['vic_blogs_website_url']=$form_data['websiteurl'];
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_modification_status'] = 'Published';
                }else{
                    $column['vic_modification_status'] = 'Under Review';
                }

                $result = $this->Home_model->update_interview_article_news(array('idvic_blogs_news' => $form_data['idvic_blogs_news']) , $column);
                
                if( $result == true ){
                    $data = (array('status' => 'updated'));
                    if($this->session->userdata('usertype') != 'super admin'){
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                        
                        if($output){
                            foreach($adminlist as $li){
                                $val['sender_id'] = $this->session->userdata('userId');
                                $val['receiver_id'] = $li->iduser_details;
                                $val['title'] = 'The news '.$form_data['titles'].' was modified by '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.'';
                                $this->Notification_model->add_notify($val);   
                            } 
                        } 
                    }
                }else if ($result == false){
                    $data = (array('status' => 'failed'));
                }else{
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function  update_status_inverview($id,$status){
        $where=array('idvic_blogs_news'=>$id);
        $data=array('vic_bn_status'=>$status);

        $result=$this->Home_model->update_interview_article_news($where,$data);
        echo json_encode($result);
    }
    public function get_adv_position(){
        $page=$this->input->get('page');
        $page=($page!='') ? trim($page) : NULL;
        $where=array('vic_advertisment_ads_page'=>$page);
        $result=$this->Home_model->getPosition_numbers('vic_advertisment','vic_advertisment_ads_position',$where);
        $num_arr=array();
        if(isset($result) && !empty($result)){
            foreach ($result as $key => $value) {
                $num_arr[]=$value->number;

            }
        }

          $default_position=array('1','2','3');
          $db_position=array();
          if(isset($num_arr) && !empty($num_arr)){
            $db_position=$num_arr; 
           }
           $str='<option value="" disabled selected hidden class="placeholder-text">Select Ads Position</option>';

           foreach ($default_position as $key => $value)
           {
               $disable=''; 
               $selected='';
               $style='';
              if(in_array($value,$db_position,true))
              {
                $disable='disabled';
                $style='color:gray;';
              }  
              if (isset($content['0']->vic_advertisment_ads_position) && $content['0']->vic_advertisment_ads_position==$value)
              {
                $selected='selected'; 
                $disable='';
              }
              $str.='<option value="'.$value.'" '.$style.' '.$disable.' '.$selected.'>'.$value.'</option>';         

           }
             
        echo $str;
        exit;
    }
    public function update_latest_interview()
    {
        try {
            $this->form_validation->set_rules('titles', 'Title', 'required');
            //$this->form_validation->set_rules('position', 'Position', 'required');
            $this->form_validation->set_rules('sector', 'Sector', 'required');
            $this->form_validation->set_rules('lnInterviewFrom', 'From Date', 'required');
            $this->form_validation->set_rules('lnInterviewTo', 'To Date', 'required');
    
            if ($this->form_validation->run() == FALSE){
                $data = (array('status' => validation_errors()));
                echo json_encode($data);
                
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_bn_title'] = trim( $form_data['titles'] );
                //$column['vic_bn_position'] = trim( $form_data['position'] );
                $column['duration_from'] = date('Y-m-d',strtotime($form_data['lnInterviewFrom']));
                $column['duration_to'] =date('Y-m-d',strtotime($form_data['lnInterviewTo']));
                $column['vic_bn_youtubeURL'] = $form_data['youtubeurl'];
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_modification_status'] = 'Published';
                }else{
                    $column['vic_modification_status'] = 'Under Review';
                }

                if(isset($_FILES['interviewvideo']['name']) && $_FILES['interviewvideo']['name']!=''){
                    $result = $this->umodel->do_upload('interviewvideo', 'mp4|mov|avi', 'interviews');
                    if ($result['error']) {
                        echo json_encode(array('status'=>'fail','msg'=>$result['msg']));
                        exit;
                    }
                    if (!$result['error']) {
                        $column['vic_blogs_news_video'] = $result['file_path'];
                    }    
                }
                $column['vic_bn_createdat'] = date('Y-m-d H:i:s');
                $column['vic_bn_status'] =(isset($form_data['status']))? 'active' : 'inactive' ;
                $column['vic_news_category'] =$_POST['sector'];
                
                $vodep_type=$form_data['videoType'];
                if($vodep_type=='mp4'){
                    $column['vic_bn_youtubeURL']='';
                }
                if($vodep_type=='youTube'){
                    $column['vic_blogs_news_video']='';
                }

                $result = $this->Home_model->update_interview_article_news(array('idvic_blogs_news' => $form_data['idvic_blogs_news']) , $column);
                
                if( $result == true ){
                    $data = (array('status' => 'updated'));
                    if($this->session->userdata('usertype') != 'super admin'){
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                        if($output){
                            foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            $val['title'] = 'Interviews: The Interviews '.$form_data['titles'].' was modified by '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.'';
                            $this->Notification_model->add_notify($val);   
                        }  
                        }
                    }
                }else if ($result == false){
                    $data = (array('status' => 'failed'));
                }else{
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_interviews()
    {
        try {
            $this->form_validation->set_rules('titles', 'Title', 'required');
            //$this->form_validation->set_rules('position', 'Position', 'required');
            $this->form_validation->set_rules('sector', 'Sector', 'required');
            $this->form_validation->set_rules('lnInterviewFrom', 'From Date', 'required');
            $this->form_validation->set_rules('lnInterviewTo', 'To Date', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
                
                $column['vic_bn_title'] = trim( $form_data['titles'] );
                //$column['vic_bn_position'] = trim( $form_data['position'] );
                $column['duration_from'] =date('Y-m-d',strtotime($form_data['lnInterviewFrom']));
                $column['duration_to'] = date('Y-m-d',strtotime($form_data['lnInterviewTo']));
                $column['vic_bn_youtubeURL'] = $form_data['youtubeurl'];
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_modification_status'] = 'Published';
                }else{
                    $column['vic_modification_status'] = 'Under Review';
                }
                $column['vic_bn_createdat'] = date('Y-m-d H:i:s');
                $column['vic_bn_tags_idvic_bn_tags'] = 1;
                $column['vic_bn_type'] = 'interview';
                $column['vic_bn_status'] = 'active';
                $column['vic_news_category'] =$_POST['sector'];

                if(isset($_FILES['interviewvideo']['name']) && $_FILES['interviewvideo']['name']!=''){
                    $result = $this->umodel->do_upload('interviewvideo', 'mp4|mov|avi', 'interviews');
                    if ($result['error']) {
                        echo json_encode(array('status'=>'fail','msg'=>$result['msg']));
                        exit;
                    }
                    if (!$result['error']) {
                        $column['vic_blogs_news_video'] = $result['file_path'];
                    }    
                }
                $vodep_type=$form_data['videoType'];
                if($vodep_type=='mp4'){
                    $column['vic_bn_youtubeURL']='';
                }
                if($vodep_type=='youTube'){
                    $column['vic_blogs_news_video']='';
                }

                $result = $this->db->insert('vic_blogs_news', $column);
                if( $result == true ){
                    if($this->session->userdata('usertype') != 'super admin'){
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));

                        foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            if(!empty($output)){
                                $val['title'] = 'The '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.'submitted the interview on the portal';
                                $this->Notification_model->add_notify($val);       
                            }
                            
                        }  
                    }else{
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                            if(!empty($output)){
                                $val['title'] = 'Interviews: The Interviews '. $form_data['titles'].' was successfully published by '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.' on the portal';
                                $this->Notification_model->add_notify($val);       
                            }
                            
                        } 
                        
                    }
                    $data = (array('status' => 'added'));
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete_interview_article_news()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                if(is_numeric($id)){
                    $data = $this->Home_model->delete_interview_article_news($id);
                    echo json_encode($data);
                }else{
                    echo json_encode(array('msg'=>'Access Denied'));
                }
            }else{
                echo json_encode(array('msg'=>'Access Denied'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject_interview_article_news()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                $data = $this->Home_model->reject_interview_article_news($id);
                // if($this->session->userdata('usertype') == 'super admin'){
                    // $adminlist = $this->Notification_model->notify_user_list();
                    $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                    $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                    
                    foreach($adminlist as $li){
                        $val['sender_id'] = $this->session->userdata('userId');
                        $val['receiver_id'] = $li->iduser_details;
                        $val['title'] = 'The Content rejected by '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.' due to policy violation';
                        $this->Notification_model->add_notify($val);   
                    }  
                // }
                echo json_encode($data);
            }else{
                echo json_encode(array('msg'=>false));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_interview_by_id()
    {
        try {
            $data['activePage'] = 'Update Interviews';
            $data['id'] = $this->uri->segment(6);
            $data['content'] = $this->Home_model->get_news_by_id($data);
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/addEditLatestInterview', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    //banner and logos
    public function delete_banner_logo()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                if(is_numeric($id)){
                    $data = $this->Home_model->delete_banner_logo_by_id($id);
                    echo json_encode($data);
                }else{
                    echo json_encode(array('msg'=>'Access Denied'));
                }
            }else{
                echo json_encode(array('msg'=>'Access Denied'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject_logo_banner()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                $data = $this->Home_model->reject_banner_logo($id);
                echo json_encode($data);
            }else{
                echo json_encode(array('msg'=>false));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update_status_banner($id,$status){
        $where=array('vic_banner_id'=>$id);
        $data=array('vic_banner_is_active'=>$status);
        $result=$this->Home_model->update_banner_logos($where,$data);

        echo json_encode($result);
    }
    public function get_banner_by_id()
    {
        try {
            $data['activePage'] = 'Update Banner';
            $data['id'] = $this->uri->segment(6);
            $data['content'] = $this->Home_model->get_banner_logo_by_id($data);

            $where_cluase=array('vic_banner_is_active'=>'enable','vic_banner_type'=>'slider');
            $result=$this->Home_model->getPosition_numbers('vic_home_banner','vic_banner_postition',$where_cluase);
            $num_arr=array();
            if(isset($result) && !empty($result)){
                foreach ($result as $key => $value) {
                    $num_arr[]=$value->number;

                }
            }
            $data['position']=$num_arr;

            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/addEditBanner', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_logos_by_id()
    {
        $data['activePage'] = "Update Logo";
        $data['id'] = $this->uri->segment(6);
        $data['content'] = $this->Home_model->get_banner_logo_by_id($data);

        $where_cluase=array('vic_banner_is_active'=>'enable','vic_banner_type'=>'banner');
        $result=$this->Home_model->getPosition_numbers('vic_home_banner','vic_banner_postition',$where_cluase);
        $num_arr=array();
        if(isset($result) && !empty($result)){
            foreach ($result as $key => $value) {
                $num_arr[]=$value->number;

            }
        }
        $data['position']=$num_arr;

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/addEditLogos', $data);
    }

    public function add_banner()
    {
        try {
            $this->form_validation->set_rules('cname', 'Company Name', 'required');
            $this->form_validation->set_rules('btitle', 'Banner Title', 'required');
            $this->form_validation->set_rules('position', 'Banner Position', 'required');
            $this->form_validation->set_rules('bannerFrom', 'Duration Form', 'required');
            $this->form_validation->set_rules('bannerTo', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 

                $column['vic_banner_company_name'] = trim( $form_data['cname'] );
                $column['vic_banner_title'] = trim( $form_data['btitle'] );
                $column['vic_banner_postition'] = trim( $form_data['position'] );
                $column['vic_banner_duration_from'] =date('Y-m-d',strtotime($form_data['bannerFrom']));
                $column['vic_banner_duration_to'] = date('Y-m-d',strtotime($form_data['bannerTo']));
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_banner_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_banner_status'] = 'Published';
                }else{
                    $column['vic_banner_status'] = 'Under Review';
                }
                $column['vic_banner_created_on'] = date('Y-m-d H:i:s');
                $column['vic_banner_type'] = 'slider';
                $column['vic_banner_is_active'] = 'enable';

                $result = $this->umodel->do_upload('uploadAttachment', 'jpg|png|jpeg', 'banner');
                if ($result['error']) {
                    echo json_encode($result);
                    exit;
                }

                if (!$result['error']) {
                    $column['vic_banner_image'] = $result['file_path'];
                }

                $result = $this->db->insert('vic_home_banner', $column);
                if( $result == true ){
                    $data = (array('status' => 'added'));
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_logos()
    {
        try {
            $this->form_validation->set_rules('cname', 'Company Name', 'required');
            $this->form_validation->set_rules('logourl', 'Logo URl', 'required');
            $this->form_validation->set_rules('position', 'Banner Position', 'required');
            $this->form_validation->set_rules('dfrom', 'Duration Form', 'required');
            $this->form_validation->set_rules('tfrom', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_banner_company_name'] = trim( $form_data['cname'] );
                $column['vic_logo_url'] = trim( $form_data['logourl'] );
                $column['vic_banner_postition'] = trim( $form_data['position'] );
                $column['vic_banner_duration_from'] =date('Y-m-d',strtotime($form_data['dfrom']));
                $column['vic_banner_duration_to'] = date('Y-m-d',strtotime($form_data['tfrom']));
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_banner_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_banner_status'] = 'Published';
                }else{
                    $column['vic_banner_status'] = 'Under Review';
                }
                $column['vic_banner_created_on'] = date('Y-m-d H:i:s');
                $column['vic_banner_type'] = 'banner';
                $column['vic_banner_is_active'] = 'enable';

                $result = $this->umodel->do_upload('uploadAttachment', 'jpg|png|jpeg', 'company');
                if ($result['error']) {
                    echo json_encode($result);
                    exit;
                }

                if (!$result['error']) {
                    $column['vic_logo_image_path'] = $result['file_path'];
                }

                $result = $this->db->insert('vic_home_banner', $column);
                if( $result == true ){
                    $data = (array('status' => 'added'));
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_banner()
    {
        try {
            $this->form_validation->set_rules('cname', 'Company Name', 'required');
            $this->form_validation->set_rules('btitle', 'Banner Title', 'required');
            $this->form_validation->set_rules('position', 'Banner Position', 'required');
            $this->form_validation->set_rules('bannerFrom', 'Duration Form', 'required');
            $this->form_validation->set_rules('bannerTo', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
                
                $column['vic_banner_company_name'] = trim( $form_data['cname'] );
                $column['vic_banner_title'] = trim( $form_data['btitle'] );
                $column['vic_banner_postition'] = trim( $form_data['position'] );
                $column['vic_banner_duration_from'] =date('Y-m-d',strtotime($form_data['bannerFrom']));
                $column['vic_banner_duration_to'] =date('Y-m-d',strtotime($form_data['bannerTo']));
                
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_banner_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_banner_status'] = 'Published';
                }else{
                    $column['vic_banner_status'] = 'Under Review';
                }
                $column['vic_banner_created_on'] = date('Y-m-d H:i:s');

                if(isset($form_data['isactive'])){
                    $column['vic_banner_is_active'] = 'enable';
                }else{
                    $column['vic_banner_is_active'] = 'disable';
                }
  
                if($_FILES['uploadAttachment']['name']!=''){
                    
                    $result_file = $this->umodel->do_upload('uploadAttachment', 'jpg|png|jpeg', 'banner');
                    if ($result_file['error']) {
                        echo json_encode($result_file);
                        exit;
                    }

                    if (!$result_file['error']) {
                        $column['vic_banner_image'] = $result_file['file_path'];
                    }    
                }
                
                $id=$this->input->post('banner_id');

                $result = $this->Home_model->update_banner_logos(array('vic_banner_id' =>$id) , $column);
                
                if( $result == true ){
                    $data = (array('status' => 'updated'));
                }else if ($result == false){
                    $data = (array('status' => 'failed'));
                }else{
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_logos()
    {   
        try {
            $this->form_validation->set_rules('cname', 'Company Name', 'required');
            $this->form_validation->set_rules('logourl', 'Logo URl', 'required');
            $this->form_validation->set_rules('position', 'Banner Position', 'required');
            $this->form_validation->set_rules('dfrom', 'Duration Form', 'required');
            $this->form_validation->set_rules('tfrom', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_banner_company_name'] = trim( $form_data['cname'] );
                $column['vic_logo_url'] = trim( $form_data['logourl'] );
                $column['vic_banner_postition'] = trim( $form_data['position'] );
                $column['vic_banner_duration_from'] =date('Y-m-d',strtotime($form_data['dfrom']));
                $column['vic_banner_duration_to'] =date('Y-m-d',strtotime($form_data['tfrom']));
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_banner_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_banner_status'] = 'Published';
                }else{
                    $column['vic_banner_status'] = 'Under Review';
                }
                $column['vic_banner_created_on'] = date('Y-m-d H:i:s');
                $column['vic_banner_type'] = 'banner';
                $column['vic_banner_is_active'] =(isset($form_data['status']))? 'enable' : 'disable' ;

                

                if($_FILES['uploadAttachment']['name']!=''){
                    $result = $this->umodel->do_upload('uploadAttachment', 'jpg|png|jpeg', 'company');
                    if ($result['error']) {
                        echo json_encode($result);
                        exit;
                    }

                    if (!$result['error']) {
                        $column['vic_logo_image_path'] = $result['file_path'];
                    }
                }
                

                $result = $this->Home_model->update_banner_logos(array('vic_banner_id' => $form_data['banner_id']) , $column);
                
                if( $result == true ){
                    $data = (array('status' => 'updated'));
                }else if ($result == false){
                    $data = (array('status' => 'failed'));
                }else{
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function promotedVideos()
    {
        $column = 'interview';
        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/home/promoted-videos/pagination";
        $config["total_rows"] = $this->Home_model->count_promoted_video();
        //$config["per_page"] = 8;
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
        $data["content"] = $this->Home_model->get_promotvideo($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $data['activePage'] = "videos";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/promotedVideos', $data);
    }

    public function addEditPromotedVideos($id=NULL)
    {
        $data['content'] = $this->Home_model->promoted_video_by_id($id);
       
         
        $where_cluase=array('vic_promoted_video_is_active'=>'active','vic_promoted_type'=>'promoted');
        $result=$this->Home_model->getPosition_numbers('vic_promoted_video','vic_promoted_video_position',$where_cluase);
        $num_arr=array();
        if(isset($result) && !empty($result)){
            foreach ($result as $key => $value) {
                $num_arr[]=$value->number;

            }
        }  

        if($data['content']){
            echo $content = 'Update Promoted Video';
        }else{
            echo $content = 'Add Promoted Video';
        }
       
        $data['position']=$num_arr;
        $data['activePage'] = $content;
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/addEditPromotedVideos', $data);
    }
    public function get_video_by_id()
    {
        try {
            $data['activePage'] = 'Update Interviews';
            $data['id'] = $this->uri->segment(6);
            $data['content'] = $this->Home_model->get_news_by_id($data);
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/addEditLatestInterview', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    //promoted video

    public function get_promoted_video_by_id(){
        try {
            $data['id'] = $this->uri->segment(6);
            $data['content'] = $this->Home_model->promoted_video_by_id($data);

            $data['activePage'] = "Update videos";
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/addEditPromotedVideos', $data);  
        } catch (\Throwable $th) {
            throw $th;
        }       
    }

    public function publish_save_promoted_video(){
        try {
            $this->form_validation->set_rules('title', 'Video Title', 'required');
            $this->form_validation->set_rules('position', 'Video position', 'required');
            $this->form_validation->set_rules('dFrom', 'Duration From', 'required');
            $this->form_validation->set_rules('dTo', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_promoted_video_title'] = trim( $form_data['title'] );
                $column['vic_promoted_video_position'] = trim( $form_data['position'] );
                $column['vic_promoted_video_duration_from'] = date('Y-m-d',strtotime($form_data['dFrom'])) ;
                $column['vic_promoted_video_duration_to'] = date('Y-m-d',strtotime($form_data['dTo'])) ;
                $column['vic_promoted_video_url'] = $form_data['youtubeurl'];
                // $column['vic_promoted_upload_video'] = $form_data['youtubeurl'];

                  
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_promoted_video_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_promoted_video_status'] = 'Published';
                }else{
                    $column['vic_promoted_video_status'] = 'Under Review';
                }
                $column['vic_created_at'] = date('Y-m-d H:i:s');
                $column['vic_promoted_video_is_active'] = 'active';
                $column['vic_promoted_type'] = 'promoted';

                $result = $this->umodel->do_upload('uploadAttachment', 'mp4', 'promoted');

                if (!$result['error']) {
                    $column['vic_promoted_upload_video'] = $result['file_path'];
                     
                }
                else
                {
                    echo json_encode(array('status'=>'fail','msg'=>$result['msg']));
                    exit;
                }


                 $video_type=$form_data['videoType'];
                if($video_type=='mp4'){
                    $column['vic_promoted_video_url'] ='';
                }
                else if($video_type=='youTube'){
                     $column['vic_promoted_upload_video']='';
                }

                $result = $this->db->insert('vic_promoted_video', $column);
                if( $result == true ){
                    $data = (array('status' => 'added'));
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_promoted_video()
    {
        try {
            
            $this->form_validation->set_rules('title', 'Video Title', 'required');
            $this->form_validation->set_rules('position', 'Video position', 'required');
            $this->form_validation->set_rules('dFrom', 'Duration To', 'required');
            $this->form_validation->set_rules('dTo', 'Video URL', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_promoted_video_title'] = trim( $form_data['title'] );
                $column['vic_promoted_video_position'] = trim( $form_data['position'] );
                $column['vic_promoted_video_duration_from'] = trim( $form_data['dFrom'] );
                $column['vic_promoted_video_duration_to'] = $form_data['dTo'] ;
                $column['vic_promoted_video_url'] = $form_data['youtubeurl'] ;
                $column['vic_promoted_video_is_active'] = (isset($form_data['status']))?'active' : 'inactive';
                $result = $this->umodel->do_upload('uploadAttachment', 'mp4', 'promoted');

                if (!$result['error']) {
                    $column['vic_promoted_upload_video'] = $result['file_path'];
                }

                $video_type=$form_data['videoType'];
                if($video_type=='mp4'){
                    $column['vic_promoted_video_url'] ='';
                }
                else if($video_type=='youTube'){
                     $column['vic_promoted_upload_video']='';
                }   
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_promoted_video_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_promoted_video_status'] = 'Published';
                }else{
                    $column['vic_promoted_video_status'] = 'Under Review';
                }
                $column['vic_created_at'] = date('Y-m-d H:i:s');

                if(isset($form_data['status'])){
                    $column['vic_promoted_video_is_active'] = 'active';
                }else{
                    $column['vic_promoted_video_is_active'] = 'inactive';
                }

                $result = $this->Home_model->update_promoted_video(array('idvic_promoted_video' => $form_data['idvic_promoted_video']) , $column);
                
                if( $result == true ){
                    $data = (array('status' => 'updated'));
                }else if ($result == false){
                    $data = (array('status' => 'failed'));
                }else{
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject_promoted_video_by_id()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                $data = $this->Home_model->reject_promoted_video($id);
                echo json_encode($data);
            }else{
                echo json_encode(array('msg'=>false));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function reject_promoted_video(){
        $id=$this->input->post('id');
        try {
            if($this->input->is_ajax_request()){   
                $data = $this->Home_model->reject_promoted_video($id);
                echo json_encode($data);
                exit;
            }else{
                echo json_encode(array('msg'=>false));
                exit;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete_promoted($id){
         if($this->input->is_ajax_request())
         {   
            if(is_numeric($id))
            {
                $data = $this->Home_model->delete_promoted_video($id);
                echo json_encode($data);
            }
            else
            {
                echo json_encode(array('msg'=>'Access Denied','status'=>false));
            }
        }
        else
        {
            echo json_encode(array('msg'=>'Access Denied','status'=>false));
        }
    }
    public function delete_promoted_video_by_id()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                if(is_numeric($id)){
                    $data = $this->Home_model->delete_promoted_video($id);
                    echo json_encode($data);
                }else{
                    echo json_encode(array('msg'=>'Access Denied'));
                }
            }else{
                echo json_encode(array('msg'=>'Access Denied'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function change_status_promoted($id,$status){
        $where=array('idvic_promoted_video'=>$id);
        $data=array('vic_promoted_video_is_active'=>$status);

        $result=$this->Home_model->update_promoted_video($where,$data);
        echo $result;
    }

    //advertisement video

    public function get_advertisement_by_id()
    {
        try {
            $data['id'] = $this->uri->segment(6);
            $res=$this->Home_model->advertisment_by_id($data);
            $data['content'] = $res;
            $where_cluase=array('vic_advertisment_is_active'=>'active');
            if(isset($res[0]->vic_advertisment_ads_page) && $res[0]->vic_advertisment_ads_page!=''){
                $where_cluase['vic_advertisment_ads_page']=$res[0]->vic_advertisment_ads_page;
            }

            $result=$this->Home_model->getPosition_numbers('vic_advertisment','vic_advertisment_ads_position',$where_cluase);
            $num_arr=array();
            if(isset($result) && !empty($result)){
                foreach ($result as $key => $value) {
                    $num_arr[]=$value->number;

                }
            }

         
            $data['position']=$num_arr;

            $data['activePage'] = "Update Advertisements";
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu' , $data);
            $this->load->view('admin/contentmanagement/addEditAdvertisements', $data);
        } catch (\Throwable $th) {
            throw $th;
        }         
    }

    public function publish_save_advertisement()
    {
        try {
            $this->form_validation->set_rules('cname', 'Company Name', 'required');
            $this->form_validation->set_rules('adspage', 'ADS Page', 'required');
            $this->form_validation->set_rules('adsposition', 'ADS Position', 'required');
            $this->form_validation->set_rules('adsurl', 'ADS URL', 'required');
            $this->form_validation->set_rules('adsFrom', 'Duration Form', 'required');
            $this->form_validation->set_rules('adsTo', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_advertisment_company_name'] = trim( $form_data['cname'] );
                $column['vic_advertisment_ads_page'] = trim( $form_data['adspage'] );
                $column['vic_advertisment_ads_position'] = trim( $form_data['adsposition'] );
                $column['vic_advertisment_ads_url'] = trim( $form_data['adsurl'] );
                $column['vic_advertisment_date_from'] = date('Y-m-d',strtotime($form_data['adsFrom']));
                $column['vic_advertisment_date_to'] =date('Y-m-d',strtotime($form_data['adsTo']));
                $column['vic_advertisment_is_active'] = (isset($form_data['status'])) ? 'active' : 'inactive' ;

                if(($this->session->userdata('usertype') == 'super admin') || ($this->session->userdata('usertype') == 'publisher - moderator')){
                    $column['vic_advertisment_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_advertisment_status'] = 'Published';
                }else{
                    $column['vic_advertisment_status'] = 'Under Review';
                }
                $column['vic_advertisment_created_on'] = date('Y-m-d H:i:s');
                $column['vic_advertisment_is_active'] = 'active';

                $result = $this->umodel->do_upload('uploadAttachment', 'jpg|png|jpeg', 'advertisment');

                if ($result['error']) {
                    echo json_encode($result);
                    exit;
                }
                if (!$result['error']) {
                    $column['vic_advertisment_img_path'] = $result['file_path'];
                }

                $result = $this->db->insert('vic_advertisment', $column);
                if( $result == true ){
                    $data = (array('status' => 'added'));
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_advertisment()
    {
        try {
            $this->form_validation->set_rules('cname', 'Company Name', 'required');
            $this->form_validation->set_rules('adspage', 'ADS Page', 'required');
            $this->form_validation->set_rules('adsposition', 'ADS Position', 'required');
            $this->form_validation->set_rules('adsurl', 'ADS URL', 'required');
            $this->form_validation->set_rules('adsFrom', 'Duration Form', 'required');
            $this->form_validation->set_rules('adsTo', 'Duration To', 'required');
    
            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $column['vic_advertisment_company_name'] = trim( $form_data['cname'] );
                $column['vic_advertisment_ads_page'] = trim( $form_data['adspage'] );
                $column['vic_advertisment_ads_position'] = trim( $form_data['adsposition'] );
                $column['vic_advertisment_ads_url'] = trim( $form_data['adsurl'] );
                $column['vic_advertisment_date_from'] = date('Y-m-d',strtotime($form_data['adsFrom']));
                $column['vic_advertisment_date_to'] = date('Y-m-d',strtotime($form_data['adsTo']));
                $column['vic_advertisment_is_active'] = (isset($form_data['status'])) ? 'active' : 'inactive' ;

                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_advertisment_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_advertisment_status'] = 'Published';
                }else{
                    $column['vic_advertisment_status'] = 'Under Review';
                }
                $column['vic_advertisment_created_on'] = date('Y-m-d H:i:s');

                $column['vic_advertisment_is_active'] =(isset($form_data['status']))? 'active' : 'inactive' ;

                $result = $this->umodel->do_upload('uploadAttachment', 'jpg|png|jpeg', 'advertisment');
                
                if (!$result['error']) {
                    $column['vic_advertisment_img_path'] = $result['file_path'];
                }

                $result = $this->Home_model->update_advertisment(array('idvic_advertisment' => $form_data['idvic_advertisment']) , $column);
                
                if( $result == true ){
                    $data = (array('status' => 'updated'));
                }else if ($result == false){
                    $data = (array('status' => 'failed'));
                }else{
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject_advertisement_by_id()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                $data = $this->Home_model->reject_advertisment($id);
                echo json_encode($data);
            }else{
                echo json_encode(array('msg'=>false));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete_advertisement_by_id(){
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                if(is_numeric($id)){
                    $data = $this->Home_model->delete_advertisment($id);
                    echo json_encode($data);
                }else{
                    echo json_encode(array('msg'=>'Access Denied'));
                }
            }else{
                echo json_encode(array('msg'=>'Access Denied'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
  public function latestNews_json_list(){
    
    $list=$this->Home_model->datatable_list($_POST);
    echo $list;
  }
  public function get_advertjson_list()
  {
       $result=$this->Home_model->get_advert_list($_POST);
       echo $result; 
  }
  public function update_status_promoted_vid($id,$status){

        $where=array('idvic_promoted_video'=>$id);
        $data=array('vic_promoted_video_is_active'=>$status);

        $result=$this->Home_model->update_promoted_status($data,$where);
        echo json_encode($result);
  }
  public function change_status_adv($id,$status){
    $where=array('idvic_advertisment'=>$id);
        $data=array('vic_advertisment_is_active'=>$status);

        $result=$this->Home_model->update_adv_status($data,$where);
        echo json_encode($result);
  }
  public function search_list(){
    if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']=='interview'){
        $result=$this->Home_model->data_search($_POST);
    }
    if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']=='virtual'){
        $result=$this->Home_model->virtual_search($_POST);
    }
    if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']=='slider'){
        $result=$this->Home_model->banner_search($_POST);
    }
    if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']=='banner'){
        $result=$this->Home_model->banner_search($_POST);
    }
    if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']=='promoted_video'){
        $result=$this->Home_model->prom_video_search($_POST);
    }
    if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']=='adv_video'){
        $result=$this->Home_model->adv_video_search($_POST);
    }
  
    
    echo json_encode($result);
  }
  
} 
