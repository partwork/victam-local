<?php
class Matchmaking_model extends CI_Model
{
    protected $table1 = 'vic_company';
    protected $table2 = 'vic_match_making';
    protected $table5 = 'vic_stripe_orders';
    protected $table4 = 'vic_pricing_plans';

    public function find_new_suppliers($data)
    {    
        $industry =implode('","',$data['industriesactive']);
        $important_usp =implode('","',$data['importantups']);
        $tonscount = implode('","',$data['tonscount']);

        $data['industriesactive'] = implode(',',$data['industriesactive']);
        $data['importantups'] = implode(',',$data['importantups']);
        $data['tonscount'] = implode(',',$data['tonscount']);

        $this->db->insert($this->table2, $data);
        
        // $limit = $this->get_user_limit();
        $sql = 'select count(*) as count from '.$this->table1.' where vic_active_industry1 IN ("'.$industry.'") AND vic_companyproduction IN ("'.$tonscount.'") AND vic_company_to_deal = "'.$data['companydealwith'].'" AND vic_products_services = "'.$data['servicesfor'].'" AND vic_companies_delivering = "'.$data['companies'].'" AND vic_investment_duration = "'.$data['investmentmonth'].'" AND vic_important_usp IN ("'.$important_usp.'") AND vic_company_target_groups = "'.$data['companyprofile'].'" AND vic_company_status = "Published" ';

        // $sql = 'select count(*) as count from '.$this->table1.' where vic_active_industry1 = "'.$data['industriesactive'].'" AND vic_active_industry2 = "'.$data['companyprofile'].'" AND vic_companyproduction = "'.$data['tonscount'].'" AND vic_company_to_deal = "'.$data['companydealwith'].'" AND vic_products_services = "'.$data['servicesfor'].'" AND vic_country_name = "'.$data['companies'].'" AND vic_investment_duration = "'.$data['investmentmonth'].'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_founded_supplier_list($data)
    {
        $industry =implode('","',$data['industriesactive']);
        $important_usp =implode('","',$data['importantups']);
        $tonscount = implode('","',$data['tonscount']);

        $data['industriesactive'] = implode(',',$data['industriesactive']);
        $data['importantups'] = implode(',',$data['importantups']);
        $data['tonscount'] = implode(',',$data['tonscount']);

        $sql = 'select vic_companyname, vic_companyemail from '.$this->table1.' where vic_active_industry1 IN ("'.$industry.'") AND vic_companyproduction IN ("'.$tonscount.'") AND vic_company_to_deal = "'.$data['companydealwith'].'" AND vic_products_services = "'.$data['servicesfor'].'" AND vic_companies_delivering = "'.$data['companies'].'" AND vic_investment_duration = "'.$data['investmentmonth'].'" AND vic_important_usp IN ("'.$important_usp.'") AND vic_company_target_groups = "'.$data['companyprofile'].'" AND vic_company_status = "Published" ';

        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function find_new_buyers($data)
    {
        $industry =implode('","',$data['industriesactive']);
        $important_usp =implode('","',$data['importantups']);
        $tonscount = implode('","',$data['tonscount']);

        $data['industriesactive'] = $industry;
        $data['importantups'] = $important_usp;
        $data['tonscount'] = $tonscount;
        $this->db->insert($this->table2, $data);
        
        $limit = $this->get_user_limit();
        $sql = 'select count(*) as count from '.$this->table1.' where vic_active_industry1 IN ("'.$industry.'") AND vic_companyproduction IN ("'.$tonscount.'") AND vic_company_to_deal = "'.$data['companydealwith'].'" AND vic_products_services = "'.$data['servicesfor'].'" AND vic_companies_delivering = "'.$data['companies'].'" AND vic_investment_duration = "'.$data['investmentmonth'].'" AND vic_important_usp IN ("'.$important_usp.'") AND vic_company_target_groups = "'.$data['companyprofile'].'" AND vic_company_status = "Published" '.$limit;

        // $sql = 'select count(*) as count from '.$this->table1.' where vic_active_industry1 = "'.$data['industriesactive'].'" AND vic_active_industry2 = "'.$data['companyprofile'].'" AND vic_companyproduction = "'.$data['tonscount'].'" AND vic_company_to_deal = "'.$data['companydealwith'].'" AND vic_products_services = "'.$data['servicesfor'].'" AND vic_country_name = "'.$data['companies'].'" AND vic_investment_duration = "'.$data['investmentmonth'].'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_founded_buyers_list($data)
    {
        $industry =implode('","',$data['industriesactive']);
        $important_usp =implode('","',$data['importantups']);
        $tonscount = implode('","',$data['tonscount']);

        $data['industriesactive'] = $industry;
        $data['importantups'] = $important_usp;
        $data['tonscount'] = $tonscount;
        $this->db->insert($this->table2, $data);
        
        $limit = $this->get_user_limit();
        $sql = 'select vic_companyname, vic_companyemail  from '.$this->table1.' where vic_active_industry1 IN ("'.$industry.'") AND vic_companyproduction IN ("'.$tonscount.'") AND vic_company_to_deal = "'.$data['companydealwith'].'" AND vic_products_services = "'.$data['servicesfor'].'" AND vic_companies_delivering = "'.$data['companies'].'" AND vic_investment_duration = "'.$data['investmentmonth'].'" AND vic_important_usp IN ("'.$important_usp.'") AND vic_company_target_groups = "'.$data['companyprofile'].'" AND vic_company_status = "Published" '.$limit;

        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_buyers_list($req )
    {
        $limit = $this->get_user_limit();
        
        
        if($req == null){
            //if user is promotional show last searched matches
            // if($this->session->userdata('plan_id') == 2){
                $result = $this->last_added_match_query();
                if(!empty($result)){
                    
                    $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo 
                    from '.$this->table1.' where vic_active_industry1 IN ("'.$result->industriesactive.'") 
                    AND vic_companyproduction IN ("'.$result->tonscount.'") 
                    AND vic_company_to_deal = "'.$result->companydealwith.'" 
                    AND vic_products_services = "'.$result->servicesfor.'" 
                    AND vic_companies_delivering = "'.$result->companies.'" 
                    AND vic_investment_duration = "'.$result->investmentmonth.'" 
                    AND vic_important_usp IN ("'.$result->importantups.'") 
                    AND vic_company_target_groups = "'.$result->companyprofile.'" 
                    AND vic_company_status = "Published" '.$limit;
                }else{
                    $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo from '.$this->table1.' where vic_company_status = "Published"  '.$limit.' ';
                }
            // }else{
            //     $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo from '.$this->table1.' where vic_company_status = "Published"  '.$limit.' ';
            // }
        }else{
            $this->update_matchmaking_plan();
            $industry =$req['industriesactive'];
            $important_usp =$req['importantups'];
            $tonscount =$req['tonscount'];
            
            $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo 
            from '.$this->table1.' where vic_active_industry1 IN ("'.$industry.'") 
            AND vic_companyproduction IN ("'.$tonscount.'") 
            AND vic_company_to_deal = "'.$req['companydealwith'].'" 
            AND vic_products_services = "'.$req['servicesfor'].'" 
            AND vic_companies_delivering = "'.$req['companies'].'" 
            AND vic_investment_duration = "'.$req['investmentmonth'].'" 
            AND vic_important_usp IN ("'.$req['importantups'].'") 
            AND vic_company_target_groups = "'.$req['companyprofile'].'" 
            AND vic_company_status = "Published" '.$limit;
        }
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function last_added_match_query(){
        $id = $this->session->userdata('userId');
        $sql = 'select * from '.$this->table2.' where vic_user_details_idvic_user_details ='.$id.' and source="find buyers" order by idvic_match_making desc limit 1';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0){
            return $result[0];
        }
        return false;
    }
    public function update_matchmaking_plan(){
        $id = $this->session->userdata('userId');
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table4.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$id.' and t2.vic_pricing_plan_type ="Add-On" and t2.idvic_pricing_plans NOT IN (4,5) order by stripe_order_created_on desc limit 1';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0){
            if($result[0]->fk_plan_id && $result[0]->fk_plan_id==6){
                //fee per match
                $sql1 = 'update '.$this->table5.' set vic_stripe_orders_job_count = vic_stripe_orders_job_count - 1 where vic_stripe_orders_job_count > 0 and fk_user_id = "'.$id.'" and fk_plan_id = 6 order by idvic_stripe_orders desc';
                $result_set = $this->db->query($sql1);
                $this->session->set_userdata('matchmaking_plan', 'false');
            }
        }
    }

    private function get_user_limit(){
        $userId = $this->session->userdata('userId');
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table4.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$userId.' and t2.vic_pricing_plan_type ="Add-On" and t2.idvic_pricing_plans NOT IN (4,5) order by stripe_order_created_on desc limit 1';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            $planId = $result[0]->fk_plan_id;
        else
            $planId = $this->session->userdata('plan_id');
        
        $limit = '';
        //if promotional user has add-on plan of 6(Fee per match then show 2 records)
        if($this->session->userdata('plan_id') == 2 && $planId == 6 && $result[0]->vic_stripe_orders_job_count > 0){ $limit = 'LIMIT 2'; }
        elseif($planId == 2 || $planId == 6 ){ $limit = 'LIMIT 1'; }
        else if( $planId == 7 ){ $limit = 'LIMIT 10'; }
        else if( $planId == 8 ){ $limit = 'LIMIT 25'; }
        else if( $planId == 3 || $planId == 9 ){ $limit = ''; }

        return $limit;
    }
    public function check_add_on_plan($userId){
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table4.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$userId.' and t2.vic_pricing_plan_type ="Add-On" and t2.idvic_pricing_plans NOT IN (4,5) order by stripe_order_created_on desc limit 1';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $planId = $result[0]->fk_plan_id;
        return false;
    }

    public function filter_buyers_list($req){
        
        $limit = $this->get_user_limit();
        
        if($req == null){
            $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo from '.$this->table1.' where vic_company_status = "Published" '.$limit.' ';
        }else{
            $industry = ''; $tonscount=''; $companydealwith =''; $service = ''; $companyprofile = ''; $vic_important_usp = '';$vic_companies_delivering='';
            if($req['industriesactive'] != null)
                $industry = ' AND vic_active_industry1 = "'.$req['industriesactive'].'"';
            if($req['tonscount'] != null)
                $tonscount = ' AND vic_companyproduction = "'.$req['tonscount'].'"';
            if($req['companydealwith'] != null)
                $companydealwith = ' AND vic_company_to_deal = "'.$req['companydealwith'].'"';
            if($req['servicesfor'] != null)
                $service = ' AND vic_products_services = "'.$req['servicesfor'].'"';
            if($req['companyprofile'] != null)
                $companyprofile = ' AND vic_company_target_groups = "'.$req['companyprofile'].'"';
            
            if($req['vic_important_usp'] != null)
                $vic_important_usp = ' AND vic_important_usp = "'.$req['vic_important_usp'].'"';
            if($req['vic_companies_delivering'] != null)
                $vic_companies_delivering = ' AND vic_companies_delivering = "'.$req['vic_companies_delivering'].'"';
            
            $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo from '.$this->table1.' where 1'.$industry.$tonscount.$companydealwith.$service.$companyprofile.$vic_important_usp.$vic_companies_delivering.' AND vic_company_status = "Published" '.$limit;
        }
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_buyers_list_by_search($name)
    {
        $result = $this->last_added_match_query();
        if(!empty($result)){
            $limit = $this->get_user_limit();
            $action = "vic_companyname like '%".$name."%'";

            $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo 
                    from '.$this->table1.' where '.$action.'
                    AND vic_active_industry1 IN ("'.$result->industriesactive.'") 
                    AND vic_companyproduction IN ("'.$result->tonscount.'") 
                    AND vic_company_to_deal = "'.$result->companydealwith.'" 
                    AND vic_products_services = "'.$result->servicesfor.'" 
                    AND vic_companies_delivering = "'.$result->companies.'" 
                    AND vic_investment_duration = "'.$result->investmentmonth.'" 
                    AND vic_important_usp IN ("'.$result->importantups.'") 
                    AND vic_company_target_groups = "'.$result->companyprofile.'" 
                    AND vic_company_status = "Published" '.$limit;
            $result_set = $this->db->query($sql);
            return $result_set->result();
        }
        // $sql = 'select idvic_company, vic_companyname, vic_country_name, vic_industry_sector, vic_companylogo from '.$this->table1.' where '.$action.' AND vic_company_status = "Published"  ORDER BY idvic_company DESC '.$limit;
        
    }

    public function get_company_details_by_id($id)
    {
        $sql = 'select idvic_company, vic_companyname, vic_specialities, vic_industry_sector, vic_companyemail from '.$this->table1.' where idvic_company = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}