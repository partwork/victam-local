<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Job_model extends CI_Model{ 

    protected $table1 = 'vic_jobs';
    protected $table2 = 'vic_company';
    protected $table3 = 'vic_job_applications';
    protected $table4 = 'vic_stripe_orders'; 
    protected $table5 = 'vic_sectors'; 


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
    public function update($data = array(),$jobID){
        $this->db->where('idvic_jobs', $jobID);
        $this->db->update($this->table1, $data);
        return $jobID;
    }
    public function getJobList(){
        // $sql = 'select t1.*,t2.vic_companyname from '.$this->table1.' as t1 join '.$this->table2.' as t2 on t1.vic_company_idvic_company = t2.idvic_company';
        $sql = 'select * from '.$this->table1.' where vic_job_status ="active"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getJobFilterList($display,$country,$search){
        $where = '';
        if(($display != NULL) && ($display !='AllSectors') && ($country != NULL) && ($country !='AllCountry')){
            $where = 'where vic_industry_sector_id = '.$display.' and vic_jobslocation = "'.$country.'"';
        }
        elseif(($display != NULL) && ($display !='AllSectors')){
            $where = 'where vic_industry_sector_id = '.$display;
        }
        elseif(($country != NULL) && ($country !='AllCountry')){
            $where = 'where vic_jobslocation = "'.$country.'"';
        }
        elseif((trim($search) != NULL)){
            $where = 'where vic_jobsdesignation like "%'.$search.'%" OR vic_jobsskills like "%'.$search.'%" OR vic_company_name like "%'.$search.'%"';
        }
        $sql = 'select * from '.$this->table1.' '.$where;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_job_filter_list($data){
        $action='';
        
        if($data['search']!=''){
            $search = $data['search'];
            $action.= ' and vic_jobsdesignation like "%'.$search.'%" OR vic_jobsskills like "%'.$search.'%" OR vic_company_name like "%'.$search.'%"';
        }
        if($data['display']!= '' && $data['display']!= 'all'){
            $display = $data['display'];
            $action.= " and vic_industry_sector_id = ".$display;
        }
        if($data['country']!='' && $data['country']!= 'all'){
            $action.= " and vic_jobslocation  = '".$data['country']."'";
        }
        $sql = 'select * from '.$this->table1.' where 1'.$action.' and vic_job_status ="active"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function applyJob(){
        if(!empty($data)){ 
            // Insert member data 
            $insert = $this->db->insert($this->table3, $data);
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false;
    }

    public function get_job_info_by_id($id)
    {
        $sql = 'select j.*, c.*, s.vic_bn_sector_name from '.$this->table1.' as j INNER JOIN '.$this->table2.' as c ON j.vic_company_idvic_company = c.idvic_company JOIN '.$this->table5.' as s ON j.vic_industry_sector_id = s.vic_bn_sector_id where idvic_jobs = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_activeJobList($id)
    {
        $status = 'active';
        $sql = 'select * from '.$this->table1.' where vic_job_status = "'.$status.'" AND vic_user_id = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_inactiveJobList($id)
    {
        $status = 'inactive';
        $sql = 'select * from '.$this->table1.' where vic_job_status = "'.$status.'" AND vic_user_id = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function job_status_update($id, $status)
    {
        $data['vic_job_status'] = $status;
        
        $this->db->where('idvic_jobs', $id);
        $this->db->update($this->table1, $data);
        $result =  $this->db->affected_rows();
        return $result;
    }

    public function delete_job_by_id($id)
    {
        $this->db->where('idvic_jobs', $id);
        $this->db->delete($this->table4);
        return true;
    }

    public function get_jobs_by_id($id)
    {
        $sql = 'select * from '.$this->table1.' where idvic_jobs = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function update_job_details($where, $data)
    {
        $this->db->update($this->table1, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function delete_job($jobID){
        $this->db->where('idvic_jobs', $jobID);
        return $this->db->delete($this->table1);
    }
    public function job_plan_update($id){
        $sql = 'update '.$this->table4.' set vic_stripe_orders_job_count = vic_stripe_orders_job_count - 1 where vic_stripe_orders_job_count > 0 and fk_user_id = "'.$id.'" and fk_plan_id = 4 order by idvic_stripe_orders desc';
        $result_set = $this->db->query($sql);
        if($result_set){
            return true;
        }else{
            return false;
        }
    }
}