<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH.'vendor\autoload.php';

class RegisterController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load form validation ibrary & user model 
        $this->load->library('form_validation'); 
        $this->load->model('user'); 
        $this->load->library('facebook');
        $this->load->model('SES_model');
        // User login status 
        $this->isUserRegistered = $this->session->userdata('isUserRegistered');    
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    }
	
	public function index(){
        try {
            if($this->input->post('action') == 'Sign Up'){
                $this->register();
            }
            $this->loadRegisterView();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function loadRegisterView($data = NULL){

        if(!$this->isUserLoggedIn){
            $google_client = new Google_Client();

            $this->google_auth($google_client);

            $google_client->addScope('email');

            //google login setup
            $login_button = '<a href="'.$google_client->createAuthUrl().'"><img class="social-icon" src="'.base_url().'application/assets/shared/img/icon/google.png"" /></a>';
            $data['login_button'] = $login_button;


            $this->load->view('css_js_helpers');
            $this->load->view('register/register_css_js_helpers');
            $this->load->view('register/register', $data);
        }else{
            redirect('');
        }
    }
    protected function register(){
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        }

        $data = $userData = array(); 
         
        // If registration request is submitted 
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check'); 
        $this->form_validation->set_rules('password', 'password', 'required'); 
        $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 

        if($this->form_validation->run() == true){
            $userData = array(
                'user_email' => strip_tags($this->input->post('email')), 
                'user_password' => md5($this->input->post('password')),
            ); 
            $insert = $this->user->insert($userData); 
            if($insert){
                $this->session->set_userdata('isUserRegistered', TRUE); 
                $this->session->set_userdata('userId', $insert);
                $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                $this->session->set_userdata('email', $this->input->post('email'));
                $this->check_status();
                $this->SES_model->sendwelcome($this->input->post('email'));
                redirect('profile'); 
            }else{ 
                $data['error_msg'] = 'Some problems occured, please try again.'; 
            } 
        }else{
            $error = validation_errors();
            $this->session->set_flashdata('error',$error);
            redirect('register');  
            // $data['error_msg'] = 'Please fill all the mandatory fields.'; 
        } 
        
        // Posted data 
        $data['user'] = $userData; 
        
        // $this->loadRegisterView($data);  
        // Load view 
        // $this->load->view('css_js_helpers');
        // $this->load->view('register/register_css_js_helpers');
        // $this->load->view('register/register', $data);
    }
    // Existing email check during validation 
    public function email_check($str){
        $con = array(
            'returnType' => 'count', 
            'conditions' => array( 
                'user_email' => $str 
            ) 
        ); 
        $checkEmail = $this->user->getRows($con); 
        if($checkEmail > 0){ 
            $this->form_validation->set_message('email_check', 'The given email already exists.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    }


    public function login_via_google()
    {   
        $google_client = new Google_Client();

        $this->google_auth($google_client);

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if(isset($_GET["code"])){
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if(!isset($token["error"])){
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();
                $emailCheck = $this->email_check($data['email']);

                if($emailCheck){
                    $password = 123456;
                    $userData = array(
                        'user_email' => strip_tags($data['email']), 
                        'user_password' => md5($password),
                    ); 
                    $insert = $this->user->insert($userData); 
                    if($insert){
                        $this->session->set_userdata('isUserRegistered', TRUE); 
                        $this->session->set_userdata('userId', $insert);
                        $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                        $this->session->set_userdata('email', $data['email']);
                        $this->SES_model->sendwelcome($data['email']);
                        $this->check_status();
                        redirect('profile'); 
                    }else{ 
                        $data['error_msg'] = 'Some problems occured, please try again.'; 
                    }
                }else{
                    $con = array( 
                        'returnType' => 'single', 
                        'conditions' => array( 
                            'user_email'=> $data['email']
                         ) 
                    ); 
                    $checkLogin = $this->user->getRows($con);
                    if($checkLogin){ 
                        $this->session->set_userdata('isUserLoggedIn', TRUE);
                        $this->session->set_userdata('userPlan', 'Registred');
                        $this->session->set_userdata('userId', $checkLogin['iduser_details']);
                        $this->session->set_userdata('email', $data['email']);
                        $userDetails = $this->user->user_details_by_id($checkLogin['iduser_details']);
                        $this->check_status();
                        if($userDetails){                         
                            redirect();
                        }else{
                            redirect('profile');
                        }
                    }
                }
                $this->loadRegisterView($data);
                
            }else{
                $this->loadRegisterView();
            }
        }
    }   

    public function login_via_facebook()
    {
                //facebook login setup
        $data = $this->facebook->request('get', '/me?fields=id,name,email');
        
        $emailCheck = $this->email_check($data['email']);

        if($emailCheck){
            $password = 123456;
            $userData = array(
                'user_email' => strip_tags($data['email']), 
                'user_password' => md5($password),
            ); 
            $insert = $this->user->insert($userData); 
            if($insert){
                $this->session->set_userdata('isUserRegistered', TRUE); 
                $this->session->set_userdata('userId', $insert);
                $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                $this->check_status();
                redirect('profile'); 
            }else{ 
                $data['error_msg'] = 'Some problems occured, please try again.'; 
            }
        }else{
            $con = array( 
                'returnType' => 'single', 
                'conditions' => array( 
                    'user_email'=> $data['email']
                ) 
            ); 
            $checkLogin = $this->user->getRows($con);
            if($checkLogin){ 
                $this->session->set_userdata('isUserLoggedIn', TRUE);
                $this->session->set_userdata('userPlan', 'Registred');
                $this->session->set_userdata('userId', $checkLogin['iduser_details']); 
                $this->session->set_userdata('email', $data['email']);
                $this->SES_model->sendwelcome($data['email']);
                $userDetails = $this->user->user_details_by_id($checkLogin['iduser_details']);
                $this->check_status();
                if($userDetails){                         
                    redirect();
                }else{
                    redirect('profile');
                }
            }
        }
        
        $this->loadRegisterView($data);

    }

    public function login_via_linkedIn()
    {
  
       
    } 

    private function google_auth($google_client)
    {
        $google_client->setClientId($this->config->item('setClientId')); //Define your ClientID

        $google_client->setClientSecret($this->config->item('setClientSecret')); //Define your Client Secret Key
      
        $google_client->setRedirectUri($this->config->item('setRedirectUri')); //Define your Redirect Uri
    }
    private function check_status()
    {
        $id = $this->session->userdata('userId');

        $status = $this->user->get_payment_status($id);// print_r($status);
        if($status){
            if($status['0']->vic_user_details_payment_status == 'paid'){
                $this->session->set_userdata('payment_status', 'paid');

                $plan = $this->user->get_plan_id_by_user($id);
                // print_r($plan);exit;
                $planid = $plan['0']->fk_plan_id;

                $this->session->set_userdata('plan_id', $planid); 
            }else{
                $this->session->set_userdata('payment_status', 'unpaid');
                echo 'unpaid';
            }
        }

        //check user has tried free plan - free plan only once can be used
        $result = $this->user->free_plan_status($id);
        if($result){
            $this->session->set_userdata('free_plan', 'false');
        }else{
            $this->session->set_userdata('free_plan', 'true');
        }

        //if user have 4 plan
        $plan = $this->user->job_plan_status($id);
        if($plan){
            if($plan->vic_stripe_orders_job_count > 0)
                $this->session->set_userdata('job_plan', 'true');
            else
                $this->session->set_userdata('job_plan', 'false');
        }else{
            $this->session->set_userdata('job_plan', 'false');
        }

        //if user have matchmaking plan
        $matchmaking = $this->user->matchmaking_plan_status($id);
        if($matchmaking){
            $this->session->set_userdata('matchmaking_plan', 'true');
        }else{
            $this->session->set_userdata('matchmaking_plan', 'false');
        }
    }
}