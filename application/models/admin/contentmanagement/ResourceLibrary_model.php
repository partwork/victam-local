<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ResourceLibrary_model extends CI_Model
{
	protected $table1 = 'vic_resource_library';
	public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
        
    }

	public function getSector(){
		$list=$this->db->get('vic_sectors')->result();
		return $list;
	}
	public function getCountry(){
        $sql = 'select * from vic_countries_list';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
	public function getResourceLibrary($where){
		if(!empty($where)){
			$this->db->where($where);
		}
		$result=$this->db->get($this->table1)->result();
		return $result;
	}
	public function delete_resource($id){
		
		$this->db->where('idvic_resource_library',$id);
		$result=$this->db->delete($this->table1);
		if($this->db->affected_rows() > 0){
			return true;
		}
		else{
			return false;
		}
		
	}
	public function updateResourcelib($data,$where){
		if(!empty($where)){
			$this->db->where($where);
		}
		$result=$this->db->update($this->table1,$data);
		return $result;
	}
	public function datatable_list($data)
    {
    	if(isset($data['filter_option']) && $data['filter_option']!=''){
    		$this->datatables->where('vic_modification_status',$data['filter_option']);	
    	}
        $this->datatables->select("
        	*,TIMESTAMPDIFF(HOUR,a.vic_resource_date,NOW()) AS vic_resource_date,

        	TIMESTAMPDIFF(MINUTE, a.vic_updated_at, CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta')) AS MIN,
            TIMESTAMPDIFF(HOUR, a.vic_updated_at, CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta')) AS hours,
            TIMESTAMPDIFF(DAY, a.vic_updated_at, CONVERT_TZ(NOW(),'SYSTEM','Asia/Calcutta')) AS DAY
        	")
        ->from($this->table1.' as a')
        ->where('vic_resource_librarytype',$data['rec'])
        ->order_by('idvic_resource_library','desc');
        return $this->datatables->generate();   
    }
	
}
