<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class ResourceLibrary_model extends CI_Model{ 

    protected $table1 = 'vic_resource_library';
    protected $table2 = 'vic_company';
    protected $limit = '50';
    public function add_resources($data,$isReturnkey){
        try{
            $this->db->trans_begin();

            $result=$this->db->insert($this->table1,$data);
            $insert_id = $this->db->insert_id();
            $result=($isReturnkey)?$insert_id : $result;

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                //if something went wrong, rollback everything
                $this->db->trans_rollback();
                return FALSE;
            } else {
                //if everything went right, commit the data to the database
                $this->db->trans_commit();
                return $result;
            }
            
        }
        catch(Exception  $e){
            return $e->getMessage();
        }
        
    }
    //it will return article data from blog news
    public function get_innovation_list()
    {
        $status = 'innovation';
        $sql = 'select * from '.$this->table1.' where vic_resource_librarytype = "'.$status.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_resource_list($type=NULL)
    {
        $status = $type;
        $sql = 'select * from '.$this->table1.' where vic_resource_librarytype = "'.$status.'" and vic_modification_status="Published" and vic_resource_status="active" ORDER BY idvic_resource_library DESC limit '.$this->limit;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    
    public function search_data($data)
    {
        
        $this->db->where('vic_resource_status','active');
        $this->db->where('vic_bn_type',$data['page']);
        if(isset($data['publisher']) && $data['publisher']!=''){
            $this->db->where('vic_bn_firstname',$data['publisher']);
        }
        if(isset($data['industry']) && $data['industry']!=''){
            $this->db->where('vic_bn_position',$data['industry']);
        }
        if(isset($data['keyword']) && $data['keyword']!='')
        {
            $this->db->where('MATCH (vic_bn_title,vic_bn_storytext) AGAINST ("'.$data['keyword'] .'")');
        }
        
        $query = $this->db->get('vic_blogs_news ');
        return $query->result();
    }
    
    //List of registered suppliers list
    public function get_company_info()
    {
        $sql = 'select idvic_company, vic_companyname, vic_companylogo from '.$this->table2.'';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getSector()
    {
        $sql = 'select * from vic_sectors';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getCountry(){
        $sql = 'select * from vic_countries_list';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_company_by_keywords($data)
    {
        $action='';
        
        if($data['name']!=''){
            $action.= " and vic_resource_title like '%".$data['name']."%' ";
        }
        if($data['sector']!= '' && $data['sector']!= 'all'){

            $action.= " and vic_resource_industrysector  = '".$data['sector']."' ";
        }
        if($data['refine']!='' && $data['refine']!= 'all'){
            $action.= " and vic_resource_region  = '".$data['refine']."' ";
        }
        if($data['char']=='All'){
            $action= "";
        }
        if($data['char']=='0-9'){
            $action.= " and vic_resource_title regexp '[0-9]'";
        }
        if($data['char']!='' && $data['char']!='ALL' && $data['char']!='0-9')
        {

            $action .= " and UPPER(vic_resource_title) like '".$data['char']."%' ";
            //$action.= " or LOCATE ('".$data['char']."',vic_resource_title,1) ";
        }
       /* if(rtrim($data['not_id'],", ")!='' && rtrim($data['not_id'],", ")!=','){
            $action.= " and idvic_resource_library not in(".rtrim($data['not_id'],", ").")";
        }*/
        if($data['page']!=''){
         $action.= " and vic_resource_librarytype='".$data['page']."'";   
        }
        $sql = 'select *,DATE_FORMAT(vic_resource_date, "%d/%m/%Y") as r_date from '.$this->table1.' where 1=1 '.$action.' and vic_modification_status="Published" and vic_resource_status="active" ORDER BY idvic_resource_library DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();

    }
    public function get_resource_byId($id)
    {
        $sql = 'select * from '.$this->table1.' where 1=1  and idvic_resource_library="'.$id.'" ORDER BY idvic_resource_library DESC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getDefaultList($data){

        $action=($data['page']!='') ? ' and a.vic_resource_librarytype="'.$data['page'].'"' : '';
        $sql = 'select *,DATE_FORMAT(a.vic_resource_date, "%d/%m/%Y") as r_date from '.$this->table1.' as a where vic_modification_status="Published" and vic_resource_status="active" '.$action.' ORDER BY a.idvic_resource_library DESC limit '.$this->limit;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function add_resource_contact($data,$isReturnkey){
        try{
            $this->db->trans_begin();

            $result=$this->db->insert('vic_contact_form',$data);
            $insert_id = $this->db->insert_id();
            $result=($isReturnkey)?$insert_id : $result;

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                //if something went wrong, rollback everything
                $this->db->trans_rollback();
                return FALSE;
            } else {
                //if everything went right, commit the data to the database
                $this->db->trans_commit();
                return $result;
            }
            
        }
        catch(Exception  $e){
            return $e->getMessage();
        }
    }
    public function show_document($id){
        $sql="select vic_resource_docs from vic_resource_library where idvic_resource_library=".$id;
        $result_set = $this->db->query($sql);
        $x=$result_set->result_array()[0];
        
        if(!empty($x) && $x['vic_resource_docs']!=''){
            $y=file_get_contents(base_url($x['vic_resource_docs']));
            return $y;
        }
    }
}       