<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class MarketingInfo_model extends CI_Model{ 

    protected $table1 = 'vic_blogs_news';
    protected $table2 = 'vic_company';

    //it will return article data from blog news
    public function get_article()
    {
        $status = 'article';
        $sql = 'select * from '.$this->table1.' where vic_bn_type = "'.$status.'" and vic_bn_status="active" and vic_modification_status="Published" order by idvic_blogs_news desc';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_news()
    {
        $status = 'news';
        $sql = 'select * from '.$this->table1.' where vic_bn_type = "'.$status.'" and vic_bn_status="active" and vic_modification_status="Published" order by idvic_blogs_news desc';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_news_by_id($id)
    {
        $sql = 'select * from '.$this->table1.' where idvic_blogs_news = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_interview()
    {
        $status = 'interview';
        $sql = 'select * from '.$this->table1.' where vic_bn_type = "'.$status.'" and vic_bn_status="active" and vic_modification_status="Published" order by idvic_blogs_news desc';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getBlogByid($id){

        $sql = 'select * from '.$this->table1.' where idvic_blogs_news = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function search_data($data)
    {
        
        $this->db->where('vic_bn_type',$data['page']);
        $this->db->where('vic_modification_status','Published');
        $this->db->where('vic_bn_status','active');
        
        if(isset($data['publisher']) && $data['publisher']!=''){
            //$this->db->where('vic_bn_firstname',$data['publisher']);
            $this->db->where('vic_bn_firstname',strtolower($data['publisher']));
        }
        if(isset($data['industry']) && $data['industry']!=''){
            $this->db->where('vic_news_category',strtolower($data['industry']));
        }
        if(isset($data['keyword']) && $data['keyword']!='')
        {
            //$this->db->where('MATCH (vic_bn_title,vic_bn_storytext) AGAINST ("'.$data['keyword'] .'")');

            $this->db->like('vic_bn_title',$data['keyword']);
            //$this->db->like('vic_bn_storytext',$data['keyword']); 
            
        }
        
        $query = $this->db->select('*,DATE_FORMAT(vic_bn_createdat,"%M %d %Y") as vic_bn_createdat')->from($this->table1)->get();
        return $query->result();
    }
    public function news_sector($industry)
    {
        $industry = str_replace('-',' ',$industry);
        $this->db->where('vic_bn_type','news');
        $this->db->where('vic_modification_status','Published');
        $this->db->where('vic_bn_status','active');
        
        if(isset($industry) && $industry!=''){
            $this->db->where('vic_news_category',strtolower($industry));
        }
        $query = $this->db->select('*,DATE_FORMAT(vic_bn_createdat,"%M %d %Y") as vic_bn_createdat')->from($this->table1)->get();
        // return $this->db->last_query();
        return $query->result();
    }
    public function get_magazins()
    {
        $status = 'magzine';
        $sql = 'select * from '.$this->table1.' where vic_bn_type = "'.$status.'" and vic_modification_status="Published" and vic_bn_status="active"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getSector($where=NULL){
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get('vic_sectors');
        return $query->result();
    }
    public function getPublisher(){

       $data=$this->db->select('*')->from($this->table1)->where('vic_bn_firstname is NOT NULL')->group_by('vic_bn_firstname')->get();
       return $data->result();
    }
    //List of registered suppliers list
    public function get_company_info()
    {
        $sql = 'select idvic_company, vic_companyname, vic_companylogo from '.$this->table1.'';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_blog_byId($id){

        $this->db->where('idvic_blogs_news',$id);
        $query = $this->db->get($this->table1);
        return $query->result();
    }
    
}       