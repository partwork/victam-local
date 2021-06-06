<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'config/IsRegisteredController.php';

class ResourceLibraryController extends IsRegisteredController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ResourceLibrary_model', 'resourcelibrary_model');
        $this->load->model('File_upload_model', 'umodel'); 
        $this->load->model('SES_model');
    }

    public function index()
    {
        try {
            $this->load_resource_library_view();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function load_resource_library_view()
    {
        $data['activePage'] = "resourceLibrary";
        $this->load->view('css_js_helpers');
        $this->load->view('resource-library/rl_css_js_helpers');
        $this->load->view('resource-library/resource-library', $data);
    }

    public function load_research_innovation_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $data['activePage'] = "resourceLibrary";
            $data['name'] = $this->security->get_csrf_token_name();
            $data['hash'] =  $this->security->get_csrf_hash();

            $innovation_list = $this->resourcelibrary_model->get_resource_list('innovation');

            $innovation_list = (!empty($innovation_list)) ? $innovation_list : NULL;
            $data['innovation_list'] = $innovation_list;

            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;

            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/research-innovation', $data);
        }
    }
    public function load_add_innovation_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            /*$casestudy_list = $this->resourcelibrary_model->get_resource_list('case_study');
            $casestudy_list = (!empty($casestudy_list)) ? $casestudy_list : NULL;
            $data['casestudy_list'] = $casestudy_list;*/

            /*$this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/case-studies', $data);*/

            $data['activePage'] = "resourceLibrary";
            $data['name'] = $this->security->get_csrf_token_name();
            $data['hash'] =  $this->security->get_csrf_hash();

            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;

            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/add-innovation', $data);
        }
    }
    function load_add_casestudy_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $data['activePage'] = "resourceLibrary";
            $data['name'] = $this->security->get_csrf_token_name();
            $data['hash'] =  $this->security->get_csrf_hash();

            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;
            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/add-casestudy', $data);
        }
    }
    function load_white_paper_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {

             $whitepapers_list = $this->resourcelibrary_model->get_resource_list('whitepapers');

            $whitepapers_list = (!empty($whitepapers_list)) ? $whitepapers_list : NULL;
            $data['whitepapers_list'] = $whitepapers_list;

            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;

            $data['activePage'] = "resourceLibrary";
            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/white-paper', $data);
        }
    }
    function load_add_white_paper_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;
            $data['activePage'] = "resourceLibrary";
            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/add-white-paper', $data);
        }
    }
    function load_publication_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $publication_list = $this->resourcelibrary_model->get_resource_list('publication');

            $publication_list = (!empty($publication_list)) ? $publication_list : NULL;
            $data['publication_list'] = $publication_list;

            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;
            $data['activePage'] = "resourceLibrary";
            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/publication', $data);
        }
    }
    function load_add_publication_view()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;
            $data['activePage'] = "resourceLibrary";
            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/add-publication', $data);
        }
    }
    public function load_case_studies_view()
    {

        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {

            $data['activePage'] = "resourceLibrary";

            $casestudy_list = $this->resourcelibrary_model->get_resource_list('case_study');
            $casestudy_list = (!empty($casestudy_list)) ? $casestudy_list : NULL;
            $data['casestudy_list'] = $casestudy_list;

            $sector_data = $this->resourcelibrary_model->getSector();
            $data['sector_list'] = (!empty($sector_data)) ? $sector_data : NULL;

            $country_data = $this->resourcelibrary_model->getCountry();
            $data['country_list'] = (!empty($country_data)) ? $country_data : NULL;

            $this->load->view('css_js_helpers');
            $this->load->view('resource-library/rl_css_js_helpers');
            $this->load->view('resource-library/case-studies', $data);
        }
    }
    function store_study()
    {
        
        try {
            $presentation_file_name = uniqid('presentation_');
            $doc_file_name = uniqid('doc_');

            $prentation_path='';
            $doc_path='';
            
            $file_loc='';
            switch ($_POST['type']) {
                case 'case_study':
                    $file_loc='add-casestudy';
                    $content = 'Your case study '.$_POST['title'].' is successfully published on the Victam portal';
                    break;
                case 'innovation':
                    $file_loc='add-innovation';
                    $content = 'Your innovation  '.$_POST['title'].' is successfully published on the Victam portal';
                    break;
                case 'publication':
                    $file_loc='add-publication';
                    $content = 'Your publication '.$_POST['title'].' is successfully published on the Victam portal';
                    break;
                case 'whitepapers':
                    $file_loc='add-white-paper';
                    $content = 'Your whitepaper  '.$_POST['title'].' is successfully published on the Victam portal';
                    break;

            }
            $data = array();
            
            if (isset($_FILES['prentation_file']) && $_FILES['prentation_file']['name'] != '') {
                $result = $this->umodel->do_upload('prentation_file', 'mp4', 'resource_library');
                $prentation_path = $result['file_path'];
                $data['vic_resource_presentation'] = $prentation_path;

                if($result['error']) 
                {
                    $this->session->set_flashdata('category_error', $result['msg']);
                    redirect(base_url('resource-library/'.$file_loc));
                }
            }
               

            if(isset($_FILES['doc_file']) && $_FILES['doc_file']['name']!=''){
                $result = $this->umodel->do_upload('doc_file', 'doc|docx|pdf', 'resource_library');
                $doc_path=$result['file_path'];
                $data['vic_resource_docs'] = $doc_path;
                if ($result['error']) {
                    $this->session->set_flashdata('category_error',$result['msg']);
                    redirect(base_url('resource-library/'.$file_loc));
                }
            }


            $data['vic_resource_librarytype'] = $_POST['type'];
            $data['vic_resource_title'] = $_POST['title'];
            $data['vic_resource_desc'] = $_POST['description'];
            $data['vic_resource_industrysector'] = $_POST['industry'];
            $data['vic_resource_publisher'] = $_POST['publisher'];
            $data['vic_resource_date'] = date('Y-m-d H:i:s', strtotime($_POST['date']));
            $data['vic_updated_at'] = date('Y-m-d H:i:s');
            
            $data['vic_resource_email'] = $_POST['email'];
            $data['vic_resource_region'] = $_POST['region'];
            $data['vic_modification_status'] = 'Under Review';
            //$data['vic_modification_status'] = 'Published';
            
            $data['vic_resource_status'] = 'active';
            

            $result = $this->resourcelibrary_model->add_resources($data, false);
            if ($result) {
                $this->session->set_flashdata('category_success', 'Information updated successfully. It is under review now and will be posted soon.');
                $email = $_POST['email'];
                //$this->SES_model->sharedmail($email, $content);
                redirect(base_url('resource-library/'.$file_loc));
            } else {
                $this->session->set_flashdata('category_error', 'Failed to update information.');
                redirect(base_url('resource-library/'.$file_loc));
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function uploadFile($con)
    {

        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);

        $config['upload_path'] = $con['path'];
        $config['allowed_types'] = $con['type'];
        $config['encrypt_name'] = TRUE;
        // $config['max_size'] = 2000;
        // $config['max_width'] = 1500;
        // $config['max_height'] = 1500;
        if (empty($_FILES[$con['name']]['name'])) {
            return '';
        }
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($con['name'])) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            //$data = array('image_metadata' => $this->upload->data());
            $data = $this->upload->data();
            return $con['orig_path'] . $data['file_name'];
        }
        return $data;
    }

    public function search_using_keywords()
    {

        try {
            if ($this->input->is_ajax_request()) {
                $result = $this->resourcelibrary_model->get_company_by_keywords($_POST);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function add_source_contact()
    {
        $data = array();
        $message = array();
        //$data['']=$_POST['resource_id'];
        $data['vic_contact_formname'] = $_POST['name'];
        $data['vic_contact_formemail'] = $_POST['email'];
        $data['vic_contact_formphone'] = $_POST['mobile'];
        $data['vic_contact_formcompany'] = $_POST['company'];
        $data['vic_contact_formdesignation'] = $_POST['designation'];
        $data['vic_contact_formcountry'] = $_POST['country'];
        $data['vic_contact_formsource'] = $_POST['resource'];


        if (empty($_POST)) {
            $message = array('status' => 'fail', 'message' => 'Receive Empty Data');
            echo json_decode($message);
            exit;
        }
        $result = $this->resourcelibrary_model->add_resource_contact($data, false);
        if ($result) 
        {
            $email = $this->input->post('r_email');
            $name = $this->input->post('name');
            $jobname = $this->input->post('r_title');

            $reqemail =  $_POST['email'];
            $reqmobile = $_POST['mobile'];
            $reqdesignation = $_POST['designation'];
            $type =  $_POST['reqpage'];

            $this->SES_model->send_mail_contactus($email, $name, $jobname, $reqemail, $reqmobile, $reqdesignation, $type);

            $message = array('status' => 'success', 'message' => 'Contact Form Succesful Submission');
        } else {
            $message = array('status' => 'fail', 'message' => 'Contact Form Unsuccesful Submission');
        }
        echo json_encode($message);
    }
    public function show_document($id)
    {
        $result = $this->resourcelibrary_model->show_document($id);
        echo $result;
    }
    public function getDefaultList()
    {
        try {
            if ($this->input->is_ajax_request()) {
                $result = $this->resourcelibrary_model->getDefaultList($_POST);
                echo json_encode($result);
            } else {
                exit('No direct script access allowed');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
