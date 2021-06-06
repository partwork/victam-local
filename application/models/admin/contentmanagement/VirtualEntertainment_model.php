<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VirtualEntertainment_model extends CI_Model
{
    protected $table = 'vic_promoted_video';
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
        
    }
    public function count_virtual_video($where){
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_virtual_video($limit, $start,$where){
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('idvic_promoted_video','desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }
    public function reject_company_by_details($id)
    {
        $data['vic_company_status'] = 'Rejected';
        
        $this->db->where('idvic_company', $id);
        $this->db->update($this->table4, $data);
        $result =  $this->db->affected_rows();
        return $result;
    }
    public function store_data($data){
        $result=$this->db->insert($this->table,$data);
        $result =  $this->db->affected_rows();
        return $result;
    }
    public function update_data($data,$where){
        if(!empty($where)){
            $this->db->where($where);
        }
        $result=$this->db->update($this->table,$data);
        $result =  $this->db->affected_rows();
        return $result;
    }
    public function getVideoList($where=NULL){
        if(!empty($where)){
            $this->db->where($where);    
        }
        
        $result=$this->db->get($this->table)->result();
        return $result;
    }
    public function delete_video($id){
        $this->db->where('idvic_promoted_video',$id);
        $result=$this->db->delete($this->table);
        return $result;
    }
    public function tbl_object($data){
        if(isset($_POST['eventfilter']) && $_POST['eventfilter']!=''){
          $this->datatables->where('vic_promoted_video_is_active',$_POST['eventfilter']);     
        }
       $this->datatables->select('*')->from($this->table);
        return $this->datatables->generate();         
    }
    public function data_search($data){

        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_promoted_video_title', $data['input']); 
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_promoted_video_is_active',$data['drop']);    
        }
        $result=$this->db->get($this->table)->result();
        return $result;
    }
}   
