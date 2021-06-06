<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{
    protected $table = 'vic_blogs_news';
    protected $table2 = 'vic_home_banner';
    protected $table3 = 'vic_promoted_video';
    protected $table4 = 'vic_advertisment';
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
        
    }
    public function getSector($where){
        if(!empty($where)){
            $this->db->where($where);
        }
        $result=$this->db->select('*')->from('vic_sectors')->get();
        return $result->result();
    }
    public function get_interview_article_news($column)
    {
        $sql = 'select * from '.$this->table.' where vic_bn_type = "'.$column.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getPosition_numbers($table,$column,$where)
    {
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where('date(vic_banner_duration_to) >=DATE(CURRENT_DATE())');
        $result=$this->db->select($column.' as number')->from($table)->get()->result();
        // return $this->db->last_query();
        return $result;
    }
 
    public function get_news_by_id($data)
    {
        $id = $data['id'];
        $sql = 'select * from '.$this->table.' where idvic_blogs_news = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function count_interview_article_news()
    {
        $this->db->where('vic_bn_type','interview');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_interview($limit, $start)
    {
        $this->db->where('vic_bn_type','interview');
        $this->db->limit($limit, $start);
        $this->db->order_by('idvic_blogs_news','desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function update_interview_article_news($where,$data)
    {
        $this->db->update($this->table, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function delete_interview_article_news($id)
    {
        $this->db->where('idvic_blogs_news', $id);
        $this->db->delete($this->table);
        return true;
    }

    public function reject_interview_article_news($id)
    {
        $data['vic_modification_status'] = 'Rejected';
        $data['vic_bn_status'] = 'inactive';
        $this->db->where('idvic_blogs_news', $id);
        $this->db->update($this->table, $data);
        $result =  $this->db->affected_rows();
        return $result;
    }

    //shared function for home and market management
    public function get_count_banner_logo($column)
    {
        $this->db->where('vic_banner_type',$column);
        $this->db->from($this->table2);
        return $this->db->count_all_results();
    }

    public function get_banner_logo_list($limit, $start, $column)
    {
        $this->db->where('vic_banner_type',$column);
        $this->db->limit($limit, $start);
        $this->db->order_by('vic_banner_id','desc');
        $query = $this->db->get($this->table2);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    //lgogs and banner common functions
    public function delete_banner_logo_by_id($id)
    {
        $this->db->where('vic_banner_id', $id);
        $this->db->delete($this->table2);
        return true;
    }

    public function reject_banner_logo($id)
    {
        $data['vic_banner_status'] = 'Rejected';
        $data['vic_banner_is_active']='disable';
        $this->db->where('vic_banner_id', $id);
        $this->db->update($this->table2, $data);
        $result =  $this->db->affected_rows();
        return $result;
    }

    public function get_banner_logo_by_id($data)
    {
        $id = $data['id'];
        $sql = 'select * from '.$this->table2.' where vic_banner_id = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function update_banner_logos($where,$data)
    {
        $this->db->update($this->table2, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
    }

     //promoted video

     public function count_promoted_video()
     {
        $this->db->where('vic_promoted_type','promoted');
        $this->db->from($this->table3);
        return $this->db->count_all_results();
     }

     public function get_promotvideo($limit, $start)
     {
        $this->db->limit($limit, $start);
        $this->db->where('vic_promoted_type','promoted');
        $this->db->order_by('idvic_promoted_video','desc');
        $query = $this->db->get($this->table3);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }

     public function promoted_video_by_id($id)
     {
        $sql = 'select * from '.$this->table3.' where idvic_promoted_video = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
     }

     public function update_promoted_video($where,$data)
     {
        $this->db->update($this->table3, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
     }

     public function reject_promoted_video($id)
     {
        $data['vic_promoted_video_status'] = 'Rejected';
        $data['vic_promoted_video_is_active']='inactive';
        $this->db->where('idvic_promoted_video', $id);
        $this->db->update($this->table3, $data);
        $result =  $this->db->affected_rows();
        return $result;
     }

     public function delete_promoted_video($id)
     {
        $this->db->where('idvic_promoted_video', $id);
        $this->db->delete($this->table3);
        return true;
     }

     //advertisment

     public function count_advertisements(){
        $this->db->from($this->table4);
        return $this->db->count_all_results();
     }

     public function get_advertisements($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by('idvic_advertisment','desc');
        $query = $this->db->get($this->table4);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }

     public function advertisment_by_id($data)
     {
        $id = $data['id'];
        $sql = 'select * from '.$this->table4.' where idvic_advertisment = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
     }

     public function update_advertisment($where,$data)
     {
        $this->db->update($this->table4, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
     }

     public function reject_advertisment($id)
     {
        $data['vic_advertisment_status'] = 'Rejected';
        $data['vic_advertisment_is_active'] = 'inactive';
        
        $this->db->where('idvic_advertisment', $id);
        $this->db->update($this->table4, $data);
        $result =  $this->db->affected_rows();
        return $result;
     }

     public function delete_advertisment($id)
     {
        $this->db->where('idvic_advertisment', $id);
        $this->db->delete($this->table4);
        return true;
     }
   
    public function datatable_list($data)
    {
        if(isset($_POST['filter_option']) && $_POST['filter_option']!=''){
            $this->datatables->where('vic_modification_status',$_POST['filter_option']);
        }
        $this->datatables->select('
            *,
            CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta"),vic_updated_at,
              TIMESTAMPDIFF(MINUTE, a.vic_updated_at, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS MIN,
              TIMESTAMPDIFF(HOUR, a.vic_updated_at, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS hours,
              TIMESTAMPDIFF(DAY, a.vic_updated_at, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS DAY,
              DATE_FORMAT(a.vic_bn_createdat, "%Y-%m-%d") as vic_bn_createdat,
            ')->from('vic_blogs_news as a')
        ->where('vic_bn_type',$data["section"])
        ->order_by('idvic_blogs_news','desc');
        if(isset($_POST['limit']) && $_POST['limit']!=''){
            $this->datatables->limit($_POST['limit']);
        }
        return $this->datatables->generate();   
    }
   public function get_advert_list($data){
    $this->datatables->select('*')->from($this->table4.' as a');
    
        return $this->datatables->generate(); 
   }
   public function update_promoted_status($data,$where){
    $this->db->update($this->table3, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
   }
   public function update_adv_status($data,$where){
    $this->db->update($this->table4, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
   }
   public function data_search($data){

        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_bn_title',$data['input']);
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_bn_status',$data['drop']);    
        }
        if(isset($data['type']) && $data['type']!=''){
            $this->db->where('vic_bn_type',$data['type']);    
        }
        
        $result=$this->db->select('*,DATE_FORMAT(a.vic_bn_createdat, "%Y-%m-%d") as vic_bn_createdat,DATE_FORMAT(a.vic_updated_at, "%Y-%m-%d") as vic_updated_at')
        ->from($this->table.' as a')->get()->result();
        return $result;
    }
    public function virtual_search($data){

        if(isset($data['type']) && $data['type']!='' && $data['type']=='virtual'){
            $this->db->where('a.vic_promoted_type','virtual');
        }
         if(isset($data['input']) && $data['input']!=''){
            $this->db->like("LOWER(a.vic_promoted_video_title)",strtolower($data['input']));
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('a.vic_promoted_video_is_active',$data['drop']);    
        }
        if(isset($data['limit']) && $data['limit']!='' && $data['type']=='virtual'){
           // $this->db->limit(10);
        }
        $result=$this->db->select('*')
        ->from($this->table3.' as a')->get()->result();
        return $result;
    }
    
    public function banner_search($data){

        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_banner_company_name',$data['input']);
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_banner_is_active',$data['drop']);    
        }
        if(isset($data['type']) && $data['type']!=''){
            $this->db->where('vic_banner_type',$data['type']);    
        }
        $result=$this->db->select('*,DATE_FORMAT(a.vic_banner_created_on, "%Y-%m-%d") as vic_banner_created_on')
        ->from($this->table2.' as a')->get()->result();
        return $result;
    }
    public function prom_video_search($data){

        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_promoted_video_title',$data['input']);
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_promoted_video_is_active',$data['drop']);    
        }
        if(isset($data['limit']) && $data['limit']!=''){
            $this->db->limit($data['limit']);
        }
        if(isset($data['type']) && $data['type']=='promoted_video'){
            $this->db->where('vic_promoted_type','promoted');
        }
        $result=$this->db->select('*,DATE_FORMAT(a.vic_created_at, "%Y-%m-%d") as vic_created_at')->from($this->table3.' as a')->get()->result();
        return $result;
    }
    public function adv_video_search($data){

        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_advertisment_company_name',$data['input']);
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_advertisment_is_active',$data['drop']);    
        }
        if(isset($data['limit']) && $data['limit']!=''){
            //$this->db->limit($data['limit']);    
        }
        $result=$this->db->select('*,DATE_FORMAT(a.vic_advertisment_created_on, "%Y-%m-%d") as vic_advertisment_created_on')
        ->from($this->table4.' as a')->get()->result();
        
        return $result;
    }
}