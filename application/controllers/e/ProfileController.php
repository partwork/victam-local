<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include 'config/IsRegisteredController.php';

class ProfileController extends IsRegisteredController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile'); 
        $this->load->model('company'); 
        $this->load->model('country_model');
        $this->load->model('user'); 
        $this->load->model('sector_model');
        $this->isUserRegistered = $this->session->userdata('isUserRegistered');
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
        $this->userID = $this->session->userdata('userId');
    }
	
	public function index(){
        try {
            // $this->load_profile_View();
            if($this->input->post('action')=='profileSetUp'){
                $this->profileSetup();
            }elseif($this->userID){
                $this->load_profile_View();
            }else{
                //redirect to register page
                redirect('register');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_profile_View(){
        $data['activePage'] = "home";
        $data['countries'] = $this->country_model->getCountryList();
        $data['InterestFields'] = $this->profile->field_of_interest_list();// print_r($data['InterestFields']);exit;
        $this->load->view('css_js_helpers');
        $this->load->view('profile/p_css_js_helpers');
        $this->load->view('profile/profile', $data);
    }

    public function load_profile_setting(){
        if(!$this->userID){
            redirect('login');
        }
        
        $data['activePage'] = "home";
        $data['user'] =  $this->user->user_details($this->userID);  //print_r($data['user']);exit;
        $data['countries'] = $this->country_model->getCountryList();
        $data['sectors'] = $this->sector_model->getSectorList();
        $data['InterestFields'] = $this->profile->field_of_interest_list(); 
        $data['company'] = $this->profile->company_details($this->userID); //print_r($data['company']);exit;

        $this->load->view('css_js_helpers');
        $this->load->view('profile/p_css_js_helpers');
        $this->load->view('profile/profile_setting', $data);
    }

    public function profileSetup(){
        try{
            $data = $userData = array(); 
            // If registration request is submitted
            //user profile
            $this->form_validation->set_rules('userType', 'User Type', 'required'); 
            //personal info
            $this->form_validation->set_rules('fname', 'First Name', 'required'); 
            $this->form_validation->set_rules('lname', 'Last Name', 'required'); 
            // $this->form_validation->set_rules('pContact', 'Primary Contact', 'required'); 
            // $this->form_validation->set_rules('email', 'email', 'required');
            //address info 
            // $this->form_validation->set_rules('addressOne', 'Address Line 1', 'required'); 
            // $this->form_validation->set_rules('city', 'City', 'required'); 
            // $this->form_validation->set_rules('zipCode', 'ZipCode', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required'); 
            

            $isCompany = $this->input->post('user_iscompany');
            
            //if company 
            if($isCompany == '1'){
                //company info
                $this->form_validation->set_rules('companyName', 'Company Name', 'required|is_unique[vic_company.vic_companyname]'); 
                
                $this->form_validation->set_rules('industry', 'Industry', 'required'); 
                // $this->form_validation->set_rules('answer', 'Answer', 'required'); 
                //$this->form_validation->set_rules('website', 'Website', 'required'); 
                // $this->form_validation->set_rules('companySize', 'Company Size', 'required'); 
                // $this->form_validation->set_rules('headquarter', 'Headquarter', 'required'); 
                // $this->form_validation->set_rules('companyFounded', 'Company Founded', 'required'); 
                // $this->form_validation->set_rules('specialities', 'Specialities', 'required');
                //address info 
                // $this->form_validation->set_rules('addressOne', 'Address Line 1', 'required'); 
                // $this->form_validation->set_rules('city', 'City', 'required'); 
                // $this->form_validation->set_rules('country', 'Country', 'required'); 
                // $this->form_validation->set_rules('zipCode', 'ZipCode', 'required');
            }
            
            //field of interest
            $this->form_validation->set_rules('interest', 'Interest', 'required'); 
            
            if(($this->form_validation->run() == true)){
                if($isCompany == '1'){
                    $companyData = array(
                        'vic_industry_sector'=>$this->input->post('industry'),
                        'vic_companyname'=>$this->input->post('companyName'),
                        'vic_companyheadquarters'=>$this->input->post('headquarters'),
                        'vic_address_details'=>$this->input->post('addressOne'),
                        'vic_companycity'=>$this->input->post('city'),
                        'vic_country_name'=>$this->input->post('country'),
                        'vic_zip_code'=>$this->input->post('zipCode'),

                    );
                    $companyId = $this->company->insert($companyData);
                    if($companyId == 'false'){
                        $data['error_msg'] = 'Some problems occured, please try again.';
                        redirect('profile');
                    }
                }elseif(trim($this->input->post('companyName')) !=""){
                    $companyName = $this->input->post('companyName');// echo $companyName;exit;
                    $companyId = $this->company->get_company_id($companyName); 
                    if($companyId) $isCompany=1;
                }
                $userData = array(
                    'vic_users_iduser_details' => $this->userID,
                    'vic_user_firstname' => $this->input->post('fname'), 
                    'vic_user_lastname' => $this->input->post('lname'),
                    'vic_user_primarycontact' => $this->input->post('pContact'),
                    'vic_user_secondarycontact' => ($this->input->post('sContact') !="") ? $this->input->post('sContact') : NULL,
                    'vic_user_addresslineone' => $this->input->post('addressOne'),
                    'vic_user_addresslinetwo' => ($this->input->post('addressTwo') !='') ? $this->input->post('addressTwo') : NULL,
                    'vic_user_zip' => $this->input->post('zipCode'),
                    'vic_user_country' => $this->input->post('country'),
                    'vic_user_details_country_code' =>$this->input->post('country_code'),
                    'vic_user_type' => $this->input->post('userType'),
                    'vic_user_iscompany' => $isCompany,
                    'vic_fieldsofinterest_idvic_fieldsofinterest' => $this->input->post('interest'),
                    'vic_company_idvic_company'=> ($isCompany==1) ? $companyId : NULL,
                    'vic_pricing_plans_idvic_pricing_plans' => NULL,
                    'vic_user_details_payment_status' => 'unpaid',
                    'vic_user_details_gender'  => $this->input->post('gender'),
                ); 
                $insert = $this->profile->insert($userData);
                $this->check_status();
                if($insert){
                    if($this->input->post('call')=='ajax'){
                        echo json_encode(array('msg'=>'success','res'=>'true')); exit;
                    }
                    $this->session->set_userdata('success_msg', 'Profile setup done'); 
                     
                    if($this->input->post('action') == 'Yes'){
                        redirect(base_url('who_Is_Who'));
                    }else{
                        redirect(base_url('pricing'));
                    }

                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{
                $error =(array) validation_errors(); 
                $msg = implode(" ",$error);
                $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
                $this->session->set_flashdata('flash_error',$msg);
               
            } 
           redirect('profile');
        }catch (Exception $e) {
            $this->session->set_flashdata('flash_error',$e->getMessage());

            // var_dump($e->getMessage());
        }
    }

    public function update_personal_info(){
        if(!$this->userID){
            redirect('login');
        }   
            
        $this->form_validation->set_rules('userType', 'User Type', 'required');
        $this->form_validation->set_rules('interest', 'Interest', 'required');
        $this->form_validation->set_rules('fname', 'First Name', 'required'); 
        $this->form_validation->set_rules('lname', 'Last Name', 'required'); 
        // $this->form_validation->set_rules('pContact', 'Primary Contact', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        
        if(($this->form_validation->run() == true)){
            $userData = array(
                'vic_users_iduser_details' => $this->userID,
                'vic_user_firstname' => $this->input->post('fname'), 
                'vic_user_lastname' => $this->input->post('lname'),
                'vic_user_primarycontact' => $this->input->post('pContact'),
                'vic_user_type' => $this->input->post('userType'),
                'vic_fieldsofinterest_idvic_fieldsofinterest' => $this->input->post('interest'),
                'vic_user_details_gender'  => $this->input->post('gender'),
                'vic_user_country' => $this->input->post('country'),
                'vic_user_details_country_code' =>$this->input->post('country_code')
            );
            $this->profile->insert_update_user_detail($this->userID,$userData);
            $this->session->set_flashdata('flash_success', 'Profile updated successfully');
        }else{
            $error =(array) validation_errors(); 
            $msg = implode("",$error);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
        redirect('profile_setting');
    }
    public function update_company_info(){        
        if(!$this->userID){
            redirect('login');
        }
        $this->form_validation->set_rules('industry', 'Industry', 'required'); 
        $company =$this->profile->company_details($this->userID);
        if($company){
            $this->form_validation->set_rules('companyname', 'Company Name', 'required'); 
        }else{
            $this->form_validation->set_rules('companyname', 'Company Name', 'required|is_unique[vic_company.vic_companyname]'); 
        }
        // $this->form_validation->set_rules('headquarter', 'Headquarter', 'required'); 
        // $this->form_validation->set_rules('address', 'Address Line 1', 'required'); 
        // $this->form_validation->set_rules('city', 'City', 'required'); 
        // $this->form_validation->set_rules('country', 'Country', 'required'); 
        // $this->form_validation->set_rules('zipCode', 'ZipCode', 'required');
        
        if(($this->form_validation->run() == true)){
            $companyData = array(
                'vic_industry_sector'=>$this->input->post('industry'),
                'vic_companyname'=>$this->input->post('companyname'),
                'vic_companyheadquarters'=>$this->input->post('headquarter'),
                'vic_address_details'=>$this->input->post('address'),
                'vic_companycity'=>$this->input->post('city'),
                'vic_country_name'=>$this->input->post('country'),
                'vic_zip_code'=>$this->input->post('zipCode'),
            );
            
            $companyId = $this->profile->insert_update_company($this->userID,$companyData);
            if($companyId){
                
                $this->session->set_flashdata('flash_success', 'Company updated successfully');
                
                if($this->session->userdata('redirect_url')){
                    $url = $this->session->userdata('redirect_url');
                    $this->session->unset_userdata('redirect_url');
                    redirect($url);
                }
            }else{
                $this->session->set_flashdata('flash_error','Company name duplication not allowed.');
            }
        }else{
            $error =(array) validation_errors(); 
            $msg = implode(" ",$error);
            $msg  = strip_tags($msg);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
        redirect('profile_setting');
    }
    public function update_password(){
        if(!$this->userID){
            redirect('login');
        }
        $this->form_validation->set_rules('old_password', 'Old Password', 'required'); 
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/]'); 

        if(($this->form_validation->run() == true) ){
            //check old password matches with our db password
            $check = $this->profile->check_password(md5($this->input->post('old_password')),$this->userID);
            if($check){
                //update new password
                $update = $this->profile->update_password(md5($this->input->post('new_password')),$this->userID);
                if($update){
                    $this->session->set_flashdata('flash_success', 'Password updated successfully');
                }
            }else{
                $this->session->set_flashdata('flash_error', 'Old password does not match');
            }
        }else{
            $error =(array) validation_errors(); 
            $msg = implode(" ",$error);
            $msg  = strip_tags($msg);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
        redirect('profile_setting');
    }
    public function change_password(){

        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]'); 
        $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[new_password]');

        if($this->form_validation->run() == true){
            $new_password = $this->input->post('new_password');
            
            if($this->userID){
                $update = $this->profile->reset_password(md5($new_password),$this->userID);
                if($update){
                    $this->session->set_flashdata('flash_success', 'Password changed successfully.');
                }else{
                    $this->session->set_flashdata('flash_error', 'Something went wrong. Please try again.');
                }
            }else{
                $this->session->set_flashdata('flash_error', 'Seesion time out. Please login.');
                redirect('login');
            }
            
        }else{
            $error =(array) validation_errors(); 
            $msg = implode(" ",$error);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
        redirect('profile_setting');
    }
    private function check_status()
    {
        $status = $this->user->get_payment_status( $this->userID);
        if($status){
            if($status['0']->vic_user_details_payment_status == 'paid'){
                $this->session->set_userdata('payment_status', 'paid');

                $plan = $this->user->get_plan_id_by_user( $this->userID);

                $planid = $plan['0']->fk_plan_id;

                $this->session->set_userdata('payment_status', $planid); 
            }else{
                $this->session->set_userdata('payment_status', 'unpaid');
            }
        }
    }
    public function get_country_code(){
        $country = $this->input->post('country');
        $code = $this->profile->get_country_code($country);
        echo json_encode(array('code'=>$code,'res'=>'true')); exit;
    }
    public function check_company(){
        $this->form_validation->set_rules('companyName', 'Company Name', 'required|trim|is_unique[vic_company.vic_companyname]'); 
        if($this->form_validation->run() == true){
            echo json_encode(array('status'=>'true'));
        }else{
            echo json_encode(array('status'=>'false'));
        }
    }
}