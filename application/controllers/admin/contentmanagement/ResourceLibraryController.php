<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/admin/config/AdminController.php';

class ResourceLibraryController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/contentmanagement/ResourceLibrary_model','resource_model');     
        $this->load->model('File_upload_model', 'umodel');
        $this->load->model('admin/others/Notification_model');
        $this->load->model('SES_model');   

    }
    public function researchInnovations()
    {
        // $inv_list=$this->resource_model->getResourceLibrary(array('vic_resource_librarytype'=>'innovation'));
        // $data['inv_list']=$inv_list;
        $data['activePage'] = "researchInnovations";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/researchInnovations', $data);
    }
    public function addresearchInnovations($id=NULL)
    {
        if($id!=NULL){
            $inv_data=$this->resource_model->getResourceLibrary(array('idvic_resource_library'=>$id));
            $inv_data=(!empty($inv_data[0])) ? $inv_data[0] : NULL;
            $data['inv_data']=$inv_data;
            $data['activePage'] = 'Edit';
        }else{
            $data['activePage'] = 'Add';    
        }

        $type=(isset($inv_data->vic_resource_librarytype)) ? $inv_data->vic_resource_librarytype : 'innovation';
        $file_name='addresearchInnovations.php';

        switch ($type) {
            case 'innovation':
                $file_name='addresearchInnovations.php';
                break;
            case 'case_study':
                $file_name='addcaseStudies.php';
                break;
            case 'whitepapers':
                $file_name='addWhitePaper.php';
                break;
            case 'publication':
                $file_name='addPublications.php';
                break;
            
            default:
                $file_name=='addresearchInnovations.php';
                break;
        }
        $data['type']=$type;
        $country_data=$this->resource_model->getCountry();
        $data['country_list']=(!empty($country_data)) ? $country_data : NULL;
        $sector_list=$this->resource_model->getSector();
        $data['sector_list']=$sector_list;
       
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/'.$file_name, $data);
    }

    public function caseStudies()
    {
        // $inv_list=$this->resource_model->getResourceLibrary(array('vic_resource_librarytype'=>'case_study'));
        // $data['inv_list']=$inv_list;

        $data['activePage'] = "caseStudies";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/caseStudies', $data);
    }
    public function addcaseStudies()
    {
        $sector_list=$this->resource_model->getSector();
        $data['sector_list']=(!empty($sector_list))? $sector_list : NULL;
        $data['activePage'] = "Add Case Studies";

        $country_data=$this->resource_model->getCountry();
        $data['country_list']=(!empty($country_data)) ? $country_data : NULL;

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/addcaseStudies', $data);
    }

    public function whitePaper()
    {
        // $inv_list=$this->resource_model->getResourceLibrary(array('vic_resource_librarytype'=>'whitepapers'));
        // $data['inv_list']=$inv_list;
        
        $data['activePage'] = "whitePaper";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/whitePaper', $data);
    }
    public function addWhitePaper()
    {
        $sector_list=$this->resource_model->getSector();
        $data['sector_list']=(!empty($sector_list))? $sector_list : NULL;
        $data['activePage'] = "Add White Paper";

        $country_data=$this->resource_model->getCountry();
        $data['country_list']=(!empty($country_data)) ? $country_data : NULL;

        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/addWhitePaper', $data);
    }

    public function publications()
    {   
        // $inv_list=$this->resource_model->getResourceLibrary(array('vic_resource_librarytype'=>'publication'));
        // $data['inv_list']=$inv_list;
        $data['activePage'] = "Publications";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/publications', $data);
    }
    public function addPublications()
    {
        $sector_list=$this->resource_model->getSector();
        $data['sector_list']=(!empty($sector_list))? $sector_list : NULL;
        $data['activePage'] = "Publications";

        $country_data=$this->resource_model->getCountry();
        $data['country_list']=(!empty($country_data)) ? $country_data : NULL;
        
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/contentmanagement/contentmanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/contentmanagement/resource-library/addPublications', $data);
    }
    public function delete_resourcelib(){
        if ($this->input->is_ajax_request()) 
        {
          $id=$this->input->get('id'); 
          $result=$this->resource_model->delete_resource($id);
          echo json_encode($result);
          exit;
        }
        else
        {
          exit('No direct script access allowed');
        }
    }
    public function add_resourcelib(){

        if ($this->input->is_ajax_request()) :
         try {
            $this->form_validation->set_rules('inn_name', 'Innovation Name', 'required');
            $this->form_validation->set_rules('inn_desc', 'Description', 'required');
            $this->form_validation->set_rules('inn_industry', 'Industry', 'required');
            $this->form_validation->set_rules('inn_publisher', 'Publisher', 'required');
            $this->form_validation->set_rules('inn_email', 'Email', 'required');
            $this->form_validation->set_rules('inn_date', 'Date', 'required');
            //$this->form_validation->set_rules('inn_doc', 'Research and Innovation Documents', 'required');
    
            if ($this->form_validation->run() == FALSE){
                
                echo json_encode(array('status'=>'fail','msg'=>validation_errors()));
                exit;
            }else{
                $form_data = $this->input->post();  
                $column = array(); 
    
                $type=$form_data['r_type'];
                $column['vic_resource_librarytype'] = $type;
                $column['vic_resource_title'] = trim( $form_data['inn_name'] );
                $column['vic_resource_desc'] = $form_data['inn_desc'] ;
                $column['vic_resource_industrysector'] = $form_data['inn_industry'] ;
                $column['vic_resource_publisher'] = $form_data['inn_publisher'];
                $column['vic_resource_date'] =date('Y-m-d',strtotime($form_data['inn_date']));
                $column['vic_updated_at'] =date('Y-m-d H:i:s');
                $column['vic_resource_status'] ='active';
                $column['vic_resource_region'] =$form_data['inn_region'];
                
                //$column['vic_resource_youtube_url']=$form_data['inn_url'];
                if(isset($_FILES['inn_presentation']) && $_FILES['inn_presentation']['name']!=''){
                   $result = $this->umodel->do_upload('inn_presentation', 'mp4|x-m4v|mov|avi', 'resource_library');

                    if (!$result['error']) {
                        //$column['vic_resource_presentation'] ='upload/resource_library/'.$result['file_path'];
                        $column['vic_resource_presentation'] =$result['file_path'];
                    }
                    else
                    {
                         echo json_encode(array('status'=>'fail','msg'=>'Presentation : '.$result['msg']));
                        exit;
                    }     
                }
                if(isset($_FILES['inn_doc']) && $_FILES['inn_doc']['name']!=''){
                   $result = $this->umodel->do_upload('inn_doc', 'pdf', 'resource_library');

                    if (!$result['error']) {
                        //$column['vic_resource_docs'] ='upload/resource_library/'.$result['file_path'];
                        $column['vic_resource_docs'] =$result['file_path'];
                    }  
                    else
                    {
                        echo json_encode(array('status'=>'fail','msg'=>'Documents Attachment: '.$result['msg']));
                        exit;
                    }     
                }
               
                
                $column['vic_resource_email'] = $form_data['inn_email'];
                if($this->session->userdata('usertype') == 'super admin'){
                    $column['vic_modification_status'] = 'Published';
                }else if($this->session->userdata('usertype') == 'publisher - moderator'){
                    $column['vic_modification_status'] = 'Published';
                }else{
                    $column['vic_modification_status'] = 'Under Review';
                }
                //$column['vic_resource_region'] = $form_data['inn_date'];
                //$column['vic_resource_thumbnail'] = $form_data['inn_date'];
                $content='';
                switch ($type) 
                {
                    case 'case_study':
                        $content = 'Your case study '.$form_data['inn_name'].' is successfully published on the Victam portal';
                        break;
                    case 'innovation':
                        
                        $content = 'Your innovation  '.$form_data['inn_name'].' is successfully published on the Victam portal';
                        break;
                    case 'publication':
                        
                        $content = 'Your publication '.$form_data['inn_name'].' is successfully published on the Victam portal';
                        break;
                    case 'whitepapers':
                        $content = 'Your whitepaper  '.$form_data['inn_name'].' is successfully published on the Victam portal';
                        break;

                }

                if($form_data['id']!=''){
                    $this->db->where('idvic_resource_library',$form_data['id']);
                    $result = $this->db->update('vic_resource_library', $column);
                    $action = 'update';
                }
                else{
                  $result = $this->db->insert('vic_resource_library', $column);
                  $action = 'create';

                }

                if( $result == true ){
                    //send notification
                    $this->SES_model->sharedmail($form_data['inn_email'], $content);
                    $this->send_notification($column['vic_resource_title'],$type,$action);
                    $data = (array('status' => 'added'));
                }else {
                    $data = (array('status' => 'went wrong'));
                }
                echo json_encode($data);
                exit;
            }
        } 
        catch (\Throwable $th) 
        {
            throw $th;
        }
      else:
        exit('No direct script access allowed');
      endif;  
    }
    public function rejectResourcelib($id)
    {
       if ($this->input->is_ajax_request()){ 
        $where=array('idvic_resource_library'=>$id);
        $data=array('vic_modification_status'=>'Rejected');
        $inv_data=$this->resource_model->getResourceLibrary(array('idvic_resource_library'=>$id));
        
        $result=$this->resource_model->updateResourcelib($data,$where);
        
        $this->send_notification($inv_data[0]->vic_resource_title,$inv_data[0]->vic_resource_librarytype,'reject');
        echo json_encode($result);
       }
       else{
         exit('No direct script access allowed');
       } 

    }
    public function get_json_list(){

       $result=$this->resource_model->datatable_list($_POST); 
       echo $result;
    }

    public function send_notification($title,$type,$action){
        $userID = $this->session->userdata('userId');
        //notification
        $adminlist = $this->Notification_model->notify_user_list($userID);
        $output = $this->Notification_model->get_user_name($userID);
        
        $val['vic_user_id_sender'] = $userID;
        $val['vic_created_on'] = date('Y-m-d H:i:s');

        switch ($type) {
            case 'innovation':
                $type_name='Reserach & Innovation';
                break;
            case 'case_study':
                $type_name='Case Study';
                break;
            case 'whitepaper':
                $type_name='White Paper';
                break;
            case 'publication':
                $type_name='Publications';
                break;
            
            default:
                $type_name='';
                break;
        }

        switch ($action) {
            case 'create':
                $val['vic_title'] = 'The '.$type_name.' '.$title.' was published successfully on the portal';
                break;
            case 'update':
                if($output)
                    $val['vic_title'] = 'The '.$type_name.' '.$title.' modified by the '.$output['0']->vic_user_firstname.' '.$output['0']->vic_user_lastname;
                else
                    $val['vic_title'] = 'The '.$type_name.' '.$title.' modified by the user';
                break;
            case 'reject':
                $val['vic_title'] = 'The '.$type_name.' '.$title.' rejected due to the a policy violation';
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
}
