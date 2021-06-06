<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/admin/config/AdminController.php';

class VirtualEntertainmentController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/VirtualEntertainment_model','virtual');     
        $this->load->model('File_upload_model', 'umodel');
        

    }
    public function video()
    {
        $data['activePage'] = "video";
        $where=array('vic_promoted_type'=>'virtual');
 
        
        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/virtual-entertainment/video/pagination";

        $config["total_rows"] = $this->virtual->count_virtual_video($where);
        //$config["per_page"] = 8;
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
        $config['prev_tag_open'] = '<li  class="pg-prev page-item prev-page">'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['first_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li class="page-item banner-pagination">'; 
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0; 
        $data["list"] = $this->virtual->get_virtual_video($config["per_page"], $page,$where);
        $data["links"] = $this->pagination->create_links();
        
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/virtual-entertainment/video', $data);
    }
    public function addVideo()
    {
        $data['activePage'] = "Add Video";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/virtual-entertainment/addVideo', $data);
    }
    public function edit_video($id){
        $where=array('idvic_promoted_video'=>$id);
        $vdata=$this->virtual->getVideoList($where);

        $data['video_data']=(!empty($vdata[0]))? $vdata[0] : NULL;
        $data['activePage'] = "Edit Video";  
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/virtual-entertainment/addVideo', $data);

    }
    public function storeVideo(){

         $userID = $this->session->userdata('userId');
        if($userID == NULL){
            redirect('login');
        }

        $this->form_validation->set_rules('vname', 'Video name', 'required'); 
        $this->form_validation->set_rules('vdesc', 'Video Description', 'required'); 
        $this->form_validation->set_rules('vdate', 'Video Date', 'required'); 
        //$this->form_validation->set_rules('vfile', 'Video File', 'required'); 

        if(($this->form_validation->run() == true) && ($userID != NULL)){

            $name=$this->input->post('vname');
            $desc=$this->input->post('vdesc');
            $date=$this->input->post('vdate');
            $file=$this->input->post('vfile');
            $id=$this->input->post('id');

            $data['vic_promoted_video_title']=$name;
            $data['vic_promoted_video_position']=$desc;
            $data['vic_promoted_video_url']=$file;
            $data['vic_promoted_video_is_active']='active';
            

            if($this->session->userdata('usertype') == 'super admin'){
                $data['vic_promoted_video_status'] = 'Published';
            }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                $data['vic_promoted_video_status'] = 'Published';
            }else{
                $data['vic_promoted_video_status'] = 'Under Review';
            }
            $data['vic_promoted_type']='virtual';
            
            $data['vic_created_at']=date('Y-m-d H:i:s');
            
            if($id!='')
            {
               $where=array('idvic_promoted_video'=>$id);
               $result=$this->virtual->update_data($data,$where);   
               $success='Update';
               $error='Add';  
            }
            else
            {
                $result=$this->virtual->store_data($data);
                $success='Update';
                $error='Add';
            }
            if($result)
            {
                $msg = 'Video '.$success.' successfully.'; 
            }
            else
            {
                $msg =' Failed to '.$error.' event.';
            }
            echo json_encode(array('status'=>$msg));
        }
        else
        { 
            $error = validation_errors(); 
            $this->session->set_flashdata('error',$error);
            echo json_encode(array('status'=>$error));
        }
    }
    public function reject_video($id){
        if ($this->input->is_ajax_request())
        {

           $where=array('idvic_promoted_video'=>$id);
            $data['vic_promoted_video_status']='Rejected';
            $data['vic_promoted_video_is_active']='inactive';
            $result=$this->virtual->update_data($data,$where);
            echo $result;    
        }
        else
        {
            exit('No direct script access allowed');
        }
        
    }
    public function change_status(){
        $id=$this->input->post('id');

        $vdata=$this->virtual->getVideoList(array('idvic_promoted_video'=>$id));
        $status='inactive';
        if(!empty($vdata[0])){
           $status=($vdata[0]->vic_promoted_video_is_active=='active')? 'inactive' : 'active'; 
        }
        $where=array('idvic_promoted_video'=>$id);
        $data['vic_promoted_video_is_active']=$status;
        $result=$this->virtual->update_data($data,$where);
        if($result){
            echo json_encode('Video '.$status.' successfully');
        }
        else{
            echo json_encode('Video '.$status.' unsuccessfully');
        }
    }
    public function delete_video(){
        $id=$this->input->post('id');
        $result=$this->virtual->delete_video($id);
        echo json_encode($result);
        /*$where=array('idvic_promoted_video'=>$id);
        $data['vic_promoted_video_is_active']='inactive';
        $result=$this->virtual->update_data($data,$where);
        echo json_encode($result);*/
    }
    public function json_list(){

       $result=$this->virtual->tbl_object($_POST);  
       echo $result;
    }
    public function search_list(){

       $result=$this->virtual->data_search($_POST);  
       echo json_encode($result);
    }
}
