<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include 'config/IsRegisteredController.php';

class SubscriptionController extends IsRegisteredController {
    public function __construct(){
        parent::__construct();
        $this->load->library('zoho');
        $this->load->model('pricing_model');
        $this->userId = $this->session->userdata('userId');
    }

    public function load_subscription_View(){
        if($this->userId){   
            $response = $this->get_customer_subscription();
            $data['activePage'] = "subscription";
            $data['subscriptions'] = $this->pricing_model->get_subscriptions($this->userId);
            $data['addon_subscriptions'] = $this->pricing_model->get_addOn_subscriptions($this->userId);
            $data['plans'] = $this->pricing_model->get_plans();
           
            $this->load->view('css_js_helpers');
            $this->load->view('manage_subscription/ms_css_js_helpers');
            $this->load->view('manage_subscription/subscription', $data);
                
        }else{
            redirect('login');
        }
    }
    public function get_customer_subscription(){
        try{
            if ($this->zoho->isValidAccessToken()== false) {
                $this->zoho->generateAccessTokenFromRefreshToken();
            }
            //get all active subscription
            $allSubscriptions = $this->pricing_model->get_all_subscriptions($this->userId);
            foreach($allSubscriptions as $s){
                if($s->vic_stripe_orders_subscription_id !=NULL && $s->vic_stripe_orders_subscription_id!=""){
                    $data = $this->zoho->retrieve_subscription($s->vic_stripe_orders_subscription_id);
                    
                    if(!empty($data) && $data->code==0){
                        $r = $data->subscription;
                        $updateData = array(
                            'vic_stripe_orders_status'=> $r->status,
                        );
                        $this->db->where('idvic_stripe_orders', $s->idvic_stripe_orders);
                        $this->db->update('vic_stripe_orders',$updateData);
                    }
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }
    public function cancel_subscription(){
        if($this->userId){   
            $id = $this->uri->segment('2');
            //cancel subscription in zoho
            try{
                if ($this->zoho->isValidAccessToken()== false) {
                    $this->zoho->generateAccessTokenFromRefreshToken();
                }
                $subscription = $this->pricing_model->get_subscription_detail($id,$this->userId);
                if(!empty($subscription) && $subscription->vic_stripe_orders_subscription_id){
                    $data = $this->zoho->cancel_subscription($subscription->vic_stripe_orders_subscription_id);

                    if($data->code == 0){
                        $updateData = array(
                            'vic_stripe_orders_status'=> 'cancelled',
                            'vic_stripe_orders_cancelled_at' => $data->cancelled_at,
                        );
                        $this->db->where('idvic_stripe_orders', $id);
                        $this->db->update('vic_stripe_orders',$updateData);
                        $this->session->set_flashdata('flash_success', 'Subscription cancelled successfully.');
                    }else{
                        $this->session->set_flashdata('flash_error',$data->message);
                    }
                }else{
                    $this->session->set_flashdata('flash_error','Something went wrong..');
                }
                redirect('subscription');

            }catch(Exception $e){
                return $e;
            }
        }else{
            redirect('login');
        }
    }
}