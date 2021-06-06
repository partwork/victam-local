<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
include APPPATH.'controllers/admin/config/AdminController.php';

class WhoIsWhoController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/Marketinformation_model');     
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/others/Notification_model');  
        $this->load->model('country_model');
        $this->load->model('SES_model');
    }

    public function whoIsWho()
    {
        $data['activePage'] = "Who Is Who";
        

        $config = array();
        $config["base_url"] = base_url() . "admin/content-management/who-is-who/whoIsWho/pagination";
        $config["total_rows"] = $this->Marketinformation_model->get_count_company_list();
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
        $config['first_link'] = false;
        $config['last_link'] = false;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
        $data["company"] = $this->Marketinformation_model->get_company_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/who-is-who/whoIsWho', $data);
    }
    public function addCompany()
    {
        $data['activePage'] = "Who Is Who";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/who-is-who/addCompany', $data);
    }

    public function get_company_details_by_ids()
    {
        try {
            $data['id'] = $this->uri->segment(5);
            $data['countries'] = $this->country_model->getCountryList();
            $data['sector'] = $this->Marketinformation_model->get_active_sector();
            $data['content'] = $this->Marketinformation_model->get_company_details_by_id($data['id']);
            //$data['activePage'] = "Update Company";
            $data['activePage']='whoIsWho';
            $this->load->view('css_js_helpers');
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/contentmanagement/contentmanagement-js-css');
            $this->load->view('admin/layouts/sidemenu', $data);
            $this->load->view('admin/contentmanagement/who-is-who/addCompany', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_company_status()
    {
        $id = $this->uri->segment(6);
        $status = $this->uri->segment(7);
        try {
            if($this->input->is_ajax_request()){   
                if(is_numeric($id)){
                    $data = $this->MarketInformation_model->update_company_status($id, $status);
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

    public function delete_company_by_id()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                if(is_numeric($id)){
                    $data = $this->marketInformation_model->delete_company_by_id($id);
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
    public function delete_company(){
        

        try {
            if($this->input->is_ajax_request()){   

                    
                    $data = $this->Marketinformation_model->delete_company_by_id($_POST['id']);
                    echo json_encode($data);
                
            }else{
                echo json_encode(array('msg'=>'Access Denied'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filter_company_by_status($name)
    {
        try {
            if ($this->input->is_ajax_request()) {
                $result = $this->MarketInformation_model->filter_company_by_status($name);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filter_company_search($name)
    {
        try {
            if ($this->input->is_ajax_request()) {
                $result = $this->MarketInformation_model->filter_company_search($name);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_company()
    {
        try {
            $this->form_validation->set_rules('companyname', 'Name', 'required');
            $this->form_validation->set_rules('companydescription', 'Description', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('city', 'city', 'required');
            $this->form_validation->set_rules('country', 'country', 'required');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('phonenumber', 'mobile no', 'required');
            $this->form_validation->set_rules('website', 'website', 'required');
            $this->form_validation->set_rules('industrysector', 'sector', 'required');
            $this->form_validation->set_rules('industries', 'industries', 'required');
            $this->form_validation->set_rules('headquarters', 'headquaters', 'required');
            $this->form_validation->set_rules('production', 'production', 'required');
            $this->form_validation->set_rules('companytodeal', 'companytodeal', 'required');
            $this->form_validation->set_rules('services', 'services', 'required');
            $this->form_validation->set_rules('USPS', 'Important USPS', 'required');
            $this->form_validation->set_rules('delivering', 'Company Delivering', 'required');
            $this->form_validation->set_rules('duration', 'Investment Duration', 'required');
            $this->form_validation->set_rules('specialities', 'Specialities', 'required');
            $this->form_validation->set_rules('linkedinurl', 'Linked URL', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $form_data = $this->input->post();
                $column = array();
                
                $column['vic_companydesc'] = $form_data['companydescription'];
                $column['vic_address_details'] = $form_data['address'];
                $column['vic_companycity'] = $form_data['city'];
                $column['vic_country_name'] = $form_data['country'];
                $column['vic_zip_code'] = $form_data['zipcode'];
                $column['vic_companyemail'] = $form_data['email'];
                $column['vic_phonenumber'] = $form_data['phonenumber'];
                $column['vic_companywebsite'] = $form_data['website'];
                $column['vic_industry_sector'] = $form_data['industrysector'];
                $column['vic_active_industry1'] = $form_data['industries'];
                $column['vic_companyheadquarters'] = $form_data['headquarters'];
                $column['vic_companyproduction'] = $form_data['production'];
                $column['vic_company_to_deal'] = $form_data['companytodeal'];
                $column['vic_products_services'] = $form_data['services'];
                $column['vic_important_usp'] = $form_data['USPS'];
                $column['vic_companies_delivering'] = $form_data['delivering'];
                $column['vic_investment_duration'] = $form_data['duration'];
                $column['vic_specialities'] = $form_data['specialities'];
                $column['vic_companylinkedinurl'] = $form_data['linkedinurl'];

                $result = $this->umodel->do_upload('uploadImageFile', 'jpg|png|jpeg', 'company');
                
                if (!$result['error']) {
                    $column['vic_companylogo'] = $result['file_path'];
                }
                $result = $this->umodel->do_upload('uploadPresentationFile', 'mp4', 'company');
                if (!$result['error']) {
                    $column['vic_companypresentation'] = $result['file_path'];
                }

                $column['vic_terms_of_use'] = '1';

                $column['vic_company_is_active'] =(isset($form_data['status']))? 'active' : 'inactive' ;

                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_company_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_company_status'] = 'Published';
                }else{
                    $column['vic_company_status'] = 'Under Review';
                }

                $column['vic_company_created_on'] = date('Y-m-d H:i:s');
                
                
                $result = $this->db->insert('vic_company', $column);
                if ($result == true) {
                    if($this->session->userdata('usertype') != 'super admin'){
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                            $val['title'] = 'Who is who: The '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.' added the company details';
                            $this->Notification_model->add_notify($val);   
                        }  
                    }else{
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                            $val['title'] = 'The company details for the '.$form_data['companyname'].' published successfully on the portal';
                            $this->Notification_model->add_notify($val);   
                        } 
                    }
                    $data = array('status' => true, 'msg' => 'Company added successfully. It is under review now and will be posted soon!');
                    
                } else {
                    $data = array('status' => false, 'msg' => 'Failed to add company information.');
                }

                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function change_status_whoiswho(){
        $id=$_POST['id'];
        $status=$_POST['status'];
        $result=$this->Marketinformation_model->update_company_status($id,$status);
        echo json_encode($result);
    }
    public function search_whoiswho(){
        $result=$this->Marketinformation_model->search_whoiswho($_POST);
        echo json_encode($result);
    }
    public function update_company()
    {
        
        try {
            $this->form_validation->set_rules('companyname', 'Name', 'required');
            $this->form_validation->set_rules('companydescription', 'Description', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('city', 'city', 'required');
            $this->form_validation->set_rules('country', 'country', 'required');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('phonenumber', 'phone no', 'required');
            $this->form_validation->set_rules('website', 'website', 'required');
            $this->form_validation->set_rules('industrysector', 'sector', 'required');
            $this->form_validation->set_rules('industries', 'industries', 'required');
            $this->form_validation->set_rules('headquarters', 'headquaters', 'required');
            $this->form_validation->set_rules('production', 'production', 'required');
            $this->form_validation->set_rules('companytodeal', 'companytodeal', 'required');
            $this->form_validation->set_rules('services', 'services', 'required');
            $this->form_validation->set_rules('USPS', 'Important USPS', 'required');
            $this->form_validation->set_rules('delivering', 'Company Delivering', 'required');
            $this->form_validation->set_rules('duration', 'Investment Duration', 'required');
            $this->form_validation->set_rules('specialities', 'Specialities', 'required');
            $this->form_validation->set_rules('linkedinurl', 'Linked URL', 'required');
            $this->form_validation->set_rules('target_groups', 'target groups', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $form_data = $this->input->post();
                $column = array();
                // $column['vic_companyname'] = $form_data['companyname'];
                $column['vic_companydesc'] = $form_data['companydescription'];
                $column['vic_address_details'] = $form_data['address'];
                $column['vic_companycity'] = $form_data['city'];
                $column['vic_country_name'] = $form_data['country'];
                $column['vic_zip_code'] = $form_data['zipcode'];
                $column['vic_companyemail'] = $form_data['email'];
                $column['vic_phonenumber'] = $form_data['phonenumber'];
                $column['vic_companywebsite'] = $form_data['website'];
                $column['vic_industry_sector'] = $form_data['industrysector'];
                $column['vic_active_industry1'] = $form_data['industries'];
                $column['vic_companyheadquarters'] = $form_data['headquarters'];
                $column['vic_companyproduction'] = $form_data['production'];
                $column['vic_company_to_deal'] = $form_data['companytodeal'];
                $column['vic_products_services'] = $form_data['services'];
                $column['vic_important_usp'] = $form_data['USPS'];
                $column['vic_companies_delivering'] = $form_data['delivering'];
                $column['vic_investment_duration'] = $form_data['duration'];
                $column['vic_specialities'] = $form_data['specialities'];
                $column['vic_companylinkedinurl'] = $form_data['linkedinurl'];
                // $column['vic_company_is_active'] = (isset($form_data['status']))? 'active': 'inactive';
                $column['vic_company_created_on'] = date('Y-m-d H:i:s');
                $column['vic_company_target_groups'] = $form_data['target_groups'];


                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_company_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_company_status'] = 'Published';
                }else{
                    $column['vic_company_status'] = 'Under Review';
                }
                if(isset($_FILES['uploadImageFile']) && $_FILES['uploadImageFile']['name']!=''){
                    $result = $this->umodel->do_upload('uploadImageFile', 'jpg|png|jpeg', 'company');
                    if (!$result['error']) {
                        $column['vic_companylogo'] = $result['file_path'];
                    }
                }
                if(isset($_FILES['uploadPresentationFile']) && $_FILES['uploadPresentationFile']['name']!=''){
                    $result = $this->umodel->do_upload('uploadPresentationFile', 'mp4', 'company');
                    if (!$result['error']) {
                        $column['vic_companypresentation'] = $result['file_path'];
                    }
                }    
               
                
                //$result = $this->MarketInformation_model->update_company_detail(array('idvic_company' => $form_data['id']) , $column);
                $result =$this->Marketinformation_model->update_company_detail($form_data['id'],$column);
                if ($result == true) {
                    if($this->session->userdata('usertype') == 'super admin'){
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                            $val['title'] = 'The company details for the '.$form_data['companyname'].' published successfully on the portal';
                            $this->Notification_model->add_notify($val);   
                        }  
                    }else{
                        // $adminlist = $this->Notification_model->get_admin_list();
                        $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                        $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
                            
                        foreach($adminlist as $li){
                            $val['sender_id'] = $this->session->userdata('userId');
                            $val['receiver_id'] = $li->iduser_details;
                            if($output)
                                $val['title'] = 'The company details for the '.$form_data['companyname'].' are modified by the '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname.'';
                            else
                                $val['title'] = 'The company details for the '.$form_data['companyname'].' are modified by the user';

                            $this->Notification_model->add_notify($val);   
                        }  
                    }
                    $res='success';
                    //$this->session->set_flashdata('flash_success', 'Company Update successfully');
                } else {
                    $res='error';
                    //$this->session->set_flashdata('flash_error', 'Failed To update');
                }
                redirect(base_url('admin/contentmanagement/WhoIsWhoController/get_company_details_by_ids/'.$form_data['id'].'?res='.$res));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reject_company_by_details()
    {
        $id = $this->uri->segment(6);
        try {
            if($this->input->is_ajax_request()){   
                $data = $this->MarketInformation_model->reject_company_by_details($id);
                // if($this->session->userdata('usertype') == 'super admin'){
                    $adminlist = $this->Notification_model->notify_user_list($this->session->userdata('userId'));
                    // $adminlist = $this->Notification_model->get_admin_list();
                    foreach($adminlist as $li){
                        $val['sender_id'] = $this->session->userdata('userId');
                        $val['receiver_id'] = $li->iduser_details;
                        $output = $this->Notification_model->get_user_name($this->session->userdata('userId'));
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
    public function reject_whoiswho($id){

        $data = $this->Marketinformation_model->reject_company_by_details($id);

         $comp = $this->Marketinformation_model->get_user_email_by_company_id($id);
        
         $nam = $this->Marketinformation_model->get_company_details_by_id($id);

            if($comp && $nam){
                        $email = $comp['0']->user_email;
                        $companyname = $nam['0']->vic_companyname;
                        $this->SES_model->reject_company_shared($email, $companyname);
                    }

         echo json_encode($data);
         exit;
    }
}
