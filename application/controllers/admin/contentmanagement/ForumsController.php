<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class ForumsController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/Forums_model','forum');     
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/contentmanagement/Home_model');     
        $this->load->model('admin/others/Notification_model');   

    }
    public function forums()
    {   
        // $list=$this->forum->getForumsList();
        // $data['forum_list']=(!empty($list))? $list: NULL;

        $data['activePage'] = "forums";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/forums/forums-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/forums/forums', $data);
    }
    public function addForums()
    {
        $data['activePage'] = "Add Forums";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/forums/forums-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/forums/addForums', $data);
    }
    public function storeForum(){
       if ($this->input->is_ajax_request())
        {
            $fname=$this->input->post('fname');
            $sector=$this->input->post('sector');
            $response=trim($this->input->post('response'));
            $date=$this->input->post('date');
            $id=$this->input->post('id');

            $user_id=$this->session->userdata('userId');

            $this->form_validation->set_rules('fname', 'Forum Name', 'required');
            $this->form_validation->set_rules('sector', 'Sector', 'required');
            $this->form_validation->set_rules('response', 'Response', 'required');
            

            if ($this->form_validation->run() == FALSE){
                echo validation_errors();
                exit;
            }

            $column['vic_forumname']=$fname;
            $column['vic_forumsectorname']=$sector;
            $column['vic_forumdescription']=$response;
            $column['vic_created_at']=date('Y-m-d H:i:s');
            $column['vic_forum_modification_dt']=date('Y-m-d H:i:s');

            $column['vic_forum_userid']=$user_id;

            if($this->session->userdata('usertype') == 'super admin'){
                $column['vic_modification_status']='Published';
            }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                $column['vic_modification_status']='Published';
            }else{
                $column['vic_modification_status'] = 'Under Review';
            }
            
            

            $msg=array();
            if($id!=''){
                unset($column['vic_forum_userid']);
                //$column['vic_forum_modification_dt']=date('Y-m-d H:i:s');
                $msg=array('status'=>'success','msg'=>'Update successfull');
                $where=array('idvic_forum'=>$id);
                $result= $this->forum->update_data($column,$where);
                $this->send_notification('update');
            }
            else
            {
                $msg=array('status'=>'success','msg'=>'Add successfull');
                $result= $this->forum->store_data($column);
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
    public function edit_forums($id){
        

        $form_data=$this->forum->getForumsList(array('idvic_forum'=>$id));

        if(!empty($form_data[0])){

            $data['fdata']=$form_data[0];
            $data['activePage'] = "Edit Forums";

            $sector_data = $this->forum->getSector();
            $data['sector_list'] = $sector_data;

            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/forums/forums-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/forums/addForums',$data);      
        }
        else
        {
            echo '<h4>Data Not Found</h4>';
        }
        
                
    }
    public function delete_forums($id){
        $result=$this->forum->delete_data($id);
        echo json_encode($result);
        
    }
    public function reject_forums($id){
        if ($this->input->is_ajax_request())
        {
            $where=array('idvic_forum'=>$id);
            $data=array('vic_modification_status'=>'Rejected');
            $result=$this->forum->update_data($data,$where);
            echo json_encode($result);
        }
        else
        {
            exit('No direct script access allowed');
        }
    }
   public function get_json_list()
   {
       $result=$this->forum->datatable_list($_POST);
       echo $result; 
   }
   public function send_notification($action){
        $userID = $this->session->userdata('userId');
        //notification
        $adminlist = $this->Notification_model->notify_user_list($userID);
        $output = $this->Notification_model->get_user_name($userID);
        
        $val['vic_user_id_sender'] = $userID;
        $val['vic_created_on'] = date('Y-m-d H:i:s');

        switch ($action) {
            case 'create':
                $val['vic_title'] = '';
                break;
            case 'update':
                if($output)
                    $val['vic_title'] = 'Forum content modified by the '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname;
                else
                    $val['vic_title'] = 'Forum content modified by the user';
                break;
            default:
                $val['vic_title'] = '';
                break;
        }
        
        $insert_notification_batch = array();
        foreach($adminlist as $li){
            
            $val['vic_user_id_receiver'] = $li->iduser_details;
            array_push($insert_notification_batch,$val);   
        }
        
        $this->Notification_model->insert_notify_batch($insert_notification_batch);
    }
}
