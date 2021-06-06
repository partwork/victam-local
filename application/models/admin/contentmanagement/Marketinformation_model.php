    <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marketinformation_model extends CI_Model
{
    protected $table = 'vic_company';
    protected $table1 = 'vic_blogs_news';
    protected $table4 = 'vic_company';
    protected $table5 = 'vic_sectors';


    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
        
    }
    /*public function get_company_list()
    {
        $sql = 'select * from '.$this->table.'';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }*/
    public function get_count_company_list()
    {
        $this->db->where('vic_company_type', 'company_to_guide');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_company_list($limit, $start)
    {
        $this->db->where('vic_company_type', 'company_to_guide');
        $this->db->limit($limit, $start);
        $this->db->order_by('vic_company_created_on','desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_company_details_by_id($id)
    {
        $sql = 'select * from '.$this->table.' where idvic_company = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function update_company_status($id, $status)
    {
        $data['vic_company_is_active'] = $status;   
        
        $this->db->where('idvic_company', $id);
        $this->db->update($this->table4, $data);
        $result =  $this->db->affected_rows();
        return $result;
    }

    public function delete_company_by_id($id)
    {
        $result=true;
        try {
           $this->db->trans_start();
            
            $this->db->where('vic_company_idvic_company', $id);
            $this->db->update('vic_user_details',array('vic_company_idvic_company'=>NULL));

            $this->db->where('vic_company_idvic_company', $id);
            $this->db->delete('vic_events');

            $this->db->where('vic_company_idvic_company', $id);
            $this->db->delete('vic_jobs');

            $this->db->where('idvic_company', $id);
            $this->db->delete($this->table4);

            
            /*
            $this->db->where('idvic_company', $id);
            $this->db->delete($this->table4);*/

           
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

    public function filter_company_by_status($name)
    {
        $sql = 'select idvic_company, vic_companyname, vic_companylogo from '.$this->table1.' where vic_company_is_active like '%".$name."%' ORDER BY idvic_company DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function filter_company_search($name)
    {
        $sql = 'select idvic_company, vic_companyname, vic_companylogo from '.$this->table1.' where vic_companyname like '%".$name."%' ORDER BY idvic_company DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function search_whoiswho($data){
        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_companyname',$data['input']);
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_company_is_active',$data['drop']);
        }
        $result=$this->db->select('*,DATE_FORMAT(vic_company_created_on, "%M %d,%Y") as vic_company_created_on')
        ->from($this->table)->where('vic_company_type', 'company_to_guide')->get()->result();
        return $result;
    }
    public function search_marketing($data)
    {
        if(isset($data['input']) && $data['input']!=''){
            $this->db->like('vic_bn_title',$data['input']);
        }
        if(isset($data['drop']) && $data['drop']!=''){
            $this->db->where('vic_modification_status',$data['drop']);
        }
        $this->db->where('vic_bn_type','magzine');
        $result=$this->db->select('*,DATE_FORMAT(vic_bn_createdat, "%Y-%m-%d") as vic_bn_createdat')
        ->from($this->table1)->get()->result();
        return $result;
    }
    public function update_company($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        $result =  $this->db->affected_rows();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function reject_company_by_details($id)
    {
        $data['vic_company_status'] = 'Rejected';
        $data['vic_company_is_active'] = 'inactive';
        
        $this->db->where('idvic_company', $id);
        $result=$this->db->update($this->table4, $data);
        //$result =  $this->db->affected_rows();
        return $result;
    }
    public function store_data($data){
        $result=$this->db->insert('vic_blogs_news',$data);
        $result =  $this->db->affected_rows();
        return $result;
    }
    public function update_data($data,$where){
        if(!empty($where)){
            $this->db->where($where);
        }
        $result=$this->db->update('vic_blogs_news',$data);
        $result =  $this->db->affected_rows();
        return $result;
    }
    public function getMarketingList($where){
        if(!empty($where)){
            $this->db->where($where);    
        }
        
        $result=$this->db->get('vic_blogs_news')->result();
        return $result;
    }
    public function delete_mkt($id){
        $this->db->where('idvic_blogs_news',$id);
        $result=$this->db->delete('vic_blogs_news');
        return $result;
    }
    public function datatable_list($data)
    {
        if(isset($data['filter_option']) && $data['filter_option']!=''){
           $this->datatables->where('vic_modification_status',$data['filter_option']);      
        }
        if(isset($data['sectorFilter']) && $data['sectorFilter']!=''){
           $this->datatables->where('vic_news_category',$data['sectorFilter']);      
        }
        
        $this->datatables->select('*,DATE_FORMAT(a.vic_bn_createdat,"%Y-%m-%d") as vic_bn_createdat,
            TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta"),a.vic_updated_at) AS vic_updated_at,

            TIMESTAMPDIFF(MINUTE, a.vic_updated_at, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS MIN,
            TIMESTAMPDIFF(HOUR, a.vic_updated_at, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS hours,
            TIMESTAMPDIFF(DAY, a.vic_updated_at, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS DAY

            ')
        ->from('vic_blogs_news as a')
        ->where('vic_bn_type',$data['mkt'])
        ->order_by('idvic_blogs_news','desc');
        return $this->datatables->generate();   
    }
    public function count_interview_article_news()
    {
        $this->db->where('vic_bn_type','interview');
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }
    public function get_interview($limit, $start)
    {
        $this->db->where('vic_bn_type','interview');
        $this->db->limit($limit, $start);
        $this->db->order_by('idvic_blogs_news','desc');
        $query = $this->db->get($this->table1);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function update_company_detail($id,$data){
        $this->db->where('idvic_company',$id);
        $this->db->update('vic_company',$data);
        $result =  $this->db->affected_rows();
        return $result;
    }
    public function get_count_magazine($where)
    {
        if(!empty($where)){
            $this->db->where($where);    
        } 
        
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }
    public function get_magazine_list($limit, $start, $where)
    {
        if(!empty($where)){
            $this->db->where($where);    
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('idvic_blogs_news','desc');
        $query = $this->db->get($this->table1);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_active_sector()
    {
        $sql = 'select * from '.$this->table5.'';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_user_email_by_company_id($id)
    {
        $sql = 'select iduser_details, user_email from vic_users INNER JOIN vic_user_details ON vic_users.iduser_details = vic_user_details.vic_users_iduser_details where vic_company_idvic_company ="'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}   
