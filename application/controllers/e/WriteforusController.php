<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WriteforusController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/others/Notification_model');
        $this->load->model('country_model');
    }

    public function index()
    {
        try {
            $this->load_profile_View();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_profile_View()
    {
        if ($this->session->userdata('userId')) {
            $data['activePage'] = "home";
            $data['countries'] = $this->country_model->getCountryList();
            $this->load->view('css_js_helpers');
            $this->load->view('write_for_us/wfu_css_js_helpers');
            $this->load->view('write_for_us/write_for_us', $data);
        } else {
            redirect('register');
        }
    }

    public function store()
    {
        try {
            // recaptcha response
            $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

            $userIp = $this->input->ip_address();

            $secret = $this->config->item('google_secret');

            $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $status = json_decode($output, true);

            if ($status['success']) {

                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('position', 'position', 'required');
                $this->form_validation->set_rules('companyName', 'companyName', 'required');
                $this->form_validation->set_rules('phone', 'phone', 'required');
                $this->form_validation->set_rules('address', 'address', 'required');
                $this->form_validation->set_rules('city', 'city', 'required');
                $this->form_validation->set_rules('zipCode', 'zipCodee', 'required');
                $this->form_validation->set_rules('country', 'country', 'required');

                $this->form_validation->set_rules('type', 'type', 'required');
                $this->form_validation->set_rules('category', 'category', 'required');
                $this->form_validation->set_rules('title', 'title', 'required');

                $this->form_validation->set_rules('keyword', 'keyword', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $error = (array)validation_errors(); 
                    // print_r($error);exit;
                    $msg = implode(" ",$error);//echo $msg;exit;
                    $this->session->set_flashdata('flash_error',$msg);
                    redirect('write-for-us');
                } else {
                    $form_data = $this->input->post();
                    $column = array();

                    $column['vic_bn_firstname'] = $form_data['name'];
                    $column['vic_bn_position'] = $form_data['position'];
                    $column['vic_bn_company'] = $form_data['companyName'];
                    $column['vic_bn_phonenumber'] = $form_data['phone'];
                    $column['vic_bn_addresslineone'] = $form_data['address'];
                    $column['vic_bn_addresslinetwo'] = $form_data['addressOne'];
                    $column['vic_bn_city'] = $form_data['city'];
                    $column['vic_bn_zip'] = $form_data['zipCode'];
                    $column['vic_bn_country'] = $form_data['country'];
                    $column['vic_bn_type'] = $form_data['type'];
                    $column['vic_description'] = (isset($form_data['description'])) ? $form_data['description'] : NULL;
                    $column['vic_news_category'] = $form_data['category'];
                    $column['vic_bn_title'] = $form_data['title'];
                    $column['vic_blogs_article_keyword'] = $form_data['keyword'];
                    $column['vic_bn_youtubeURL'] = (isset($form_data['youtubeUrl'])) ? $form_data['youtubeUrl'] : NULL;
                    $column['vic_blogs_website_url'] = $form_data['websiteurl'];
                    $column['vic_modification_status'] = 'Under Review';
                    $column['vic_bn_createdat'] = date('Y-m-d H:i:s');
                    $column['vic_updated_at'] = date('Y-m-d H:i:s');

                    $column['vic_bn_status'] = 'inactive';

                    $result = $this->umodel->do_upload('uploadVideo', 'mp4', 'userfile');
                    if (!$result['error']) {
                        $column['vic_blogs_news_video  '] = $result['file_path'];
                    }
                    $result = $this->umodel->do_upload('uploadAttachment', 'mp4', 'userfile');
                    if (!$result['error']) {
                        $column['vic_bn_document_url'] = $result['file_path'];
                    }

                    $result = $this->db->insert('vic_blogs_news', $column);

                    if ($result == true) {
                        $this->send_notification($form_data['type']);
                        $this->session->set_flashdata('flash_success', 'Your information updated successfully.It is under review now and will be posted soon!');
                        redirect('write-for-us');
                    } else {
                        $this->session->set_flashdata('flash_error', 'Failed to add information');
                        redirect('write-for-us');
                    }
                }
            } else {
                $this->session->set_flashdata('flash_error', 'Sorry google recaptcha unsuccessful!!');
                redirect('write-for-us');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function send_notification($type){
        $userID = $this->session->userdata('userId');
        //notification
        $adminlist = $this->Notification_model->notify_user_list($userID);
        $output = $this->Notification_model->get_user_name($userID);
        
        $val['vic_user_id_sender'] = $userID;
        $val['vic_created_on'] = date('Y-m-d H:i:s');
        if($output)
            $val['vic_title'] = 'The '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.' submitted the '.$type.' on the portal';
        else
            $val['vic_title'] = 'The client submitted the '.$type.' on the portal';

        
        $insert_notification_batch = array();
        foreach($adminlist as $li){
            
            $val['vic_user_id_receiver'] = $li->iduser_details;
            array_push($insert_notification_batch,$val);   
        }
        
        $this->Notification_model->insert_notify_batch($insert_notification_batch);
    }
}
