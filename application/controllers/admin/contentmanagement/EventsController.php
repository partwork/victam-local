<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/admin/config/AdminController.php';

class EventsController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/Events_model','event');     
        $this->load->model('Event_model','events');     
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/others/Notification_model');   
        $this->load->model('SES_model');

    }
    public function events()
    {  
        // $event_list=$this->event->getEventList();
        // $data['event_list']=(!empty($event_list))? $event_list : NULL; 

        $data['activePage'] = "events";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/events/events', $data);
    }
    public function addEvents()
    {
        $sector_list=$this->event->getSectorList();
        $data['sector_list']=(!empty($sector_list))? $sector_list : NULL;
        $data['user_type']='';
        $data['activePage'] = "Add Events";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/events/addEvents', $data);
    }
    public function edit_events($id){
        
        $sector_list=$this->event->getSectorList();
        $data['sector_list']=(!empty($sector_list))? $sector_list : NULL;

        $where=array('idvic_events'=>$id);
        $result=$this->event->getEventList($where);
        
        
        $result=(!empty($result[0]))? $result[0] : NULL;
        $user_role=$this->getUserplanid($result->vic_company_idvic_company);
        
        $data['user_type']=($user_role)? $user_role : 0;

        $data['event_data']=$result;

        /*$online_event_type=array('meeting','virtual exhibition','Webinar');
        $offline_event_type=array('Conference','Exhibition','seminars');
        $data['online_event_type']=$online_event_type;
        $data['offline_event_type']=$offline_event_type;*/

        $data['activePage'] = "Edit Event";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/events/addEvents', $data);
    }
    public function add_event(){
       if($this->input->is_ajax_request())
       {  
         $userID = $this->session->userdata('userId');
         if($userID == NULL)
         {
            echo json_encode('Login User Not Found');
            exit;
         }

        $user_type=(isset($_POST['user_type']))? $_POST['user_type']:NULL; 

        $eventData=array();
        $this->form_validation->set_rules('eventType', 'Event Type', 'required'); 
        $this->form_validation->set_rules('organizer', 'Organizer', 'required'); 
        //$this->form_validation->set_rules('cName', 'Company Name', 'required'); 
        $this->form_validation->set_rules('sector', 'Sector', 'required'); 
        //$this->form_validation->set_rules('evn_name', 'Name', 'required'); 
        $this->form_validation->set_rules('title', 'Title', 'required'); 

        $this->form_validation->set_rules('eventFrom', 'From Date', 'required'); 
        $this->form_validation->set_rules('eventTo', 'To Date', 'required');
        
        
        $this->form_validation->set_rules('date', 'Date', 'required');
        $eventId = $this->input->post('id');
        if ($user_type == 3 || $user_type == 2 || $eventId == "") {
            //if eventtype is Online
            if($this->input->post('eventCategory') == 'Online'){
                $this->form_validation->set_rules('registrationURL', 'Registration URL', 'required|valid_url'); 
                $this->form_validation->set_rules('evn_url', 'Website URL', 'required|valid_url');

            }else
            {
                //if event tyepe is offline
                $this->form_validation->set_rules('evn_venue', 'Venue', 'required'); 
            }
            $this->form_validation->set_rules('evn_desc', 'Description', 'required'); 
            $this->form_validation->set_rules('eventTime', 'Event Time', 'required');
        }


        if(($this->form_validation->run() == true) && ($userID != NULL)){

            
                if(!empty($_FILES['uploadLogo']["name"])){
                    $config['upload_path'] = 'upload/event/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = time().$_FILES['uploadLogo']["name"];
                    
                    $this->upload->initialize($config); 
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('uploadLogo')) {
                        $error = $this->upload->display_errors();
                        echo json_encode(array('status'=>'fail','msg'=>'Logo'.$error));
                        exit;
                    } else {
                        $uploadData = $this->upload->data();
                        $uploadLogo = $uploadData['file_name'];
                        $eventData['vic_logo']=$uploadLogo;
                    }
                }


                if(!empty($_FILES['uploadBanners']['name'][0])){
                   $uploadBanners = $this->upload_images('uploadBanners');
                   if(is_array($uploadBanners) && $uploadBanners['status']=='fail'){
                    echo json_encode(array('status'=>'fail','msg'=>'Banners'.$uploadBanners['msg']));
                    exit;
                   }
                   else{
                     $eventData['vic_banners']=$uploadBanners; 
                   }
                   
                }

                if(!empty($_FILES['uploadAdvertisement']['name'][0])){

                    $uploadAdvertisement = $this->upload_images('uploadAdvertisement'); 
                    if(is_array($uploadAdvertisement) && $uploadAdvertisement['status']=='fail'){
                        echo json_encode(array('status'=>'fail','msg'=>'Advertisement'.$uploadAdvertisement['msg']));
                        exit;
                    }
                    else{
                      $eventData['vic_advertisement']=$uploadAdvertisement;                 
                    }
                    
                }

                if(!empty($_FILES['uploadPhotos']['name'][0])){

                    $uploadPhotos = $this->upload_images('uploadPhotos');
                    if(is_array($uploadPhotos) && $uploadPhotos['status']=='fail'){
                        echo json_encode(array('status'=>'fail','msg'=>'Photos'.$uploadPhotos['msg']));
                        exit;
                    }
                    else{
                        $eventData['vic_photos']=$uploadPhotos;    
                    }
                    
                }
                

                if(isset($_FILES['uploadReport']) && $_FILES['uploadReport']['name'][0]!=''){

                    $uploadReport = $this->upload_report('uploadReport');
                    if(is_array($uploadReport) && $uploadReport['status']=='fail'){
                        print_r($uploadReport);
                        echo json_encode(array('status'=>'fail','msg'=>'Report'.$uploadReport['msg']));
                        exit;
                    }
                    else
                    {
                        $eventData['vic_conclusion_report']=$uploadReport;    
                    }
                    
                }
                 
                 if(!empty($_FILES['uploadVideo']['name'][0])){
                    $uploadVideo = $this->upload_video('uploadVideo');
                    if(is_array($uploadVideo) && $uploadVideo['status']=='fail'){
                        echo json_encode(array('status'=>'fail','msg'=>'Video'.$uploadVideo['msg']));
                        exit;
                    }
                    else
                    {
                       $eventData['vic_video']=$uploadVideo; 
                    }
                    
                }

             
            

            //$eventData['vic_eventname']=$this->input->post('evn_name');
            $eventData['vic_eventtype']=$this->input->post('eventType');
            $eventData['vic_organizer']=$this->input->post('organizer');

            if($eventId == "" && ($this->session->userdata('usertype') == 'super admin') || ($this->session->userdata('usertype') == 'publisher - moderator') || ($this->session->userdata('usertype') == 'content moderator')){
                $eventData['vic_company_idvic_company']=2;
            }
            $eventData['vic_sector_id']=$this->input->post('sector');
            $eventData['vic_eventtitle']=$this->input->post('title');
            
            $eventData['vic_eventstartdate']=date('Y-m-d',strtotime($this->input->post('eventFrom')));
            $eventData['vic_eventenddate']=date('Y-m-d',strtotime($this->input->post('eventTo')));
            $eventData['vic_eventfrequency']=$this->input->post('frequency');
            
            $eventData['vic_eventdesc']=$this->input->post('evn_desc');
            $eventData['vic_created_at']=date('Y-m-d H:i:s');

            if ($user_type == 3 || $user_type == 2 || $eventId == "") {
            $eventData['vic_eventtime']=date('H:i',strtotime($this->input->post('eventTime')));
            }
            $eventData['vic_eventvenue']=$this->input->post('evn_venue');
            $eventData['vic_registration_url']=$this->input->post('registrationURL');
            $eventData['vic_event_website_url']=$this->input->post('evn_url');
            $eventData['vic_date']=date('Y-m-d',strtotime($this->input->post('date')));
            $eventData['vic_modification_at']=date('Y-m-d H:i:s');
            if($this->session->userdata('usertype') == 'super admin'){
                    $eventData['vic_modification_status']='Published';
            }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                $eventData['vic_modification_status']='Published';
            }else{
                $eventData['vic_modification_status']='Under Review';
            }

            $id=$this->input->post('id');
            $success="";
            $error="";
            if($id){
                if(($this->session->userdata('usertype') == 'super admin') OR ($this->session->userdata('usertype') == 'publisher - moderator')){
                    $where=array('idvic_events'=>$id);
                    $event=$this->event->getEventList($where);
                    //if event added by admin
                    if(!empty($event[0]) && $event[0]->vic_user_id==NULL){
                        $eventData['vic_eventtime']=date('H:i',strtotime($this->input->post('eventTime')));
                    }
                    $res = $this->events->get_user_id_by_event_id($id);
                    if($res != false){
                        $userid = $res['0']->vic_user_id;
                        if($userid != NULL){
                            $preparemail = $this->events->get_email_by_user_id($userid);
                        }else{
                            $preparemail = $this->events->get_email_by_company_id($event[0]->vic_company_idvic_company);
                            
                        }
                        if(!empty($preparemail[0])) {
                            $email = $preparemail['0']->user_email;
                            $ename = $this->input->post('title');
                            $content = 'Your Event '.$ename.' Updated successfully on the Victam portal';
                            $aws = $this->SES_model->sharedmail($email, $content);
                        }
                    } 
                }
               $where=array('idvic_events'=>$id); 
               $result = $this->event->updateData($eventData,$where);     
               $this->send_notification($eventData['vic_organizer'],'update');

               $success='Update';
               $error='Update';
            }
            else
            {
                $result = $this->event->addData($eventData);
                $this->send_notification($eventData['vic_organizer'],'create');

               $success='Add';
               $error='Add';
            }
            
            
            if($result){
                $msg = array('status'=>'success','msg'=>'Event '.$success.' successfully.'); 
            }else{
                $msg =array('status'=>'error','msg'=>' Failed to '.$error.' event.');
            }
            //$this->session->set_flashdata('error',$msg);
            echo json_encode($msg);
        }
        else
        { 
            $error = validation_errors(); 
            //$this->session->set_flashdata('error',$error);
            echo json_encode(array('status'=>'error','msg'=>$error));
        }
       }
       else
       {
        exit('No direct script access allowed');
       } 
    }
    public function upload_images($input_name){
        $name_array = array();
        $count = count($_FILES[$input_name]['size']);
       
        // if($count > 1){
            for($s=0; $s<=$count-1; $s++) {

                $_FILES['image']['name']= $_FILES[$input_name]['name'][$s];
                $_FILES['image']['type']    =  $_FILES[$input_name]['type'][$s];
                $_FILES['image']['tmp_name'] =  $_FILES[$input_name]['tmp_name'][$s];
                $_FILES['image']['error']       =  $_FILES[$input_name]['error'][$s];
                $_FILES['image']['size']    =  $_FILES[$input_name]['size'][$s];   
                
                $config['upload_path'] = 'upload/event/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $new_name = time().$_FILES['image']['name'];
                $config['file_name'] = $new_name;
                 // $config['max_size'] = '100';
                // $config['max_width']  = '1024';
                // $config['max_height']  = '768';
                
                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('flash_error',$input_name.$error);
                    return $error;
                    // redirect('events/add-event');
                } else {
                    $uploadData = $this->upload->data();
                    $name_array[] = $uploadData['file_name'];
                }
            }
            $names= implode(',', $name_array);
            return $names;
    }
    public function upload_report($input_name){
        $config1['upload_path'] = 'upload/event/report/';
        $config1['allowed_types'] = 'doc|ppt|docx|xls|xlsx|pdf';

        if(isset($_FILES[$input_name]) && is_array($_FILES[$input_name]['name'])){
            $image_path = array();          
            $count = count($_FILES[$input_name]['name']);   
            for($key =0; $key <$count; $key++){     
                $_FILES['file']['name']     = $_FILES[$input_name]['name'][$key]; 
                $_FILES['file']['type']     = $_FILES[$input_name]['type'][$key]; 
                $_FILES['file']['tmp_name'] = $_FILES[$input_name]['tmp_name'][$key]; 
                $_FILES['file']['error']     = $_FILES[$input_name]['error'][$key]; 
                $_FILES['file']['size']     = $_FILES[$input_name]['size'][$key]; 
                    
                $config1['file_name'] = $_FILES[$input_name]['name'][$key];
            
                $this->upload->initialize($config1);
                $this->load->library('upload', $config1);
            
                
                if($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $image_path[$key] = $data['file_name'];                  
                }else{
                    $error =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',"image upload! ".$error);
                    return $error;
                    // redirect('events/add-event');
                }   
            }
            return implode(',',$image_path);
        }
    }
    public function upload_video($input_name){

        $name_array = array();
        $count = count($_FILES[$input_name]['size']);
        
        for($s=0; $s<=$count-1; $s++) {
            
                $_FILES['video']['name']= $_FILES[$input_name]['name'][$s];
                $_FILES['video']['type']    =  $_FILES[$input_name]['type'][$s];
                $_FILES['video']['tmp_name'] =  $_FILES[$input_name]['tmp_name'][$s];
                $_FILES['video']['error']       =  $_FILES[$input_name]['error'][$s];
                $_FILES['video']['size']    =  $_FILES[$input_name]['size'][$s];   
                
                $config['upload_path'] = 'upload/event/video/';
                $config['allowed_types'] = 'mp4';
                // $config['max_size'] = '100';
                // $config['max_width']  = '1024';
                // $config['max_height']  = '768';
                
                $new_name = time().$_FILES['video']['name'];
                $config['file_name'] = $new_name;
                
                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('video')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error',$error);
                    return $error;
                    // redirect('events/add-event');
                    exit;
                } else {
                    $uploadData = $this->upload->data();
                    $name_array[] = $uploadData['file_name'];
                    
                }

        }
        $names= implode(',', $name_array);
        return $names;
    }
    public function delete_events(){
        $id=$this->input->post('id');
        $result=$this->event->delete_data($id);
        echo json_encode($result);
    }
    public function reject_data($id){
       if ($this->input->is_ajax_request()){ 
        $where=array('idvic_events'=>$id);
        $data=array('vic_modification_status'=>'Rejected');
        $result=$this->event->updateData($data,$where);

        $where=array('idvic_events'=>$id);
        $result=$this->event->getEventList($where);
        $this->send_notification($result[0]->vic_organizer,'reject');

        $id = $result['0']->vic_user_id;
        if($id){
            $email = $this->events->get_mail_by_event_id($id);
            $eventname = $result['0']->vic_eventtitle;
            $this->SES_model->reject_event_shared($email['0']->user_email, $eventname);
        }
        echo json_encode($result);

    }
       else{
         exit('No direct script access allowed');
       } 
    }
    public function get_json_list(){
       $result=$this->event->datatable_list($_POST);
        $res = json_decode($result);
        foreach($res->data as $d){
            if($d->vic_eventtime != null || $d->vic_eventtime !=""){
                $d->vic_eventtime = date('H:i',strtotime($d->vic_eventtime));
            }
        }
        echo json_encode($res);
    }
    public function getUserplanid($company_id){
        $user_detail_id=$this->db->select('vic_users_iduser_details as id')->from('vic_user_details')
        ->where('vic_company_idvic_company',$company_id)->get()->row();
        if(isset($user_detail_id->id)){
            $sql = 'select fk_plan_id from vic_stripe_orders as t1 JOIN vic_pricing_plans as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id = "'.$user_detail_id->id.'" and t2.vic_pricing_plan_type is NULL and vic_stripe_orders_status = "live" and date(vic_stripe_orders_plan_end_dt) >= DATE(CURRENT_DATE()) order by idvic_stripe_orders desc limit 1';
            $result_set = $this->db->query($sql);    

            if(isset($result_set->row()->fk_plan_id))
            {
              return $result_set->row()->fk_plan_id;      
            }
            else{
                return false;
            }
        }
        else
        {
            return false;
        }
        
    }
    public function send_notification($organizer,$action){
        $userID = $this->session->userdata('userId');
        //notification
        $adminlist = $this->Notification_model->notify_user_list($userID);
        $output = $this->Notification_model->get_user_name($userID);
        
        $val['vic_user_id_sender'] = $userID;
        $val['vic_created_on'] = date('Y-m-d H:i:s');

        switch ($action) {
            case 'create':
                $val['vic_title'] = 'The events details for the '.$organizer.' published successfully on the portal';
                break;
            case 'update':
                if($output)
                    $val['vic_title'] = 'The events details for the '.$organizer.' are modified by the '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname;
                else
                    $val['vic_title'] = 'The events details for the '.$organizer.' are modified by the user';
                break;
            case 'reject':
                $val['vic_title'] = 'The events details for the '.$organizer.' rejected due to a policy violation.';
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
