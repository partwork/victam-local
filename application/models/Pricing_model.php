<?php
class Pricing_model extends CI_Model
{
    protected $table = 'oauthtokens';
    protected $table1 = 'vic_pricing_plans';
    protected $table2 = 'vic_products';
    protected $table3 = 'vic_users';
    protected $table4 = 'vic_user_details';
    protected $table5 = 'vic_stripe_orders';

    public function get_token()
    {
        $sql = 'select * from '.$this->table;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result[0];
    }
    public function insert_plan($data){
       return $insert = $this->db->insert($this->table1, $data); 
    }
    public function update_plan($data,$plan_code){
        $this->db->where('vic_pricing_plan_code',$plan_code);
        return $this->db->update($this->table1, $data);
     }
    public function create_product($data){
        return $insert = $this->db->insert($this->table2, $data); 
    }
    public function get_product($vic_product_id){
        $sql = 'select * from '.$this->table2.' where vic_product_id ='.$vic_product_id;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0];
        else
            return false;
    }
    public function get_plan($plan_code){
        $sql = 'select * from '.$this->table1.' where vic_pricing_plan_code ='.$plan_code;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0];
        else
            return false;
    }
    public function getAllPlansbyProduct($vic_product_id){
        $sql = 'select * from '.$this->table1.' where vic_pricing_product_id ='.$vic_product_id;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result;
    }
    public function get_all_plans(){
        $sql = 'select * from '.$this->table1.' limit 3';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result;
    }
    public function get_plans(){
        $sql = 'select * from '.$this->table1;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result;
    }
    public function get_all_products(){
        $sql = 'select * from '.$this->table2;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result;
    }
    public function update($email,$data){
        $this->db->where('useridentifier', $email);
        return $this->db->update($this->table, $data);
    }

    public function get_plan_details($id)
    {
        $sql = 'select * from '.$this->table1.' where idvic_pricing_plans = "'.$id.'"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result;
    }

    public function get_user_info($id)
    {
        $sql = 'select vic_user_firstname, vic_user_lastname, user_email,vic_company_idvic_company from '.$this->table3.' LEFT JOIN '.$this->table4.' ON '.$this->table3.'.iduser_details = '.$this->table4.'.vic_users_iduser_details where iduser_details = "'.$id.'"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result;
    }
    public function add_payment_details($data = array()){
        // return $data;
        if(!empty($data)){ 
            $insert = $this->db->insert($this->table5, $data); 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }
    public function get_subscriptions($userId){
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table1.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$userId.' and t2.vic_pricing_plan_type is NULL  and date(vic_stripe_orders_plan_end_dt) >= DATE(CURRENT_DATE()) order by idvic_stripe_orders desc';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result;
        else
            return [];
    }
    public function get_addOn_subscriptions($userId){
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table1.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$userId.' and t2.vic_pricing_plan_type ="Add-On"  and date(vic_stripe_orders_plan_end_dt) >= DATE(CURRENT_DATE()) order by stripe_order_created_on desc';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result;
        else
            return [];
    }
    public function get_all_subscriptions($userId){
        $sql = 'select * from '.$this->table5.' as t1 JOIN '.$this->table1.' as t2 ON t1.fk_plan_id = t2.idvic_pricing_plans where fk_user_id ='.$userId.' and vic_stripe_orders_status = "live"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result;
        else
            return [];
    }
    public function get_subscription_detail($id,$userId){
        $sql = 'select * from '.$this->table5.' where idvic_stripe_orders ='.$id.' and fk_user_id = '.$userId.' and vic_stripe_orders_status = "live"';
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        if($result_set->num_rows() > 0)
            return $result[0];
        else
            return [];
    }
}