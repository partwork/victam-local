<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH.'/vendor/autoload.php';

class LoginController extends CI_Controller
{
    public function __construct(){
       parent::__construct();
       // Load form validation ibrary & user model 
       $this->load->library('form_validation'); 
       $this->load->model('user'); 
       $this->load->library('facebook');
        
       // User login status 
       $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 

    public function index()
    {
        try {
            if($this->input->post('action') == 'Sign In'){
                $this->login();
            }else if($this->input->post('logout')){
               $this->logout();
            }
            $this->load_login_View();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_login_View(){

        if(!$this->isUserLoggedIn){
            $google_client = new Google_Client();

            $this->google_auth($google_client);

            $google_client->addScope('email');

            //google login setup
            $login_button = '<a href="'.$google_client->createAuthUrl().'"><img class="social-icon" src="'.base_url().'application/assets/shared/img/icon/google.png"" /></a>';
            $data['login_button'] = $login_button;

            $this->load->view('css_js_helpers');
            $this->load->view('./login/login_css_js_helpers');
            $this->load->view('./login/Login', $data);
        }else{
            redirect('');
        }

    }
    public function login(){ 
        $data = array(); 
         
        // Get messages from the session 
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
         
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
             
            if($this->form_validation->run() == true){ 
                $con = array( 
                    'returnType' => 'single', 
                    'conditions' => array( 
                        'user_email'=> $this->input->post('email'), 
                        'user_password' => md5($this->input->post('password')),
                        'vic_user_isDelete'=>0,
                        /*'vic_user_status'=>'active'*/
                    )  
                ); 
                $checkLogin = $this->user->getRows($con);
                if($checkLogin){ 
                    $user_details = $this->user->user_details($checkLogin['iduser_details']);
                    $companyID = (!empty($user_details)) ? $user_details->vic_company_idvic_company : 0;
                    if($user_details->vic_user_role!=NULL && $user_details->vic_user_status!='active'){
                        redirect('login');
                        exit;
                    }
                    $this->session->set_userdata('isUserLoggedIn', TRUE);
                    $this->session->set_userdata('isUserRegistered', TRUE);
                    $this->session->set_userdata('userPlan', 'Registred');
                    $this->session->set_userdata('userId', $checkLogin['iduser_details']); 
                    $this->session->set_userdata('usertype', $checkLogin['vic_user_role']);
                    $this->session->set_userdata('companyId', $companyID);
                    $this->session->set_userdata('email', $this->input->post('email'));

                    $this->check_status();
                    // print_r($this->session->userdata); exit;
                    $this->role_base_redirect();
                }else{ 
                    $msg = 'Wrong email or password, please try again.'; 
                } 
            }else{ 
                $msg = 'Please fill all the mandatory fields.'; 
            } 
            $this->session->set_flashdata('error',$msg);
           redirect('login'); 
    }
    public function logout(){ 
        $this->session->unset_userdata('isUserLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->unset_userdata('isUserRegistered'); 
        $this->session->unset_userdata('userPlan'); 
        $this->session->unset_userdata('usertype'); 
        $this->session->unset_userdata('companyId'); 
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('access_token'); 
        $this->session->unset_userdata('success_msg'); 
        $this->session->unset_userdata('payment_status'); 
        $this->session->unset_userdata('plan_id'); 
        $this->session->unset_userdata('free_plan'); 
        $this->session->unset_userdata('job_plan'); 
        $this->session->unset_userdata('matchmaking_plan'); 

        if ($this->session->flashdata('flash_success')){
            $this->session->set_flashdata('flash_success', $this->session->flashdata('flash_success'));
        }
        // $this->session->sess_destroy(); 
        redirect('login'); 
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
                        $this->session->set_userdata('companyId', $companyID);
                        $this->session->set_userdata('email', $data['email']);
                        $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                        $this->check_status();
                        redirect('profile'); 
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
                        
                        $user_details = $this->user->user_details($checkLogin['iduser_details']);
                        $companyID = (!empty($user_details)) ? $user_details['vic_company_idvic_company'] : 0;
                        $this->session->set_userdata('userId', $checkLogin['iduser_details']);
                        $this->session->set_userdata('email', $checkLogin['user_email']);

                        $this->check_status();
                        
                        $userDetails = $this->user->user_details($checkLogin['iduser_details']);
                        if($userDetails){                         
                            redirect();
                        }else{
                            $this->session->set_userdata('isUserRegistered', TRUE);
                            redirect('profile');
                        }
                    }
                }
            }else{
                $this->load_login_View();
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
                $this->session->set_userdata('email', $data['email']);
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
                $this->session->set_userdata('email', $checkLogin['user_email']);

                
                $user_details = $this->user->user_details($checkLogin['iduser_details']);
                $companyID = (!empty($user_details)) ? $user_details['vic_company_idvic_company'] : 0;
                $this->session->set_userdata('userId', $checkLogin['iduser_details']); 
                $this->check_status();
                $userDetails = $this->user->user_details($checkLogin['iduser_details']);
                if($userDetails){                         
                    redirect();
                }else{
                    $this->session->set_userdata('isUserRegistered', TRUE);
                    redirect('profile');
                }
            }
        }
        
        $this->load_login_View($data);

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

    private function role_base_redirect(){
        switch ($this->session->userdata('usertype')) {
            case "super admin":
                redirect('admin');
                break;

            case "admin":
                redirect('admin');
                break;

            case "publisher - moderator":
                redirect('admin');
                break;

            case "content moderator":
                redirect('admin');
                break;

            case "":
                $userDetails = $this->user->user_details($this->session->userdata('userId'));
                if($userDetails){  
                    redirect('');
                }else{
                    redirect('profile');
                }
                break;

            default:
            $this->session->set_flashdata('error', 'Check Username and password');
            $this->session->sess_destroy();
            redirect(base_url('?sessionout-rolebase'));            
        }
    }


    private function check_status()
    {
        $id = $this->session->userdata('userId');

        $status = $this->user->get_payment_status($id); 
        if($status){
            if($status['0']->vic_user_details_payment_status == 'paid'){
                $this->session->set_userdata('payment_status', 'paid');

                $plan = $this->user->get_plan_id_by_user($id);
                
                if(!empty($plan)){
                    $planid = $plan['0']->fk_plan_id;
                    $this->session->set_userdata('plan_id', $planid); 
                }
                
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