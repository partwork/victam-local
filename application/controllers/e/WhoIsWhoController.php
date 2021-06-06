<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'config/IsRegisteredController.php';

class WhoIsWhoController extends IsRegisteredController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Whoiswho_model');
        $this->load->model('File_upload_model', 'umodel');
        $this->userID = $this->session->userdata('userId');
        $this->load->model('SES_model');
        $this->load->model('country_model');
        $this->load->model('admin/others/Notification_model'); 
        $this->load->model('user'); 
        $this->load->model('profile'); 
        $this->load->model('sector_model');
    }

    public function load_Company_Directory_View(){
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $data['activePage'] = "whoIsWho";
            $data['companylist'] = $this->Whoiswho_model->get_company_info();
            $this->load->view('css_js_helpers');
            $this->load->view('who_is_who/w_css_js_helpers');
            $this->load->view('who_is_who/company_directory', $data);
        }
    }
    public function load_add_comapny_view()
    {
        if ($this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
            $data['activePage'] = "whoIsWho";
            $data['countries'] = $this->country_model->getCountryList();
            $data['sectors'] = $this->sector_model->getSectorList();
            $userInfo = $this->user->user_details($this->userID);
            if(!empty($userInfo) && $userInfo->vic_company_idvic_company)
                $data['company'] = $this->Whoiswho_model->get_company_info_by_id($userInfo->vic_company_idvic_company);
            
            $this->load->view('css_js_helpers');
            $this->load->view('who_is_who/w_css_js_helpers');
            $this->load->view('who_is_who/add_company', $data);
        }else{
            redirect('');
        }
    }

    public function get_company_details($id)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $result = $this->Whoiswho_model->get_company_info_by_id($id);
            echo json_encode($result);
        }
    }
    public function register_company()
    {
        try {
            $company =$this->profile->company_details($this->userID);
            if($company){
                $this->form_validation->set_rules('companyname', 'Company Name', 'required'); 
            }else{
                $this->form_validation->set_rules('companyname', 'Company Name', 'required|is_unique[vic_company.vic_companyname]'); 
            }
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
            $this->form_validation->set_rules('target_groups', 'target_groups', 'required');
            $this->form_validation->set_rules('services', 'services', 'required');
            $this->form_validation->set_rules('USPS', 'Important USPS', 'required');
            $this->form_validation->set_rules('delivering', 'Company Delivering', 'required');
            $this->form_validation->set_rules('duration', 'Investment Duration', 'required');
            $this->form_validation->set_rules('specialities', 'Specialities', 'required');
            $this->form_validation->set_rules('linkedinurl', 'Linked URL', 'required');
            if ($this->form_validation->run() == FALSE) {
                $error =(array) validation_errors(); 
                $msg = implode(" ",$error);
                $msg = trim(preg_replace('/\s\s+/', ' ', $msg));

                $this->session->set_flashdata('flash_error', $msg);
                redirect('who_Is_Who/add-company');
            } else {
                $form_data = $this->input->post();
                $column = array();
                $column['vic_companyname'] = $form_data['companyname'];
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
                $column['vic_company_target_groups'] = $form_data['target_groups'];
                $column['vic_products_services'] = $form_data['services'];
                $column['vic_important_usp'] = $form_data['USPS'];
                $column['vic_companies_delivering'] = $form_data['delivering'];
                $column['vic_investment_duration'] = $form_data['duration'];
                $column['vic_specialities'] = $form_data['specialities'];
                $column['vic_companylinkedinurl'] = $form_data['linkedinurl'];
                $column['vic_company_is_active'] = 'active';
                $column['vic_company_status'] = 'Under Review';
                $column['vic_company_created_on'] = date('Y-m-d h:i:s');
                $column['vic_company_type'] = 'company_to_guide';

                $result = $this->umodel->do_upload('uploadImageFile', 'jpg|png|jpeg', 'company');

                if (!$result['error']) {
                    $column['vic_companylogo'] = $result['file_path'];
                }
                $result = $this->umodel->do_upload('uploadPresentationFile', 'mp4', 'company');

                if (!$result['error']) {
                    $column['vic_companypresentation'] = $result['file_path'];
                }

                $column['vic_terms_of_use'] = '1';

                $companyId = $this->profile->insert_update_company($this->userID,$column);
                // $result = $this->db->insert('vic_company', $column);
                if ($companyId) {
                    // $companyID = $this->db->insert_id();
                    if($form_data['company_id']){
                        $msg = 'Company information updated successfully. It is under review now and will be posted soon.';
                        //notification
                        $this->send_notification($column['vic_companyname'],'update');
                        $statusmsg = 'Updated';
                    }else{
                        $msg = 'Company added successfully';
                        $statusmsg = 'added';
                        //notification
                        $this->send_notification($column['vic_companyname'],'create');
                    }

                    $response = $this->send_notification_to_finding_buyers($column);

                    $email = $form_data['email'];
                    $content = 'Your Company'.$form_data['companyname'].' is successfully '.$statusmsg.' to the Victam Portal';
                    $this->SES_model->sharedmail($email, $content);
                    $this->session->set_userdata('companyId', $companyID);
                    $this->session->set_flashdata('flash_success', $msg);
                    redirect('who_Is_Who/add-company');
                    
                } else {
                    $this->session->set_flashdata('flash_error', 'Company name duplication not allowed.');
                    redirect('who_Is_Who/add-company');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function search_using_keywords($name, $type)
    {
        try {
            if ($this->input->is_ajax_request()) {
                $result = $this->Whoiswho_model->get_company_by_keywords($name, $type);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function company_filter(){
        try {
            if ($this->input->is_ajax_request()) {
                
                $req = array(
                    'name'=>$this->input->post('name'),
                    'sector'=>$this->input->post('sector'),
                    'country'=>$this->input->post('country'),
                    'type'=>$this->input->post('type')
                );
                
                $result = $this->Whoiswho_model->get_company_filter($req);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ajax_isphone_exists()
    {
        try {
            if ($this->input->is_ajax_request()) {
                $mobile = $_POST[''];
                $data = $this->Whoiswho_model->ajaxphone_exists($mobile);
                echo json_encode($data);
            } else {
                echo json_encode(array('msg' => false));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ajax_isemail_exists()
    {
        try {
            if ($this->input->is_ajax_request()) {
                $email = $_POST[''];
                $data = $this->Common_model->ajaxisemail_exists($email);
                echo json_encode($data);
            } else {
                echo json_encode(array('msg' => false));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ajax_company_exists()
    {
        try {
            if ($this->input->is_ajax_request()) {
                $company = $_POST[''];
                $data = $this->Common_model->ajaxiscompany_exists($company);
                echo json_encode($data);
            } else {
                echo json_encode(array('msg' => false));
            }
        } catch (\Throwable $th) {
            throw $th;
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
                $val['vic_title'] = 'The '.$organizer.' added the company details';
                break;
            case 'update':
                $val['vic_title'] = 'The '.$organizer.' updated the company details';;
                break;
            case 'reject':
                $val['vic_title'] = '';
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


    public function send_notification_to_finding_buyers($data)
    {
        $res = $this->Whoiswho_model->get_user_list_by_finding_buyers($data);
        
        foreach($res as $list){
            $email = $list->user_email;
            $content = 'Hello '.$list->vic_user_firstname.' <br> we have found a new match for you. Please find below the details <br> '.$data['vic_companyname'].' and '.$data['vic_companyemail'].'';
            $this->SES_model->sharedmail($email, $content);
        }
    }
}
