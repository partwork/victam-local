<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'vic_users'; 
        $this->table1 = 'vic_pricing_plans'; 
        $this->table2 = 'vic_user_details'; 
        $this->table3 = 'vic_stripe_orders'; 
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
                    $this->db->where('iduser_details', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
                $this->db->order_by('iduser_details', 'desc'); 
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
            $insert = $this->db->insert($this->table, $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 
    public function user_details($userID){
        $sql = 'select * from '.$this->table2.' as t1 JOIN '.$this->table.' as t2 ON t1.vic_users_iduser_details = t2.iduser_details where t1.vic_users_iduser_details = "'.$userID.'"';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function user_details_by_id($userID){
        $sql = 'select * from '.$this->table2.' where vic_users_iduser_details = "'.$userID.'"';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function profile_details($userID){
        $sql = 'select t1.*,t2.* from '.$this->table.' as t1 LEFT JOIN '.$this->table2.' as t2 ON t1.iduser_details = t2.vic_users_iduser_details where t1.iduser_details = "'.$userID.'"';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }

    public function get_payment_status($id)
    {
        $sql = 'select vic_user_details_payment_status from '.$this->table2.' where vic_users_iduser_details = "'.$id.'"';
        // $sql = 'select vic_user_details_payment_status from '.$this->table2.' as t1 LEFT JOIN '.$this->table3.' as t2 ON t1.vic_users_iduser_details = t2.fk_user_id where t1.vic_users_iduser_details = "'.$id.'" and t2.vic_stripe_orders_plan_end_dt >= DATE(CURRENT_DATE()) order by idvic_stripe_orders desc';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function free_plan_status($id)
    {
        $sql = 'select * from '.$this->table3.' where fk_user_id = "'.$id.'" and fk_plan_id = 1';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function job_plan_status($id)
    {
        $sql = 'select * from '.$this->table3.' where fk_user_id = "'.$id.'" and fk_plan_id = 4 and date(vic_stripe_orders_plan_end_dt) >= DATE(CURRENT_DATE()) order by idvic_stripe_orders desc';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function matchmaking_plan_status($id)
    {
        $sql = 'select * from '.$this->table3.' where fk_user_id = "'.$id.'" and fk_plan_id IN (6,7,8,9) and date(vic_stripe_orders_plan_end_dt) >= DATE(CURRENT_DATE()) order by idvic_stripe_orders desc';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            $result = $result_set->first_row();
            if($result->fk_plan_id == 6 && $result->vic_stripe_orders_job_count == 0) return false;
            else return $result;
        }else{
            return false;
        }
    }
    
    public function get_plan_id_by_user($id)
    {
        $sql = 'select fk_plan_id from '.$this->table3.' as t1 JOIN '.$this->table1.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id = "'.$id.'" and t2.vic_pricing_plan_type is NULL and vic_stripe_orders_status = "live" and date(vic_stripe_orders_plan_end_dt) >= DATE(CURRENT_DATE()) order by idvic_stripe_orders desc limit 1';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_user($email)
    {
        $sql = 'select * from '.$this->table.' where user_email = "'.$email.'"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0];
        else
            return false;
    }
    public function reset_password($new_password,$email){
        $this->db->set('user_password', $new_password);
        $this->db->where('user_email', $email);
        return $this->db->update($this->table);
        
    }
}