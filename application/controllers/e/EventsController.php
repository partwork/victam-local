<?php defined('BASEPATH') OR exit('No direct script access allowed');

include 'config/IsRegisteredController.php';

class EventsController extends IsRegisteredController {

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('home_model'); 
        $this->load->model('event_model');
        $this->load->model('company');
        $this->load->model('user');
        $this->isUserRegistered = $this->session->userdata('isUserRegistered'); 
        $this->finalArr = array();
        $this->userID = $this->session->userdata('userId');
        $this->load->model('admin/others/Notification_model');   
        
    }

    public function load_online_events_view(){
        if (!($this->userID)) {
            redirect('register');
        } else {
        $data['company_logo'] = $this->home_model->get_active_banner();
        $data['activePage'] = "events";
        $result = $this->event_model->get_online_event();
        $currentTime=date("H:i");
        $endTime = date("H:i",strtotime('+1 hour')); 
        $eventArr =  array();
        foreach($result as $d){
            $eventTime = date("H:i",strtotime("+30 minutes", strtotime($d->vic_eventtime)));
            if($eventTime >= $currentTime && $eventTime <= $endTime){
                $eventArr[] = $d;
            }
        }
        $data['events'] = $eventArr;
        $data['upcoming_events'] = $this->event_model->get_online_upcoming_event();
        
        $this->load->view('css_js_helpers');
        $this->load->view('events/e_css_js_helpers');
        $this->load->view('events/online_events', $data);
        }
    }

    public function load_onsite_events_view(){
        if ( !($this->userID)) {
            redirect('register');
        } else {
        $data['company_logo'] = $this->home_model->get_active_banner();
        $data['activePage'] = "events";
        
        $data['upcoming_events'] = $this->event_model->get_onsite_upcoming_event();
        $result = $this->event_model->get_onsite_event();
        $currentTime=date("H:i");
        $endTime = date("H:i",strtotime('+1 hour')); 
        $eventArr =  array();
        foreach($result as $d){
            $eventTime = date("H:i",strtotime("+30 minutes", strtotime($d->vic_eventtime)));
            if($eventTime >= $currentTime && $eventTime <= $endTime){
                $eventArr[] = $d;
            }
        }
        $data['events'] = $eventArr;

        $this->load->view('css_js_helpers');
        $this->load->view('events/e_css_js_helpers');
        $this->load->view('events/onsite_events', $data);
        }
    }

    public function load_video_gallery_view(){
        if (!$this->userID) {
            redirect('register');
        } else {
            $eventID = $this->uri->segment(3);
        
            if(is_numeric($eventID)){
                $data['event'] = $this->event_model->get_event_info($eventID);
                $data['evntId'] = $eventID;
            }
            $data['activePage'] = "events";
            $this->load->view('css_js_helpers');
            $this->load->view('events/e_css_js_helpers');
            $this->load->view('events/video_gallery', $data);
        }
    }

    public function load_photo_gallery_view(){
        if (!$this->userID) {
            redirect('register');
        } else {
            $eventID = $this->uri->segment(3);
        
            if(is_numeric($eventID)){
                $data['event'] = $this->event_model->get_event_info($eventID);
                $data['evntId'] = $eventID;
            }
            $data['activePage'] = "events";

            $this->load->view('css_js_helpers');
            $this->load->view('events/e_css_js_helpers');
            $this->load->view('events/photo_gallery', $data);
        }
    }

    public function load_add_event_view(){
        if (!$this->userID) {
            redirect('register');
        } else {
        $data['activePage'] = "events";
        $data['sectors'] = $this->event_model->getSectorList();
        $this->load->view('css_js_helpers');
        $this->load->view('events/e_css_js_helpers');
        $this->load->view('events/add_event', $data);
        }
    }

    public function load_calender_event_view(){
        // if ( $this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
        //     redirect('register');
        // }
        if($this->userID){
        $sector = $this->uri->segment(3);
        $search =  $this->uri->segment(4);
        $type = $this->uri->segment(5);
        $date = date('Y-m-d');

        $data['activePage'] = "events";
        $data['events'] = $this->event_model->get_events_list($sector,$search,$type,$date);
        $data['sectors'] = $this->event_model->getSectorList();

        $data['findSector'] = str_replace("-"," ",$sector) ;
        $data['search'] = $search;
        $data['type'] = $type;
        $this->load->view('css_js_helpers');
        $this->load->view('events/e_css_js_helpers');
        $this->load->view('events/calender-event', $data);
        }else{
            redirect('register');
        }
    }

    public function events_filter(){
        try {
            if ($this->input->is_ajax_request()) {
                $sector = $this->input->post('sector');
                $search = $this->input->post('search');
                $type = $this->input->post('type');
                $date=$this->input->post('date');
                if($date != null && $date !="")
                    $eventDate=date('Y-m-d',strtotime($date));
                else
                    $eventDate=date('Y-m-d');

                $result = $this->event_model->get_events_list($sector,$search,$type,$eventDate);

                $design = $this->design($result,$eventDate);
                echo json_encode($design);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function design($events,$eventDate){
        $result = '';$month = array();
        
        foreach ($events as $k => $event) {
            if(date('Y-m-d', strtotime($event->vic_date)) >= date('Y-m-d', strtotime($eventDate)))
                $m = date('m', strtotime($event->vic_date));
            else
                $m = date('m', strtotime($eventDate));
            
            if (!in_array($m, $month)) {
                array_push($month, $m);
                if(date('Y-m-d', strtotime($event->vic_date)) >= date('Y-m-d', strtotime($eventDate))){
                    $monYear = date('F Y', strtotime($event->vic_date));
                }else{
                    $monYear = date('F Y', strtotime($eventDate));
                }
                $result .='<p class="mb-0 event-date mt-3">'.$monYear.'</p>';
            }
            if($event->vic_eventfrequency == 'Custom') 
                $dates = date('d M', strtotime($event->vic_eventstartdate)).' - '.date('d M', strtotime($event->vic_eventenddate)); 
            else
                $dates = date('d/m', strtotime($eventDate));

            if(strlen($event->vic_eventdesc) > 250){
                $str = substr($event->vic_eventdesc, 0, 250);
            }else{
                $str = $event->vic_eventdesc;
            }
            if($k==0) {
                $show="show";
                $expanded ='true';
            }else{
                $show="";
                $expanded ='';
            }  
            
            $result .='<div class="card mt-2 mb-2 event-card">
                <div id="januaryOne">
                    <div class="event-calender-info">
                        <a href="'.base_url().'events/event-details/'.$event->idvic_events.'" class="ongoing-event-title"> 
                        <span class="ongoing-event-date"><span class="ongoing-event-name">'.$dates.'</span> '.$event->vic_eventtitle.'</span> </a>
                        <span class="ongoing-event-time">'.$event->vic_eventtype .' Event | '. $event->vic_eventtime .'</span>
                        
                        <span class="plus-icon float-right" data-toggle="collapse" data-target="#collapse'.$k.'" aria-expanded="'.$expanded.'" aria-controls="collapse'. $k .'"> 
                        <i class="fa fa-plus plus-icon"></i>
                        <i class="fa fa-minus plus-icon"></i>
                        </span> 
                    </div>

                    <div id="collapse'.$k.'" class="collapse '.$show.'" aria-labelledby="januaryOne" data-parent="#accordion">
                        <div class="pl-3 pr-3 event-details f-14">
                            '.$str.'
                        </div>
                    </div>
                </div>
            </div>';
        }
        return $result;
    }

    public function load_contact_view(){
        if ($this->userID) {
                $eventID = $this->uri->segment(3);
                $event = $this->event_model->get_event_info($eventID);
                if(!empty($event) && $event->vic_company_idvic_company){
                    $data['company'] = $this->company->get_company_detail_by_id($event->vic_company_idvic_company);
                }
                $data['activePage'] = "events";
                $this->load->view('css_js_helpers');
                $this->load->view('events/e_css_js_helpers');
                $this->load->view('events/contact', $data);
        }else {
            redirect('register');
        }
    }

    public function load_conclusion_report_view(){
        if ( $this->userID ) {
            $eventID = $this->uri->segment(3);
            $report = $this->event_model->get_conclusion_report($eventID);
            if($report->vic_conclusion_report != null){
                $data['event'] = explode(',',$report->vic_conclusion_report);
            }
            else{
                $data['event'] = array();
            }
            $data['evntId'] = $eventID;
            $data['activePage'] = "events";
            $this->load->view('css_js_helpers');
            $this->load->view('events/e_css_js_helpers');
            $this->load->view('events/conclusion_report', $data);
        } else {
            redirect('pricing');
        }
    }

    public function load_logo_ads_banner_view(){
        if ( $this->userID ) {
            $eventID = $this->uri->segment(3);
            $data['event'] = $this->event_model->get_event_logo_ads_banner($eventID);
            $data['evntId'] = $eventID;
            $data['activePage'] = "events";
            $this->load->view('css_js_helpers');
            $this->load->view('events/e_css_js_helpers');
            $this->load->view('events/logo_ads_banner', $data);
        } else {
            redirect('pricing');
        }
    }

    public function load_event_details_view(){
        if (!$this->userID) {
            redirect('register');
        }else{
            $eventID = $this->uri->segment(3);
        
            if(is_numeric($eventID)){
                $data['event'] = $this->event_model->get_event_info($eventID);
                $data['evntId'] = $eventID;
                if($data['event']){
                    $data['activePage'] = "events";
                    $this->load->view('css_js_helpers');
                    $this->load->view('events/e_css_js_helpers');
                    $this->load->view('events/event_details', $data);
                }else{
                    redirect('events/calender-event');
                }
            }else{
                redirect('events/calender-event');
            }
        }
    }

    public function get_events_date(){
        $events = $this->event_model->get_event_date();
        $eventArr = array();
        $today = date('Y-m-d');
        
        foreach($events as $k=>$event){
            $startDate = $event->vic_eventstartdate;
            $endDate = $event->vic_eventenddate;

            $frequency = $event->vic_eventfrequency;
            $type = '';
            switch ($frequency) 
            {
                case 'Daily': $type = '+1 day'; break;
                case 'Weekly': $type = '+1 week'; break;
                case 'Monthly': $type = '+1 month'; break;
                case 'Annually': $type = '+1 year'; break;
                case 'Biennially': $type = '+6 month'; break;
                case 'Every 3 years': $type = '+3 year'; break;
                case 'Every 4 years': $type = '+4 year'; break;
            }
            if($type !=''){
                $data = $this->getEventDates($startDate,$endDate,$type);
            }else{
                $data = array(
                    'vic_eventstartdate' => $startDate,
                    'vic_eventenddate' => $endDate,
                );
                array_push($this->finalArr,$data);
            }
        }
        $data['event'] = $this->finalArr;
        echo json_encode($data);
    }
    public function getEventDates($startDate,$endDate,$type){
        $scheduled_date = $startDate;
        $eventArr = array(); $count=0;

        while(strtotime($scheduled_date) <= strtotime($endDate)) {
            $data = array(
                'vic_eventstartdate' => $scheduled_date,
                'vic_eventenddate' => $scheduled_date,
            );
            array_push($this->finalArr,$data);
            $scheduled_date = date ("Y-m-d", strtotime($type, strtotime($scheduled_date))); 
            $count++;
        }
    }
    public function get_events_by_date(){
        $eventDate = $this->input->post('event_date');
        $events = $this->event_model->get_event_by_date($eventDate);

    }
    function compareDate() {
        $startDate = strtotime($this->input->post('fromDate'));
        $endDate = strtotime($this->input->post('toDate'));
      
        if ($endDate >= $startDate)
          return True;
        else {
          $this->form_validation->set_message('compareDate', 'To Date should be greater than From Date.');
          return False;
        }
    }
    public function add_event(){

        $userID = $this->userID;
        if($userID == NULL){
            redirect('login');
        }
        $user = $this->user->user_details($userID);
        if(!empty($user) && $user->vic_company_idvic_company){
            $companyID = $user->vic_company_idvic_company;
        }
        
        if($companyID == NULL || $companyID == ""){
            //store data in session
            $eventData = array(
                'vic_eventtype'=>$this->input->post('eventType'),
                'vic_organizer'=>$this->input->post('cName'),
                'vic_sector_id'=>$this->input->post('sector'),
                'vic_eventtitle'=>$this->input->post('title'),
                'vic_eventstartdate'=>($this->input->post('fromDate')) ? date('Y-m-d',strtotime($this->input->post('fromDate'))) : NULL,
                'vic_eventenddate'=>($this->input->post('toDate')) ? date('Y-m-d',strtotime($this->input->post('toDate'))) : NULL,
                'vic_eventfrequency'=>$this->input->post('frequency'),
                'vic_date'=>date('Y-m-d',strtotime($this->input->post('date')))
            );

            if ($this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
                $eventData['vic_eventurl']=$this->input->post('url');
                $eventData['vic_eventvenue']=$this->input->post('venue');
                $eventData['vic_registration_url']=$this->input->post('registrationURL');
                $eventData['vic_event_website_url']=$this->input->post('websiteURL');
                $eventData['vic_eventdesc']=$this->input->post('description');
                $eventData['vic_eventtime']=date('H:i A',strtotime($this->input->post('eventTime')));
            }
            $this->session->set_userdata('eventdata', $eventData); 

            $this->session->set_flashdata('flash_error','To add event, please update company details first');
            $url = 'events/add-event';
            $this->session->set_userdata('redirect_url',$url);
            redirect('profile_setting');
        }
        $this->session->unset_userdata('eventdata'); 
        $this->form_validation->set_rules('eventType', 'Event Type', 'required'); 
        // $this->form_validation->set_rules('organizer', 'Organizer', 'required'); 
        $this->form_validation->set_rules('cName', 'Company Name', 'required'); 
        $this->form_validation->set_rules('sector', 'Sector', 'required'); 
        $this->form_validation->set_rules('title', 'Title', 'required'); 

        // if($this->input->post('frequency') == 'Custom'){
        $this->form_validation->set_rules('fromDate', 'From Date', 'required'); 
        $this->form_validation->set_rules('toDate', 'To Date', 'required|callback_compareDate');
        // } 
        $this->form_validation->set_rules('date', 'Date', 'required');

        
        
        //subcription plan holder
        if ($this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
            //if eventtype is Online
            if($this->input->post('eventCategory') == 'Online'){
                $this->form_validation->set_rules('registrationURL', 'Registration URL', 'required|valid_url'); 
            }else{
                //if event tyepe is offline
                $this->form_validation->set_rules('venue', 'Venue', 'required'); 
            }
            $this->form_validation->set_rules('websiteURL', 'Website URL', 'required|valid_url');
            $this->form_validation->set_rules('description', 'Description', 'required'); 
            $this->form_validation->set_rules('eventTime', 'Event Time', 'required');
        
            if(empty($_FILES['uploadLogo']['name'][0]))
            { $this->form_validation->set_rules('uploadLogo', 'Upload Logo', 'required'); }
            if(empty($_FILES['uploadAdvertisement']['name'][0]))
            { $this->form_validation->set_rules('uploadAdvertisement', 'Upload Advertisement', 'required'); }
            if(empty($_FILES['uploadBanners']['name'][0]))
            { $this->form_validation->set_rules('uploadBanners', 'Upload Banners', 'required'); }
            // if(empty($_FILES['uploadReport']['name'][0]))
            // { $this->form_validation->set_rules('uploadReport', 'Upload Report', 'required'); }
            if(empty($_FILES['uploadPhotos']['name'][0]))
            { $this->form_validation->set_rules('uploadPhotos', 'Upload Photos', 'required'); }
            if(empty($_FILES['uploadVideo']['name'][0]))
            { $this->form_validation->set_rules('uploadVideo', 'Upload Video', 'required'); }
    
        }
        if($this->form_validation->run() == true){

            //subcription plan holder
            if ($this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
                $config['upload_path'] = 'upload/event/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $new_name = time().$_FILES['uploadLogo']['name'];
                $config['file_name'] = $new_name;
                // $config['max_size'] = 2000;
                // $config['max_width'] = 1500;
                // $config['max_height'] = 1500;
                $this->upload->initialize($config); 
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('uploadLogo')) {
                    $error = (array) $this->upload->display_errors();
                    $msg = implode(" ",$error);
                    $this->session->set_flashdata('flash_error',$msg);
                    redirect('events/add-event');
                } else {
                    $uploadData = $this->upload->data();
                    $uploadLogo = $uploadData['file_name'];
                }

                $uploadBanners = $this->upload_images('uploadBanners');
                $uploadAdvertisement = $this->upload_images('uploadAdvertisement');
                $uploadPhotos = $this->upload_images('uploadPhotos');
                
                if(!empty($_FILES['uploadReport']['name'][0])){
                    $uploadReport = $this->upload_report('uploadReport');
                }
                $uploadVideo = $this->upload_video('uploadVideo');
            }else{
                $uploadLogo = 'event_default_logo.png';
            }
            
            $eventData = array(
                'vic_eventtype'=>$this->input->post('eventType'),
                'vic_organizer'=>$this->input->post('cName'),
                'vic_company_idvic_company'=>$companyID,
                'vic_sector_id'=>$this->input->post('sector'),
                'vic_eventtitle'=>$this->input->post('title'),
                'vic_eventstartdate'=>($this->input->post('fromDate')) ? date('Y-m-d',strtotime($this->input->post('fromDate'))) : NULL,
                'vic_eventenddate'=>($this->input->post('toDate')) ? date('Y-m-d',strtotime($this->input->post('toDate'))) : NULL,
                'vic_eventfrequency'=>$this->input->post('frequency'),
                'vic_logo'=>$uploadLogo,
                'vic_date'=>date('Y-m-d',strtotime($this->input->post('date'))),
                'vic_modification_status' => 'Under Review',
                'vic_modification_at' => date('Y-m-d H:i:s'),
                'vic_user_id' => $userID
            );
             //subcription plan holder
             if ($this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
                $eventData['vic_eventurl']=$this->input->post('url');
                $eventData['vic_eventvenue']=$this->input->post('venue');
                $eventData['vic_registration_url']=$this->input->post('registrationURL');
                $eventData['vic_event_website_url']=$this->input->post('websiteURL');
                $eventData['vic_eventdesc']=$this->input->post('description');
                $eventData['vic_eventtime']=date('H:i',strtotime($this->input->post('eventTime')));
                $eventData['vic_banners']=$uploadBanners;
                $eventData['vic_advertisement']=$uploadAdvertisement;
                $eventData['vic_conclusion_report']=$uploadReport;
                $eventData['vic_photos']=$uploadPhotos;
                $eventData['vic_video']=$uploadVideo;
             }
            $result = $this->event_model->insert($eventData);
            if($result){
                $this->send_notification($eventData['vic_organizer'],'create');
                $msg = 'Event created successfully. It is under review now and will be posted soon!';
                $this->session->set_flashdata('flash_success',$msg); 
            }else{
                $msg =' Failed to add event.';
                $this->session->set_flashdata('flash_error',$msg);
            }
            redirect('events/add-event');
        }
        else{ 
            $error =(array) validation_errors(); 
            $msg = implode(" ",$error);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
            redirect('events/add-event');
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
                    redirect('events/add-event');
                } else {
                    $uploadData = $this->upload->data();
                    $name_array[] = $uploadData['file_name'];
                }
            }
            $names= implode(',', $name_array);
            return $names;       
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
                    
                    $config['upload_path'] = 'upload/event/video';
                    $config['allowed_types'] = 'mov|mpeg|mp3|avi|mp4';

                    $new_name = time().$_FILES['video']['name'];
                    $config['file_name'] = $new_name;
                    // $config['max_size'] = '100';
                    // $config['max_width']  = '1024';
                    // $config['max_height']  = '768';
                    
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('video')) {
                        $error = $this->upload->display_errors(); 
                        $this->session->set_flashdata('flash_error',$input_name.$error);
                        redirect('events/add-event');
                        exit;
                    } else {
                        $uploadData = $this->upload->data();
                        $name_array[] = $uploadData['file_name'];
                        
                    }
            }
            $names= implode(',', $name_array);
            return $names;
        
    }
    public function upload_report($input_name){
        $config1['upload_path'] = 'upload/event/report';
        $config1['allowed_types'] = 'pdf|docx|pptx';

        if(isset($_FILES[$input_name])){
            $image_path = array();      
             
            $count = count($_FILES[$input_name]['name']); 
            
                for($key =0; $key <$count; $key++){   
                    $_FILES['report']['name']     = $_FILES[$input_name]['name'][$key]; 
                    $_FILES['report']['type']     = $_FILES[$input_name]['type'][$key]; 
                    $_FILES['report']['tmp_name'] = $_FILES[$input_name]['tmp_name'][$key]; 
                    $_FILES['report']['error']     = $_FILES[$input_name]['error'][$key]; 
                    $_FILES['report']['size']     = $_FILES[$input_name]['size'][$key]; 
                    
                    $new_name = time().$_FILES['report']['name'];
                    $config1['file_name'] = $new_name;

                    $this->upload->initialize($config1);
                    $this->load->library('upload', $config1);
                
                    
                    if($this->upload->do_upload('report')) {
                        $data = $this->upload->data();
                        $image_path[$key] = $data['file_name'];                  
                    }else{
                        $error =  $this->upload->display_errors();
                        
                        $this->session->set_flashdata('flash_error',"report upload! ".$error);
                
                        redirect('events/add-event');
                    }   
                }
                return implode(',',$image_path);
        }
    }
    public function valid_url($str) {
        return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
    }
    public function geteventby_date(){
        
        $selectedDate=$this->input->post('date');
        $eventDate=date('Y-m-d',strtotime($selectedDate));
        $sector = $this->input->post('sector');
        $search = $this->input->post('search');
        $type = $this->input->post('type');

        $result=$this->event_model->get_events_list($sector,$search,$type,$eventDate);
        if(!empty($result))
        {
            $str="";
            $month = array();
            $i=0;
            foreach ($result as $k => $event) : 
                $i++;
                //  $m = date('m', strtotime($event->vic_date));
                $m = date('m', strtotime($selectedDate));
                if (!in_array($m, $month)):
                    array_push($month, $m);
                    $str.='<p class="mb-0 event-date mt-3">'.date('F Y', strtotime($selectedDate)).'</p>';
                    $status='';
                    if ($k == 0){
                        $collapse = 'true';
                        $status='show';
                    }
                endif;
                $collapse ='';
                if ($k == 0){
                    $collapse = 'true';
                }
                if($event->vic_eventdesc==null || $event->vic_eventdesc==""){
                    $detail= "No description here";
                }else{
                    $detail= strlen($event->vic_eventdesc) > 250 ? substr($event->vic_eventdesc, 0, 250) . "..." : $event->vic_eventdesc;
                }

                $str.='<div class="card mt-2 mb-2 event-card">
                    <div id="">
                        <div class="event-calender-info">
                            <a href="'.base_url().'events/event-details/'.$event->idvic_events.'" class="ongoing-event-title"> <span class="ongoing-event-date">'.date('d/m', strtotime($selectedDate)).' -</span> <span class="ongoing-event-name">'.$event->vic_eventtitle.'</span> </a>
                            <span class="ongoing-event-time"> '.$event->vic_eventtype.'  Event |  '.$event->vic_eventtime.'  </span>
                            <span class="plus-icon float-right" data-toggle="collapse" data-target="#collapse'.$k.'" aria-expanded="'.$collapse.'" aria-controls="collapse'.$k.'"> 
                                <i class="fa fa-plus plus-icon"></i>
                                <i class="fa fa-minus plus-icon"></i> 
                            </span>
                            
                        </div>

                        <div id="collapse'.$k.'" class="collapse  '.$status.'" data-parent="#accordion">
                            <div class="pl-3 pr-3 event-details f-14">
                                '.$detail.'
                            </div>
                        </div>
                    </div>
                </div>';
            endforeach;
            echo json_encode($str);

        }
    }
    public function update_registration_count(){
        if($this->input->is_ajax_request()){
            $eventId = $this->input->post('event_id');
            if($eventId){
                $this->event_model->update_registration_count($eventId);
            }
        }
        else{
            exit('No direct script access allowed');
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
                $val['vic_title'] = 'The '.$organizer.' submitted the event details on the portal for  review';
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