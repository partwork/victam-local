<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Whoiswho_model extends CI_Model
{
    protected $table1 = 'vic_company';
    //get all company list
    public function get_company_info()
    {
        $sql = 'select idvic_company, vic_companyname, vic_companylogo, vic_industry_sector, vic_products_services, vic_country_name from '.$this->table1.' where vic_company_status = "Published" ORDER BY idvic_company DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    //get company info by id
    public function get_company_info_by_id($id)
    {
        $sql = 'select * from '.$this->table1.' where idvic_company = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_company_by_keywords($name, $type)
    {
        if($type == 'name'){
            $action = "vic_companyname like '%".$name."%'";
        }else if($type == 'sector'){
            $action = "vic_industry_sector  = '".$name."'";
        }else if($type == 'country'){
            $action = "vic_companyheadquarters  = '".$name."'";
        }else if($type == 'all'){
            $action = "";
        }else if($type == 'number'){
            $action = "vic_companyname like '%0%9%'";
        }else{
            $action = "vic_companyname like '".$name."%'";
        }
        $sql = 'select idvic_company, vic_companyname, vic_companylogo, vic_industry_sector, vic_products_services, vic_country_name from '.$this->table1.' where '.$action.' AND vic_company_status = "Published" ORDER BY idvic_company DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_company_filter($req){
        $whereName = ""; $whereSector = ""; $whereCountry = "";$whereType = "";
        if($req['name'] !=null){
            $whereName = " AND vic_companyname like '%".$req['name']."%'";
        }
        if($req['sector'] !=null){
            $whereSector = " AND vic_industry_sector  = '".$req['sector']."'";
        }
        if($req['country'] !=null){
            $whereCountry = " AND vic_country_name  = '".$req['country']."'";
        }
        $type = $req['type'];
        if($type == 'all' || $type == 'ALL'){
            $whereType = "";
        }else if($type == 'number'){
            $whereType = " and vic_companyname regexp '[0-9]'";
        }else{
            $whereType = " and vic_companyname like '".$type."%'";
        }

        $sql = 'select idvic_company, vic_companyname, vic_companylogo, vic_industry_sector, vic_products_services, vic_country_name from '.$this->table1.' where vic_company_status = "Published"'.$whereName.$whereSector.$whereCountry.$whereType.' ORDER BY idvic_company DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function ajaxphone_exists($phone)
    {
        $this->db->select('vic_phonenumber');
		$this->db->from($this->table1);
		$this->db->where('vic_phonenumber', $phone);
        $this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows()==1){
            return true;
        }else{
            return false;
        }

    }

    public function ajaxisemail_exists($email)
    {
        $this->db->select('vic_companyemail');
		$this->db->from($this->table1);
		$this->db->where('vic_companyemail', $email);
        $this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows()==1){
            return true;
        }else{
            return false;
        }
    }

    public function ajaxiscompany_exists($company)
    {
        $this->db->select('vic_companyname');
		$this->db->from($this->table1);
		$this->db->where('vic_companyname', $company);
        $this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows()==1){
            return true;
        }else{
            return false;
        }
    }   
    

    public function get_user_list_by_finding_buyers($data)
    {
        $sql = 'select vic_user_firstname, user_email, vic_user_details_idvic_user_details from vic_match_making INNER JOIN vic_users ON vic_user_details_idvic_user_details = iduser_details INNER JOIN vic_user_details ON iduser_details = vic_users_iduser_details where industriesactive = "'.$data['vic_industry_sector'].'" AND tonscount = "'.$data['vic_companyproduction'].'" AND companydealwith = "'.$data['vic_company_to_deal'].'" AND servicesfor = "'.$data['vic_products_services'].'" AND importantups = "'.$data['vic_important_usp'].'" AND companies = "'.$data['vic_companies_delivering'].'" AND investmentmonth = "'.$data['vic_investment_duration'].'" GROUP BY(vic_user_details_idvic_user_details)';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }


    private function get_user_limit(){
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table4.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$userId.' and t2.vic_pricing_plan_type ="Add-On" and t2.idvic_pricing_plans NOT IN (4,5) order by stripe_order_created_on desc limit 1';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            $planId = $result[0]->fk_plan_id;
        else
            $planId = $this->session->userdata('plan_id');
        
        if($planId == 2 || $planId == 6 ){ $limit = 'LIMIT 1'; }
        else if( $planId == 7 ){ $limit = 'LIMIT 10'; }
        else if( $planId == 8 ){ $limit = 'LIMIT 20'; }
        else if( $planId == 3 || $planId == 9 ){ $limit = ''; }

        return $limit;
    }
}