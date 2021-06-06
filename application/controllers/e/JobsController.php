<?php defined('BASEPATH') or exit('No direct script access allowed');

include 'config/IsRegisteredController.php';

class JobsController extends IsRegisteredController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('job_model');
        $this->load->model('country_model');
        $this->load->model('sector_model');
        $this->userID = $this->session->userdata('userId');
        $this->load->model('SES_model');
        $this->load->model('user'); 
        $this->load->model('Whoiswho_model');
    }
    public function index()
    {
        try {
            if ($this->input->post('action') == 'addJobVacancy') {
                $this->add_Job_Vacancy();
            } elseif ($this->input->post('action') == 'applyJob') {
                $this->applyJob();
            } else {
                exit();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_vacancies_view()
    {
        $data['activePage'] = "jobs";
        if (($this->input->post('display')) != NULL)  $display = $this->input->post('display');
        else $display = NULL;
        if (($this->input->post('country')) != NULL)  $country = $this->input->post('country');
        else $country = NULL;
        if ($this->userID) {
            $id = $this->session->userdata('userId');
            $data['jobs'] = $this->job_model->getJobList();
            $data['active'] = $this->job_model->get_activeJobList($id);
            $data['inactive'] = $this->job_model->get_inactiveJobList($id);
            $data['countries'] = $this->country_model->getCountryList();
            $data['sectors'] = $this->sector_model->getSectorList();
            $this->load->view('css_js_helpers');
            $this->load->view('jobs/vacancies/v_css_js_helpers');
            $this->load->view('jobs/vacancies/vacancies', $data);
        } else {
            redirect('');
        }
    }
    public function job_filter(){
        if ($this->session->userdata('plan_id') == 2 || $this->session->userdata('plan_id') == 3) {
            $display = $this->uri->segment(3);
            $country = $this->uri->segment(4);
            $search = $this->uri->segment(5);
            $search = str_replace('-', '', $search);
            $data['activePage'] = "jobs";
            $data['jobs'] = $this->job_model->getJobFilterList($display, $country, $search);
            $data['countries'] = $this->country_model->getCountryList();
            $data['sectors'] = $this->sector_model->getSectorList();
            $data['display'] = $display;
            $data['searchCountry'] = $country;
            $data['search'] = $search;

            $this->load->view('css_js_helpers');
            $this->load->view('jobs/vacancies/v_css_js_helpers');
            $this->load->view('jobs/vacancies/vacancies', $data);
        } else {
            redirect('register');
        }
    }
    public function job_filter_list(){
        try {
            if ($this->input->is_ajax_request()) {
                $result = $this->job_model->get_job_filter_list($_POST);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function load_place_job_view(){
        if ($this->session->userdata('plan_id')) {
            $data['activePage'] = "jobs";
            $data['countries'] = $this->country_model->getCountryList();
            $data['sectors'] = $this->sector_model->getSectorList();
            if($this->uri->segment(3)){
                $jobId = $this->uri->segment(3);
                $data['job'] = $this->job_model->get_job_info_by_id($jobId);
            }
            $userInfo = $this->user->user_details($this->userID);
            if(!empty($userInfo) && $userInfo->vic_company_idvic_company)
                $data['company'] = $this->Whoiswho_model->get_company_info_by_id($userInfo->vic_company_idvic_company);
            

            $this->load->view('css_js_helpers');
            $this->load->view('jobs/vacancies/v_css_js_helpers');
            $this->load->view('jobs/place-job/place-job', $data);
        } else {
            redirect('');
        }
    }
    public function add_Job_Vacancy()
    {
        if ($this->userID == NULL) {
            return redirect('register');
        }
        $companyID = "";
        $user = $this->user->user_details($this->userID);
        if(!empty($user) && $user->vic_company_idvic_company){
            $companyID = $user->vic_company_idvic_company;
        }
        if($companyID == NULL || $companyID == ""){
            redirect('who_Is_Who/add-company');
        }
        $this->form_validation->set_rules('cName', 'Company Name', 'required');
        $this->form_validation->set_rules('jobDescription', 'Job Description', 'required');
        $this->form_validation->set_rules('responsibilities', 'Responsibility', 'required');
        $this->form_validation->set_rules('skill', 'Skills', 'required');
        $this->form_validation->set_rules('education', 'education', 'required');
        $this->form_validation->set_rules('designation', 'Position', 'required');
        // $this->form_validation->set_rules('salary', 'Salary', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');

        if ($this->form_validation->run() == true) {

            $jobData = array(
                'vic_jobsdesignation' => $this->input->post('designation'),
                'vic_jobsdescription' => $this->input->post('jobDescription'),
                'vic_jobsresponsibilties' => $this->input->post('responsibilities'),
                'vic_jobslocation' => $this->input->post('location'),
                'vic_jobssalary' => ($this->input->post('salary')) ? $this->input->post('salary') : NULL,
                'vic_jobscontact' => $this->input->post('email'),
                'vic_jobsskills' => $this->input->post('skill'),
                'vic_jobseducation' => $this->input->post('education'),
                'vic_company_idvic_company' => $companyID,
                'vic_industry_sector_id' => $this->input->post('sector'),
                'vic_company_name' => $this->input->post('cName'),
                'vic_user_id' => $this->session->userdata('userId')
            );
            if($this->input->post('jobID')){
                //update table
                $jobID = $this->input->post('jobID');
                $jobId = $this->job_model->update($jobData,$jobID);
                $this->session->set_flashdata('flash_success', 'Job updated successfully');

            }else{
                $jobData['vic_job_status'] = 'active';
                //insert
                $jobId = $this->job_model->insert($jobData);

                if($jobId){
                    //if user plan is 4 decrement job_count value
                    if($this->session->userdata('job_plan') == 'true'){
                        $result = $this->job_model->job_plan_update($this->userID);
                        
                        if($result)
                            $this->session->set_userdata('job_plan', 'false');
                    }
                    $this->session->set_flashdata('flash_success', 'Job added successfully');

                }
            }
            
            if ($jobId == 'false') {
                $this->session->set_flashdata('flash_error','Some problems occured, please try again.');
                redirect('jobs/place-job');
            }
            $email = $this->input->post('email');
            $content = 'Your job '. $this->input->post('designation') .' is successfully added on the Victam portal';
            $this->SES_model->sharedmail($email, $content);
            redirect('jobs/vacancy');
        } else {
            $error =(array) validation_errors(); 
            $msg = implode("",$error);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
    }
    public function applyJob()
    {
        if ($this->userID == NULL) {
            return redirect('register');
        }
        
        $this->form_validation->set_rules('cName', 'Contact Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'vic_job_contactname' => $this->input->post('cName'),
                'vic_job_emailid' => $this->input->post('email'),
                'vic_job_phonenumber' => $this->input->post('phone'),
                'vic_job_current_company' => ($this->input->post('company') != NULL) ? $this->input->post('company') : "",
                'vic_job_title' => ($this->input->post('designation') != NULL) ? $this->input->post('designation') : NULL,
                'vic_job_country' => $this->input->post('country'),
                // 'vic_job_created_at'=>date('Y-m-d H:i:s'),
                'vic_jobs_id' => $this->input->post('jobId'),
                'vic_job_userid' => $this->userID
            ); 
            $jobApplyId = $this->job_model->applyJob($data);
            
            if ($jobApplyId == 'false'){
                $this->session->set_flashdata('flash_error','Some problems occured, please try again.');
            }
            else{
                $jobId = $this->input->post('jobId');
                $result = $this->job_model->get_job_info_by_id($jobId);
                $email = $result['0']->vic_jobscontact;
                $name = $this->input->post('cName');
                $jobname = $result['0']->vic_jobsdesignation;

                $reqemail =  $this->input->post('email');
                $reqmobile = $this->input->post('phone');
                $reqdesignation = ($this->input->post('designation') != NULL) ? $this->input->post('designation') : NULL;
                $type = 'job';

                $this->SES_model->send_mail_contactus($email, $name, $jobname, $reqemail, $reqmobile, $reqdesignation, $type);
                $this->session->set_flashdata('flash_success', 'Job applied successfully');
                
            }
        } else {
            $error =(array) validation_errors(); 
            $msg = implode("",$error);
            $msg = trim(preg_replace('/\s\s+/', ' ', $msg));
            $this->session->set_flashdata('flash_error',$msg);
        }
        redirect('jobs/vacancy', $data);
    }

    public function get_job_info_by_id()
    {
        try {
            $id = $this->uri->segment(3);
            $data = $this->job_model->get_job_info_by_id($id);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function job_status_update()
    {
        try {
            if ($this->input->is_ajax_request()) {
                $id = $this->uri->segment(3);
                $status = $this->uri->segment(4);
                $result = $this->job_model->job_status_update($id, $status);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete_job_by_id($id)
    {
        try {
            if ($this->input->is_ajax_request()) {
                $id = $this->uri->segment(3);
                $result = $this->job_model->delete_job_by_id($id);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_job_details_by_id($id)
    {
        try {
            if ($this->input->is_ajax_request()) {
                $id = $this->uri->segment(3);
                $data['activePage'] = "jobs";
                $data['countries'] = $this->country_model->getCountryList();
                $data['sectors'] = $this->sector_model->getSectorList();
                $data['jobs'] = $this->job_model->get_jobs_by_id($id);
                $this->load->view('css_js_helpers');
                $this->load->view('jobs/vacancies/v_css_js_helpers');
                $this->load->view('jobs/place-job/place-job', $data);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_job_details()
    {
        try {
            $companyID = $this->session->userdata('companyId');
            
            $jobData = array(
                'vic_jobsdesignation' => $this->input->post('designation'),
                'vic_jobsdescription' => $this->input->post('jobDescription'),
                'vic_jobsresponsibilties' => $this->input->post('responsibilities'),
                'vic_jobslocation' => $this->input->post('location'),
                'vic_jobssalary' => $this->input->post('salary'),
                'vic_jobscontact' => $this->input->post('email'),
                'vic_jobsskills' => $this->input->post('skill'),
                'vic_jobseducation' => $this->input->post('education'),
                'vic_company_idvic_company' => $companyID,
                'vic_industry_sector_id' => $this->input->post('sector'),
                'vic_company_name' => $this->input->post('cName'),
                'vic_job_status' => 'active',
                'vic_user_id' => $this->session->userdata('userId')
            );

            $result = $this->job_model->update_job_details(array('idvic_promoted_video' => $this->input->post('idvic_jobs')), $$jobData);

            if ($result == true) {
                $data = (array('status' => 'updated'));
            } else if ($result == false) {
                $data = (array('status' => 'failed'));
            } else {
                $data = (array('status' => 'went wrong'));
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function change_status(){
        $jobID = $this->input->post('jobID');
        $status = $this->input->post('status');

        $jobData = array('vic_job_status'=>$status);
        $jobId = $this->job_model->update($jobData,$jobID);
        if($jobId)
            echo json_encode(array('msg'=>'success'));
        else
            echo json_encode(array('msg'=>'error'));
    }
    public function delete_job(){
        $jobID = $this->input->post('jobID');
        
        $result = $this->job_model->delete_job($jobID);
        if($result)
            echo json_encode(array('msg'=>'success'));
        else
            echo json_encode(array('msg'=>'error'));
    }
}
