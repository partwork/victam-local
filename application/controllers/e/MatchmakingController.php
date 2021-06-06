<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MatchmakingController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Matchmaking_model');
        $this->load->model('SES_model');
        $this->load->model('home_model');
        $this->userID = $this->session->userdata('userId');
    }
	
	public function index(){
        try {
            $this->load_matchmaking_view();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_matchmaking_view(){
        $data['activePage'] = "matchmaking"; 
		$data['company_logo'] = $this->home_model->get_active_banner();

        $this->load->view('css_js_helpers');
        $this->load->view('matchmaking/mm_css_js_helpers');
        $this->load->view('matchmaking/matchmaking', $data);
    }
 
    public function load_buyers_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $data['activePage'] = "matchmaking";
            $this->load->view('css_js_helpers');
            $this->load->view('matchmaking/mm_css_js_helpers');
            $this->load->view('matchmaking/find_buyers', $data);
        }
    }
    public function load_suppliers_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $data['activePage'] = "matchmaking";
            $this->load->view('css_js_helpers');
            $this->load->view('matchmaking/mm_css_js_helpers');
            $this->load->view('matchmaking/find_suppliers', $data);
        }
    }
    public function load_buyers_list_view()
    {
        if ( $this->session->userdata('plan_id') == 3 || $this->session->userdata('plan_id') == 2 || $this->session->userdata('matchmaking_plan')=='true') {
            $data['activePage'] = "matchmaking";
            $this->load->view('css_js_helpers');
            $this->load->view('matchmaking/mm_css_js_helpers');
            $this->load->view('matchmaking/buyers_list', $data);
        } else {
            redirect('');
        }
    }

    public function find_new_suppliers()
    {
        try {
                $data['vic_user_details_idvic_user_details'] = $this->session->userdata('userId');
                $data['industriesactive'] = $this->input->post('industriesactive');
                $data['companyprofile'] = $this->input->post('companyprofile');
                $data['tonscount'] = $this->input->post('tonscount');
                $data['companydealwith'] = $this->input->post('companydealwith');
                $data['servicesfor'] = $this->input->post('servicesfor');
                $data['productsServices'] = $this->input->post('ProductsServices');
                $data['importantups'] = $this->input->post('importantups');
                $data['companies'] = $this->input->post('companies');
                $data['investmentmonth'] = $this->input->post('investmentmonths');
                $data['comments'] = $this->input->post('comments');
                $data['source'] = 'find supplier';
                $data['created_on'] = date('Y-m-d H:i:s');
                
                $result = $this->Matchmaking_model->find_new_suppliers($data);
                $res = array('res' => true, 'count' => $result['0']->count);

                //email sent to session user
                $email = $this->session->userdata('email');
                $content = 'We have found '.$result['0']->count.' matches based on your interest. Suppliers will contact you soon';
                $this->SES_model->sharedmail($email, $content);


                //email sent to suppliers
                $output = $this->Matchmaking_model->get_founded_supplier_list($data);

                if($output){
                    foreach($output as $list){
                        $this->SES_model->send_mail_supplier($list->vic_companyemail, $email, $list->vic_companyname);
                    }
                }
                echo json_encode($res);
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function find_new_buyers()
    {
        try {
                $data['vic_user_details_idvic_user_details'] = $this->session->userdata('userId');
                $data['industriesactive'] = $this->input->post('industriesactive');
                $data['companyprofile'] = $this->input->post('companyprofile');
                $data['tonscount'] = $this->input->post('tonscount');
                $data['companydealwith'] = $this->input->post('companydealwith');
                $data['servicesfor'] = $this->input->post('servicesfor');
                $data['productsServices'] = $this->input->post('ProductsServices');
                $data['importantups'] = $this->input->post('importantups');
                $data['companies'] = $this->input->post('companies');
                $data['investmentmonth'] = $this->input->post('investmentmonth');
                $data['comments'] = $this->input->post('comments');
                $data['source'] = 'find buyers';
                $data['created_on'] = date('Y-m-d H:i:s');

                $result = $this->Matchmaking_model->find_new_buyers($data); //print_r($result);exit;

                $industriesactive = implode('","',$this->input->post('industriesactive'));
                $this->session->set_flashdata('industriesactive', $industriesactive);
                $tonscount = implode('","',$this->input->post('tonscount'));
                $this->session->set_flashdata('tonscount', $tonscount);
                $this->session->set_flashdata('companydealwith', $this->input->post('companydealwith'));
                $this->session->set_flashdata('servicesfor', $this->input->post('servicesfor'));
                $importantups = implode('","',$this->input->post('importantups'));
                $this->session->set_flashdata('importantups', $importantups);
                $this->session->set_flashdata('companies', $this->input->post('companies'));
                $this->session->set_flashdata('investmentmonth', $this->input->post('investmentmonth'));
                $this->session->set_flashdata('companyprofile', $this->input->post('companyprofile'));

                $res = array('res' => true, 'count' => $result['0']->count);
                $email = $this->session->userdata('email');
                
                $output = $this->Matchmaking_model->get_founded_buyers_list($data);
                if($output){
                    $this->SES_model->send_matching_mail($email, $output, $result['0']->count);
                }


                echo json_encode($res);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_buyers_list()
    {
        try {
            $ind = $this->input->post('industriesactive');
            $profile = $this->input->post('companyprofile');
            $position = $this->input->post('companydealwith');
            $service = $this->input->post('servicesfor');
            $tonscount = $this->input->post('tonscount');
            $importantups = $this->input->post('importantups');
            $companies = $this->input->post('companies');
            $investmentmonth = $this->input->post('investmentmonth');

            if(isset($ind)){
                $req['industriesactive'] = $ind;
                $req['companyprofile'] = $profile;
                $req['companydealwith'] = $position;
                $req['servicesfor'] = $service;
                $req['tonscount'] = $tonscount;
                $req['importantups'] = $importantups;
                $req['companies'] = $companies;
                $req['investmentmonth'] = $investmentmonth;

            }else{
                $req = null;
            }
            $data = $this->Matchmaking_model->get_buyers_list($req );
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_buyers_list_by_search()
    {
        if($this->session->userdata('plan_id') == 3 || $this->session->userdata('plan_id') == 2 || $this->session->userdata('matchmaking_plan')=='true'){
            try {
                $keyword = $this->uri->segment(3);
                $data = $this->Matchmaking_model->get_buyers_list_by_search($keyword);
                echo json_encode($data);
            } catch (\Throwable $th) {
                throw $th;
            }
        }else{
                echo json_encode(array('status'=>'false'));
        }
    }

    public function get_company_details()
    {
        try {
            $keyword = $this->uri->segment(3);
            $data = $this->Matchmaking_model->get_company_details_by_id($keyword);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filter_buyer_list(){
        if($this->session->userdata('plan_id') == 3 || $this->session->userdata('plan_id') == 2 || $this->session->userdata('matchmaking_plan')=='true'){
            try {
                $ind = $this->input->post('industriesactive');
                $profile = $this->input->post('companyprofile');
                $position = $this->input->post('companydealwith');
                $service = $this->input->post('servicesfor');
                $tonscount = $this->input->post('tonscount');
                $importantUSP = $this->input->post('importantUSP');
                $deliveringCountry = $this->input->post('deliveringCountry');
                
            
                if(isset($ind)){
                    $req['industriesactive'] = $ind;
                    $req['companyprofile'] = $profile;
                    $req['companydealwith'] = $position;
                    $req['servicesfor'] = $service;
                    $req['tonscount'] = $tonscount;
                    $req['vic_important_usp'] = $importantUSP;
                    $req['vic_companies_delivering'] = $deliveringCountry;

                }else{
                    $req = null;
                }
                $data = $this->Matchmaking_model->filter_buyers_list($req );
                echo json_encode($data);
            } catch (\Throwable $th) {
                throw $th;
            }
        }else{
            echo json_encode(array('status'=>'false'));
        }
    }
}
