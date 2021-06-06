<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Profile extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table1 = 'vic_user_details';
        $this->table2 = 'vic_company';
        $this->table4 = 'vic_fields_of_interest';
        $this->table5 = 'vic_users';
        $this->table6 = 'country_codes';

    } 
     
    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
         
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id'])){ 
                    $this->db->where('id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
                $this->db->order_by('id', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
    } 
     
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            // if(!array_key_exists("created", $data)){ 
            //     $data['created'] = date("Y-m-d H:i:s"); 
            // } 
            // if(!array_key_exists("modified", $data)){ 
            //     $data['modified'] = date("Y-m-d H:i:s"); 
            // } 
             
            // Insert member data 
            $insert = $this->db->insert($this->table1, $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 

    
    public function get_payment_status($id)
    {
        $sql = 'select vic_user_details_payment_status from '.$this->table2.' where vic_users_iduser_details = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_plan_id_by_user($id)
    {
        $sql = 'select fk_plan_id from '.$this->table3.' where fk_user_id = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function field_of_interest_list()
    {
        $sql = 'select * from '.$this->table4;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function company_details($userID){
        $sql = 'select t1.* from '.$this->table2.' as t1 LEFT JOIN '.$this->table1.' as t2 ON t1.idvic_company = t2.vic_company_idvic_company where t2.vic_users_iduser_details = "'.$userID.'"';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function insert_update_user_detail($userID,$data = array()){
        if(!empty($data)){ 
            //check user detail exist in vic_user_details table
            $check =$this->user_details($userID);
            if($check){
                //update
                $this->db->where('vic_users_iduser_details', $userID);
                $this->db->update($this->table1,$data);
            }else{
                //insert
                $insert = $this->db->insert($this->table1, $data);
            }
        }
    }
    public function user_details($userID){
        $sql = 'select * from '.$this->table1.' where vic_users_iduser_details = "'.$userID.'"';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function insert_update_company($userID,$data = array()){
        if(!empty($data)){ 
            //check user detail exist in vic_user_details table
            $company =$this->company_details($userID);
            
            if(!empty($company)){
                //update
                //check company name is not duplicate
                //if exist
                if($this->check_company_duplicate($data['vic_companyname'],$company->idvic_company)){
                    return false;
                }
                $this->db->where('idvic_company', $company->idvic_company);
                $this->db->update($this->table2,$data);
                return true;
            }else{
                //insert
                $insert = $this->db->insert($this->table2, $data);
                if($insert){
                    //update id on user_details table
                    $companyID = $this->db->insert_id();
                    $this->db->set('vic_company_idvic_company', $companyID);
                    $this->db->where('vic_users_iduser_details', $userID);
                    $this->db->update('vic_user_details');
                    $this->session->set_userdata('companyId', $companyID);
                    return $companyID;
                }
            }
        }
    }
    public function check_company_duplicate($name,$companyID){
        $whereCompany = '';
        if($companyID != NULL){
            $whereCompany = ' and idvic_company !='.$companyID;
        }
        $sql = 'select * from '.$this->table2.' where vic_companyname = "'.$name.'" '.$whereCompany;
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function check_password($old_password,$userID){
        $sql = 'select * from '.$this->table5.' where user_password = "'.$old_password.'" and iduser_details = '.$userID;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0];
        else
            return false;
    }
    public function update_password($new_password,$userID){
        $this->db->set('user_password', $new_password);
        $this->db->where('iduser_details', $userID);
        return $this->db->update($this->table5);
    }
    public function get_country_code($country){
        $sql = 'select country_code from '.$this->table6.' where Name = "'.$country.'"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0]->country_code;
        else
            return false;
    }
    public function reset_password($new_password,$userID){
        $this->db->set('user_password', $new_password);
        $this->db->where('iduser_details', $userID);
        return $this->db->update($this->table5);
    }
    public function delete_account($userID){
        $result=true;
        try {
           $this->db->trans_start();
            
           //using user id get company id
           $user = $this->user_details($userID);
           if(!empty($user)){
                $companyID = $user->vic_company_idvic_company;

                //event
                $this->db->where('vic_company_idvic_company', $companyID);
                $this->db->delete('vic_events');

                //job
                $this->db->where('vic_user_id', $userID);
                $this->db->delete('vic_jobs');

                $this->db->where('vic_job_userid', $userID);
                $this->db->delete('vic_job_applications');

                //company
                $this->db->where('idvic_company', $companyID);
                $this->db->delete($this->table2);
                
                //forum
                
                $this->db->where('iduser_details_vic_forum_likes', $userID);
                $this->db->delete('vic_forum_likes');

                $this->db->where('vic_users_iduser_details', $userID);
                $this->db->delete('vic_forum_response_likes');

                $this->db->where('vic_forum_response_urserid', $userID);
                $this->db->delete('vic_forum_responses');

                $this->db->where('vic_forum_userid', $userID);
                $this->db->delete('vic_forum');


                //matchmaking
                $this->db->where('vic_user_details_idvic_user_details', $userID);
                $this->db->delete('vic_match_making');

                //stripe order
                $this->db->where('fk_user_id', $userID);
                $this->db->delete('vic_stripe_orders');

                //notification
                $this->db->where('vic_user_id_sender', $userID);
                $this->db->or_where('vic_user_id_receiver', $userID);
                $this->db->delete('vic_user_notification');

                //user detail
                $this->db->where('vic_users_iduser_details', $userID);
                $this->db->delete('vic_user_details');

                $this->db->where('iduser_details', $userID);
                $this->db->delete('vic_users');
           }
           
           if ($this->db->trans_status() === FALSE)
           {
              $this->db->trans_rollback();
              $result=false;
           }
           else
           {
            $this->db->trans_commit();
            $result=true;
           }
        }
        catch (Exception $e) 
        {
          $this->db->trans_rollback();
        } 
        return $result;
    }
}