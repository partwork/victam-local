<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PricingController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('zoho');
        $this->load->model('pricing_model');
        $this->load->model('company');
        $this->load->model('user');
        $this->userId = $this->session->userdata('userId');
    }
	
	public function index(){
        try {
            $this->load_Pricing_View();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
 
    public function load_Pricing_View(){
        $data['activePage'] = "home";
        $this->getPlanstoDB();
        $data['plans'] = $this->pricing_model->get_all_plans();
        $this->load->view('css_js_helpers');
        $this->load->view('pricing/p_css_js_helpers');
        $this->load->view('pricing/pricing', $data);
    }
    public function getPlanstoDB(){
        try{
            if ($this->zoho->isValidAccessToken()== false) {
                $this->zoho->generateAccessTokenFromRefreshToken();
            }
            $data = $this->zoho->getAllPlanstoDB();

            // var_dump($data);

        }catch(Exception $e){
            return $e;
        }
    }
    public function productsList(){
        try{
            if ($this->zoho->isValidAccessToken()== false) {
                $this->zoho->generateAccessTokenFromRefreshToken();
            }
            $data = $this->zoho->getAllProducts();

            var_dump($data);
            exit;
        } catch (ZohoOAuthException $e) {
        }
    }
    public function freePlan(){
        if($this->session->userdata('free_plan') == 'false'){
            redirect($_SERVER['HTTP_REFERER']);exit;
        }
        if($this->userId){
            $users = $this->pricing_model->get_user_info($this->userId);
            if( $users['0']->vic_user_firstname != null){ 
                
                $plans = $this->pricing_model->get_plan_details(1);
                $newSubscription = array(
                    'customer' =>
                        array (
                            'display_name'=> $users['0']->vic_user_firstname,
                            'first_name' => $users['0']->vic_user_firstname,
                            'last_name' => $users['0']->vic_user_lastname,
                            'email'=> $users['0']->user_email,
                            'payment_terms' => 1,
                        ),
                    'plan' =>
                        array (
                            'plan_code' => '000'.$plans['0']->vic_pricing_plan_code,
                            'plan_description' => $plans['0']->vic_pricing_description,
                            'price' => $plans['0']->vic_pricing_amount,
                        ),
                    
                );
                if($users[0]->vic_company_idvic_company){
                    $company = $this->company->get_company_detail_by_id($users[0]->vic_company_idvic_company);
                    $company_name = $company->vic_companyname;
                    $newSubscription['customer']['company_name'] = $company_name;
                }
                if ($this->zoho->isValidAccessToken()== false) {
                    $this->zoho->generateAccessTokenFromRefreshToken();
                }
                //call api to get response

                $result = $this->zoho->create_subscription($newSubscription);
                $d = $result->subscription;
    
                if($result->code == 0){
                    $this->db->set('vic_user_details_payment_status', 'paid');
                    $this->db->where('vic_users_iduser_details', $this->userId);
                    $this->db->update('vic_user_details');
                    $this->session->set_userdata('plan_id', '1');
                    $this->session->set_userdata('free_plan', 'false');
                    $this->session->set_flashdata('flash_success','Basic plan purchase');
                    redirect('pricing');
                }
            }else{
                redirect('profile_setting');
            }
            redirect('');
        }else{
            return redirect('login');
        }
    }
    public function get_hosted_paymentpage()
    {
        try{
            if (!$this->session->userdata('userId')) {
                redirect('register');
            }
            if ($this->zoho->isValidAccessToken()== false) {
                $this->zoho->generateAccessTokenFromRefreshToken();
            }

            $id = $this->session->userdata('userId');

            $planid = $this->uri->segment('4');
            
            $plans = $this->pricing_model->get_plan_details($planid);

            $users = $this->pricing_model->get_user_info($id);
            if( $users['0']->vic_user_firstname != null){  
                $passData = array (
                    'customer' =>
                    array (
                        'display_name'=> $users['0']->vic_user_firstname,
                        'first_name' => $users['0']->vic_user_firstname,
                        'last_name' => $users['0']->vic_user_lastname,
                        'email'=> $users['0']->user_email,
                        'payment_terms' => 1,
                        'payment_terms_label' => 'Due On Receipt',
                    ),
                    'plan' =>
                    array (
                    'plan_code' => '000'.$plans['0']->vic_pricing_plan_code,
                    'plan_description' => $plans['0']->vic_pricing_description,
                    'price' => $plans['0']->vic_pricing_amount,
                    'quantity' => 1,
                    'exclude_trial' => false,
                    'exclude_setup_fee' => false,
                    'billing_cycles' => -1,
                    'trial_days' => 0,
                    ),
                    'starts_at' => date('Y-m-d'),
                );
    
                if ($this->zoho->isValidAccessToken()== false) {
                    $this->zoho->generateAccessTokenFromRefreshToken();
                }
                //call api to get response
    
                $result = $this->zoho->get_hostedpage($passData);
    
                if($result->code != 0){
                    redirect('pricing');
                }else{
                     redirect($result->hostedpage->url);
                }   
            }else{
                redirect('profile');
            }
        }catch(Exception $e){
            return $e;
        }
    }

    public function paymentSucess(){
        // api json data will output an array with all your parameters.
        $this->input->raw_input_stream;
        $input_data = json_decode($this->input->raw_input_stream, true);

        if(isset($input_data['event_id'])){
            //from event_id get the details
            if ($this->zoho->isValidAccessToken()== false) {
                $this->zoho->generateAccessTokenFromRefreshToken();
            }
            // $result = $this->zeho->retrieveEvent($request->event_id);
            $d = $input_data['data']['subscription'];
            
            $plan_code = $d['plan']['plan_code'];
            $email = $d['customer']['email'];
            $plan = $this->pricing_model->get_plan($plan_code);
            $user = $this->user->get_user($email);
             
            if($plan && $user){
                $userID = $user->iduser_details;
                
                //first add subscription from response
                $orderData = array(
                    'vic_stripe_orders_subscription_id'=>$d['subscription_id'],
                    'vic_stripe_orders_status'=>$d['status'],
                    'stripe_order_amount'=>$d['amount'],
                    'stripe_order_created_on'=>$d['created_at'],
                    'vic_stripe_orders_plan_start_dt' =>$d['current_term_starts_at'],
                    'vic_stripe_orders_plan_end_dt'=>$d['current_term_ends_at'],
                    'stripe_order_currency' =>(isset($d['currency_code']) && ($d['currency_code']!='')) ? $d['currency_code'] : NULL,
                    'vic_stripe_orders_currency_symbol' =>(isset($d['currency_symbol']) && ($d['currency_symbol']!='')) ? $d['currency_symbol'] : NULL,
                    // 'customer_id' =>$d['customer_id'],
                    'fk_plan_id' =>$plan->idvic_pricing_plans,
                    'fk_user_id' => $userID,
                    'vic_stripe_orders_subscription_number' =>$d['subscription_number'],
                    'vic_stripe_orders_job_count' => ($plan->idvic_pricing_plans==4 || $plan->idvic_pricing_plans==6) ? 1 : 0,
                );
                    
                $response = $this->pricing_model->add_payment_details($orderData);
                

                $this->db->set('vic_user_details_payment_status', 'paid');
                $this->db->where('vic_users_iduser_details', $userID);
                $this->db->update('vic_user_details');
                $this->session->set_userdata('plan_id', $plan->idvic_pricing_plans); 
                
                return "subscription created";

                // return $this->response(array('message: '. 'subscription created'));
            }else{
                 return "failed to create subscription";

                // return $this->response(array('message: '. 'failed to create subscription'));
            }     
        }else{
            return "failed to create subscription";
            // return $this->response(array('message: '. 'failed to create subscription'));
        }
    }
}