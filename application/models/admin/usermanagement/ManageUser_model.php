<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUser_model extends CI_Model//AdminController
{
	protected $table1 = 'vic_users';
	
	public function __construct()
    {
        parent::__construct(); 
        $this->load->library('Datatables');
        
    }
	public function get_user_list($id=NULL){
		if($id!=NULL){
			$this->db->where('a.iduser_details',$id);
		}
		$restult=$this->db->select('*')->from($this->table1.' as a')->
		join('vic_user_details as b','a.iduser_details=b.vic_users_iduser_details','left')
		->where_not_in('vic_user_role', 'null')
		->where_in('a.vic_user_role',array('super admin','publisher - moderator','content moderator','admin'))
		->where('vic_user_isDelete',0)
		->get();
		return $restult;
	}
	public function storedata($table,$data,$returnkey=NULL){
		$result=$this->db->insert($table,$data);
		if($returnkey!=NULL){
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		if ($this->db->affected_rows() > 0){
			return true;
		}
		else{
			$err= $this->db->error();
			 return $err;
		}
		return $result;
	}
	public function updatedata($table,$data,$where,$isString=NULL){

		if($isString!=NULL){


		}
		$this->db->where($where);
		
		$result=$this->db->update($table,$data);
		if ($this->db->affected_rows() > 0)
		{
		  return TRUE;
		}
		else
		{
			$err= $this->db->error();
			 return $err;
		}
  
	}
	public function checkdata($data){
		if(!empty($data))
		{
 		  $this->db->where($data);
		}
	    $query = $this->db->get($this->table1);
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}
	public function deletedata($id){
		$this->db->trans_start();

		$this->db->where('iduser_details',$id);
		$data=array('vic_user_isDelete'=>1);
		$result=$this->db->update($this->table1,$data);
		

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    
		    $this->db->trans_rollback();
		    $err= $this->db->error();
			return $err;
		} 
		else 
		{
		    $this->db->trans_commit();
		    return TRUE;
		}
		
  
	}
	public function datatable_list($data){

		// if(isset($data['search_keywords']) && $data['search_keywords']!=''){
		//   $this->datatables->like('', $val = NULL, $side = 'both');
		// }
		if(isset($data['filter_option']) && $data['filter_option']!=''){
		 
			$this->datatables->where('vic_user_status',$data['filter_option']);
		}
		$restult=$this->datatables->select('*')->from($this->table1.' as a')->
		join('vic_user_details as b','a.iduser_details=b.vic_users_iduser_details','left')
		->where_in('a.vic_user_role',array('super admin','publisher - moderator','content moderator','admin'))
		->where('vic_user_isDelete',0)
		->order_by('iduser_details','desc');
		return $this->datatables->generate();
	}
}