<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Company extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'vic_company';
        $this->table1 = 'vic_user_details';
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
    public function get_company_detail($userId){
        $sql = 'select t1.* from '.$this->table.' as t1 JOIN '.$this->table1.' as t2 ON t1.idvic_company = t2.vic_company_idvic_company where t2.vic_users_iduser_details='.$userId;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result[0];
    }
    public function get_company_detail_by_id($companyId){
        $sql = 'select * from '.$this->table.' where idvic_company='.$companyId;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result[0];
    }
    public function get_company_id($companyName){
        $sql = 'select * from '.$this->table.' where vic_companyname = "'.$companyName.'"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0]->idvic_company;
        else 
            return false;
    }
}