<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Zoho {
    protected $refreshToken;
    protected $accessToken;
    protected $expiryTime;
    protected $userEmailId;
    protected $zohoUrl;
    protected $organizationid;
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        // $this->CI->load->config();
        // $this->CI->load->library('curl');
        $this->organizationid = $this->CI->config->item('organizationid');
        $this->zohoUrl = $this->CI->config->item('zoho_base_url');
        $this->CI->load->model('oauthtokens_model');
        $this->CI->load->model('pricing_model');

        $data = $this->CI->oauthtokens_model->get_token();
        if($data){
            $this->refreshToken = $data->refreshtoken;
            $this->accessToken = $data->accesstoken;
            $this->expiryTime = $data->expirytime;
            $this->userEmailId = $data->useridentifier;
        }else{
            $this->generateTokens();
        }
    }
    public function generateTokens(){
        
        $grantToken = "1000.e7d2d068b3c061644d1bc62f21efc1fe.43e5f69bf338ab0a2d2262f23f6ff1ff";
        $client_id = $this->CI->config->item('CLIENT_ID');
        $client_secret = $this->CI->config->item('CLIENT_SECRET');
        $redirect_uri = $this->CI->config->item('REDIRECT_URI');
        $auth_url = $this->CI->config->item('ZOHO_AUTH_URL');
        
        $url = $auth_url."grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&code=".$grantToken."&redirect_uri=".$redirect_uri;
        $headers = array('Content-Type:application/json');
        
        $response = $this->curlRequest($url,"POST",$headers);

        $this->accessToken = $response->access_token;
        $this->expiryTime =  round($response->expires_in * 3600) * 1000;
        $expiresIn=$response->expires_in*1000;
        $this->expiryTime = $this->getCurrentTimeInMillis() + $expiresIn;

         $data = array(
             'useridentifier'=>$configuration['userIdentifier'],
             'accesstoken'=>$this->accessToken,
             'refreshtoken'=>$response->refresh_token,
             'expirytime'=>$this->expiryTime
         );
         $create = $this->CI->oauthtokens_model->insert($data);
    }
    public function getAccessToken()
    { 
        if ($this->isValidAccessToken()) {
            return $this->accessToken;
        }
        throw new ZohoOAuthException("Access token got expired!");
    }
    public function isValidAccessToken()
    {
        return ((int)$this->expiryTime - $this->getCurrentTimeInMillis()) > 1000;
    }
    public function getCurrentTimeInMillis()
    {
        return round(microtime(true) * 1000);
    }
    public function generateAccessTokenFromRefreshToken(){

        $client_id = $this->CI->config->item('CLIENT_ID');
        $client_secret = $this->CI->config->item('CLIENT_SECRET');
        $redirect_uri = $this->CI->config->item('REDIRECT_URI');
        $auth_url = $this->CI->config->item('ZOHO_AUTH_URL');

        $url = $auth_url."grant_type=refresh_token&client_id=".$client_id."&client_secret=".$client_secret."&refresh_token=".$this->refreshToken."&redirect_uri=".$redirect_uri;
        $headers = array('Content-Type:application/json');
        
        $response = $this->curlRequest($url,"POST",$headers);
        
        $this->accessToken = $response->access_token;
        $this->expiryTime =  round($response->expires_in * 3600) * 1000;
        $expiresIn=$response->expires_in*1000;
        $this->expiryTime = $this->getCurrentTimeInMillis() + $expiresIn;

        $data = array('accesstoken'=>$this->accessToken,'expirytime'=>$this->expiryTime);
        $updateDb = $this->CI->oauthtokens_model->update($this->userEmailId,$data);
        
    }

    public function curlRequest($url,$method,$headers){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $result = curl_exec($ch);
        $response = json_decode($result);
        curl_close($ch);

        if (isset($json_decode->response->status) && $json_decode->response->status == 'ERROR') 
        {
            die('error occured: ' . $json_decode->response->errormessage);
        }
        return $response ;
    }

    public function getAllPlanstoDB(){
        
        $products = $this->CI->pricing_model->get_all_products();
        foreach($products as $p){
            $data = $this->getAllPlans($p->vic_product_id);
            foreach($data->plans as $d){
                $planExist = $this->CI->pricing_model->get_plan($d->plan_code);
                if(!$planExist){
                    //insert
                    $data = array(
                        'vic_pricing_plan_code' => $d->plan_code,
                        'vic_pricingplanname'=> $d->name,
                        'vic_pricing_amount'=>$d->recurring_price,
                        'vic_pricing_description'=> $d->description,
                        'vic_pricing_product_id'=> $d->product_id,
                        'vic_pricing_status'=> $d->status,
                        'vic_pricing_plan_created_at'=>$d->created_time,
                        'vic_pricing_store_markup_description'=>$d->store_markup_description
                    );

                    $this->CI->pricing_model->insert_plan($data);
                }else{
                    //update
                    $data = array(
                        'vic_pricingplanname'=> $d->name,
                        'vic_pricing_amount'=>$d->recurring_price,
                        'vic_pricing_description'=> $d->description,
                        'vic_pricing_product_id'=> $d->product_id,
                        'vic_pricing_status'=> $d->status,
                        'vic_pricing_store_markup_description'=>$d->store_markup_description
                    );

                    $this->CI->pricing_model->update_plan($data,$d->plan_code);
                }
            }
        }
            
    }
    public function getAllProducts(){
        $url = $this->zohoUrl."products";
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:'.$this->organizationid,
        );

        $data = $this->curlRequest($url,"GET",$headers);
        
        foreach($data->products as $d){
            
            $productExist = $this->CI->pricing_model->get_product($d->product_id);
            if(!$productExist){
                $data = array(
                    'vic_product_id'=>$d->product_id,
                    'vic_product_name' => $d->name,
                    'vic_status'=>$d->status,
                    'vic_created_time'=>$d->created_time
                );
                $this->CI->pricing_model->create_product($data);
            }
        }
    }
    public function getAllPlans($id){
        $url = $this->zohoUrl."plans?filter_by=PlanStatus.ACTIVE&product_id=".$id;
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:'.$this->organizationid,
        );

        $data = $this->curlRequest($url,"GET",$headers);
        return $data;
    }
    public function retrievePlanDetail($code){
        $url = $this->zohoUrl."plans/".$code;
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:'.$this->organizationid,
        );

        $data = $this->curlRequest($url,"GET",$headers);
        return $data;
    }
    public function retrieveEvent($eventId){
        $url = $this->zohoUrl."events/".$eventId;
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:60004948011',
        );
        $response = $this->curlRequest($url,'GET',$headers);
        return $response;
    }
    public function create_subscription($data){
        $url = $this->zohoUrl."subscriptions";
        $response = $this->curlPostRequest($url, $data);
        return $response;
    }
    public function cancel_subscription($id){
        $url = $this->zohoUrl."subscriptions/".$id."/cancel?cancel_at_end=false";
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:'.$this->organizationid,
        );

        $data = $this->curlRequest($url,"POST",$headers);
        return $data;
    }
    public function retrieve_subscription($id){
        $url = $this->zohoUrl."subscriptions/".$id;
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:'.$this->organizationid,
        );

        $response = $this->curlRequest($url,'GET',$headers);
        return $response;
    }
    public function get_hostedpage($data)
    {
        $url = $this->zohoUrl."hostedpages/newsubscription";
        $response = $this->curlPostRequest($url, $data);
        return $response;
    }

    public function curlPostRequest($url,$data){
        $payload = json_encode($data);
        $authorization = 'Zoho-oauthtoken '.$this->accessToken;
        $headers = array (
            'Content-Type:application/json',
            'Authorization:'.$authorization,
            'X-com-zoho-subscriptions-organizationid:20074142766',
        );
        // Prepare new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $response = json_decode($result);
        // Close cURL session handle
        curl_close($ch);
        // return $response;
        if (isset($response->response->status) && $response->response->status == 'ERROR')
        {
            die('error occured: ' . $response->response->errormessage);
        }
        return $response;
    }
}