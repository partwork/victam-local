<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class ManageUserController extends AdminController
{
    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('admin/usermanagement/ManageUser_model','user');
        $this->load->library('Datatables');
        $this->load->model('SES_model');
        
    }
    public function index()
    {
        // $list=$this->user->get_user_list();
        // $data['list']=($list->num_rows() > 0) ? $list : NULL;
        
        
        $data['activePage'] = "userManagement";
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/usermanagement/usermanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/usermanagement/manageuser-view', $data);
    }
    public function fetch_user(){
        
         $list=$this->user->datatable_list($_POST);
         echo $list;
    }
    public function addEditUser($id=NULL)
    {

        if($id!=NULL)
        {
          $list=$this->user->get_user_list($id);  
          $user_data=$list->result_array();

          if(!empty($user_data[0]))
          {
            $data['udata']=$user_data[0];
            
          }
          $data['activePage'] = "Edit User";
        }
        else
        {
            $data['udata']=NULL;
            $data['activePage'] = "Add User";
        }
        $this->load->view('css_js_helpers');
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/usermanagement/usermanagement-js-css');
        $this->load->view('admin/layouts/sidemenu', $data);
        $this->load->view('admin/usermanagement/addEditUser-view', $data);
    }

    public function add_user()
    {

        
        try {
        	$_POST['email']=$_POST['email'].'@victam.com';
            $role=$this->input->post('userRole');
            $fname=$this->input->post('fname');
            $lname=$this->input->post('lname');
            $contact=$this->input->post('contact');
            $email=$this->input->post('email');
            //$email=$this->input->post('email');
            $status=(isset($_POST['status']))? $_POST['status'] : 'inactive';
            $id=$this->input->post('id');

            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');

            
            if ($this->form_validation->run() == FALSE)
            {  
                echo json_encode(array('mstatus'=>'fail','msg'=>validation_errors()));
                exit;
            }

            $d1['user_email']=$email;
            $d1['user_mobile']=$contact;
            $d1['vic_user_role']=$role;
            $d1['vic_user_status']=$status;
            
            $d2['vic_user_firstname']=$fname;
            $d2['vic_user_lastname']=$lname;

            $msg=array();

            if($id!=''){
                
                $where_email=array('user_email'=>$email);
                $email_verify=$this->checkdata($where_email);  
                if($email_verify){
                  unset($d1["user_email"]);
                }
               
                $result=$this->user->updatedata('vic_user_details',$d2,array('vic_users_iduser_details'=>$id)); 

                
                if($result)
                {
                   $result=$this->user->updatedata('vic_users',$d1,array('iduser_details'=>$id));
                   if($result!=true)  
                   {
                     echo json_encode(array('mstatus'=>'fail','msg'=>$result));
                     exit;
                   } 
                   $msg=array('mstatus'=>'success','msg'=>'Data Update Successfull');
                   echo json_encode($msg);
                   exit;

                }
                else
                {
                    echo json_encode(array('mstatus'=>'fail','msg'=>$result));
                    exit;
                }
                
            }
            else
            {
                $where_email=array('user_email'=>$email);
                $check_email=$this->checkdata($where_email);
                if($check_email){
                    echo json_encode(array('mstatus'=>'fail','msg'=>'Email Already Exists!'));
                    exit;
                }
                $where_mobile=array('user_mobile'=>$contact);
                $check_mobile=$this->checkdata($where_mobile);
                if($check_mobile){
                    echo json_encode(array('mstatus'=>'fail','msg'=>'Mobile Number Already Exists!'));
                    exit;
                }

                $d1['user_password']=md5('123456');
                
                $id=$this->user->storedata('vic_users',$d1,true);
                if($id!='')
                {
                    $d2['vic_users_iduser_details']=$id;
                    $result=$this->user->storedata('vic_user_details',$d2,NULL);
                    if($result!=true)
                    {
                        echo json_encode(array('mstatus'=>'fail','msg'=>$result));
                        exit;    
                    }
                    $pass = '123456';
                    $result=$this->SES_model->sendotp($email, $pass);
                    if($result['status']=='success'){
                       $msg=array('mstatus'=>'success','msg'=>'Data Store Successfull');     
                    }
                    else{

                        $msg=array('mstatus'=>'fail','msg'=>$result['msg']);     
                    }
                    
                   echo json_encode($msg);
                   exit;
                }
                else
                {
                    echo json_encode(array('mstatus'=>'fail','msg'=>$result));
                    exit;
                }
                
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            echo json_encode(array('mstatus'=>'fail','msg'=>$th));
        }
    }
    public function checkdata($data){

      $result=$this->user->checkdata($data);
      return $result;
    }
    public function update_user()
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function get_user_by_id()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete_user()
    {
        $id=$this->input->post('id');
        try {
            $result=$this->user->deletedata($id); 
            if($result!=true)
            {
                echo json_encode(array('type'=>'fail','msg'=>$result));
                exit;    
            }
            else
            {
              echo json_encode(array('type'=>'success','msg'=>'Record Delete Successfull'));
                exit;       
            }
        } 
        catch (\Throwable $th) 
        {
            echo json_encode(array('type'=>'fail','msg'=>$th));
            exit;        
        }
    }

    public function status_update()
    {
        $id=$this->input->post('id');
        $status=$_POST['status'];
        try {
            $result=$this->user->updatedata('vic_users',array('vic_user_status'=>$status),array('iduser_details'=>$id)); 
            if($result!=true)
            {
                echo json_encode(array('type'=>'fail','msg'=>$result));
                exit;    
            }
            else
            {
              echo json_encode(array('type'=>'success','msg'=>'Status Update Successfull'));
                exit;       
            }
        } 
        catch (\Throwable $th) 
        {
            echo json_encode(array('type'=>'fail','msg'=>$th));
            exit;        
        }
    }

    public function is_email_exists()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function is_mobile_exists()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function search_data(){
       $status=$this->input->post('status');
       $query_txt=$this->input->post('query'); 
    }
}