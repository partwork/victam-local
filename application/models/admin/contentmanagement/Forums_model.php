<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Forums_model extends CI_Model
{
	protected $table1 = 'vic_forum';
	public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
    }
	public function getSector(){
		$list=$this->db->get('vic_sectors')->result();
		return $list;
	}
	public function getForumsList($where=NULL){
		if(!empty($where)){
			$this->db->where($where);
		}
		$str='*,(SELECT COUNT(*) FROM vic_forum_likes WHERE idvic_forum=vic_forum.`idvic_forum` AND vic_forum_like_dislike="like") AS fcount';
		$result=$this->db->select($str)->from($this->table1)->get()->result();
		return $result;
	}
	public function delete_data($id){
		
		$this->db->where('vic_forum_idvic_forum',$id);
		$result=$this->db->delete('vic_forum_responses');
		
		$this->db->where('idvic_forum',$id);
		$result=$this->db->delete($this->table1);

		
		if($this->db->affected_rows() > 0){
			return true;
		}
		else{
			return false;
		}
		
	}

	public function update_data($data,$where){
		if(!empty($where)){
			$this->db->where($where);
		}
		$result=$this->db->update($this->table1,$data);
		return $result;
	}
	public function store_data($data){
		$result=$this->db->insert($this->table1,$data);
		return $result;
	}
	public function datatable_list($data)
    {
    	if(isset($data['eventfilter']) && $data['eventfilter']!=''){
    		$this->datatables->where('a.vic_modification_status',$data['eventfilter']);
    	}
    	if(isset($data['monthfilter']) && $data['monthfilter']!=''){
    		$this->datatables->where('DATE_FORMAT(a.vic_created_at,"%m")',$data['monthfilter']);
    	}
    	if(isset($data['yearfilter']) && $data['yearfilter']!=''){
    		$this->datatables->where('DATE_FORMAT(a.vic_created_at,"%Y")',$data['yearfilter']);
    	}
    	$str='*,(SELECT COUNT(*) FROM vic_forum_likes WHERE a.idvic_forum=vic_forum_likes.idvic_forum AND vic_forum_like_dislike="like") AS fcount,DATE_FORMAT(a.vic_created_at,"%Y-%m-%d") as vic_created_at,TIMESTAMPDIFF(HOUR,a.vic_forum_modification_dt,NOW()) AS vic_forum_modification_dt,
    	TIMESTAMPDIFF(MINUTE, a.vic_forum_modification_dt, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS MIN,
		TIMESTAMPDIFF(HOUR, a.vic_forum_modification_dt, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS hours,
		TIMESTAMPDIFF(DAY, a.vic_forum_modification_dt, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS DAY, ';
		$this->datatables->select($str)->from($this->table1.' as a')
		->order_by('a.idvic_forum','desc');

        /*$this->datatables->select("*,TIMESTAMPDIFF(HOUR,NOW(),a.vic_modification_at) AS vic_modification_at,
        	DATE_FORMAT(a.vic_date,'%Y-%m-%d') as vic_date")
        ->from($this->table1.' as a');*/
        return $this->datatables->generate();   
    }
}
