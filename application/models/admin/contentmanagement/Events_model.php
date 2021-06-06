<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends CI_Model
{
	protected $table1 = 'vic_events';
	public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
    }
	public function getSector(){
		$list=$this->db->get('vic_sectors')->result();
		return $list;
	}
	public function getEventList($where=NULL){
		if(!empty($where)){
			$this->db->where($where);
		}

		$result=$this->db->from($this->table1)->order_by("idvic_events", "DESC")->get()->result();
		return $result;
	}
	public function getSectorList(){
        $sql = 'select * from vic_sectors where vic_sectors_industry_category = "event"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
	public function addData($data){
	  $result=$this->db->insert($this->table1,$data);
	  return $result;	
	}
	public function updateData($data,$where){
	  if(!empty($where)){
	  	$this->db->where($where);
	  }
	  $result=$this->db->update($this->table1,$data);
	  return $result;	
	}
	public function delete_data($id)
	{
		$this->db->where('idvic_events',$id);
		$result=$this->db->delete($this->table1);
		return $result;

	}
	public function datatable_list($data)
    {
    	if(isset($data['eventfilter']) && $data['eventfilter']!=''){
    		$this->datatables->where('vic_modification_status',$data['eventfilter']);	
    	}
    	if(isset($data['monthfilter']) && $data['monthfilter']!=''){
    	   $this->datatables->where('DATE_FORMAT(vic_date,"%m")',$data['monthfilter']);	
    	}
    	if(isset($data['yearfilter']) && $data['yearfilter']!=''){
    		$this->datatables->where('DATE_FORMAT(vic_date,"%Y")',$data['yearfilter']);	
    	}
        $this->datatables->select("*,TIMESTAMPDIFF(HOUR,a.vic_modification_at,NOW()) AS vic_modification_at,
        	DATE_FORMAT(a.vic_date,'%Y-%m-%d') as vic_date,
        	TIMESTAMPDIFF(MINUTE, a.vic_modification_at, CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta')) AS MIN,
            TIMESTAMPDIFF(HOUR, a.vic_modification_at, CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta')) AS hours,
            TIMESTAMPDIFF(DAY, a.vic_modification_at, CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta')) AS DAY
        	")
        ->from($this->table1.' as a')
        ->order_by('idvic_events','desc');
        return $this->datatables->generate();   
    }
}

