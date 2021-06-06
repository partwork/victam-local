<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Forums_model extends CI_Model{ 

    protected $table1 = 'vic_forum';
    protected $table2 = 'vic_company';
    protected $limit = '8';
    public function add_forum($data,$isReturnkey){
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
    public function comment_store($data){
        try{
            $this->db->trans_begin();

            $result=$this->db->insert('vic_forum_responses',$data);
            $result = $this->db->insert_id();
            

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
    public function get_Forum_list($limit=NULL,$offset=NULL,$id=NULL)
    {
        $limit=($limit==NULL || $limit=='')? 8 : $limit;
        $offset=($offset==NULL || $offset=='')? 0 : $offset;
        $where=($id!=NULL)? ' and a.idvic_forum="'.$id.'"' : '';
        $status = 'innovation';
        $sql = 'SELECT 
                TIMESTAMPDIFF(HOUR, a.`vic_created_at`,CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS post_totalhr,
                TIMESTAMPDIFF(DAY, a.`vic_created_at`, CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS DAY,

                TIMESTAMPDIFF(MINUTE, a.`vic_created_at`,CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS post_totalmin,
                (SELECT COUNT(idvic_forum) FROM vic_forum_likes WHERE idvic_forum=a.`idvic_forum` AND vic_forum_like_dislike="like" ) AS total_like,
                (SELECT COUNT(idvic_forum) FROM vic_forum_likes WHERE idvic_forum=a.`idvic_forum` AND vic_forum_like_dislike="dislike" ) AS total_dis_like,
                (SELECT COUNT(vic_forum_idvic_forum) FROM vic_forum_responses WHERE vic_forum_idvic_forum=a.`idvic_forum`  ) AS total_comment,
                 a.*,usr.`vic_user_firstname`
                FROM '.$this->table1.' AS a  LEFT JOIN vic_user_details AS usr  ON a.`vic_forum_userid`=usr.`vic_users_iduser_details` where 1=1 '.$where.' and a.vic_modification_status="Published" ORDER BY a.idvic_forum DESC LIMIT '.$limit.' OFFSET '.$offset;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getForumLikeData($arr=NULL){
        if(!empty($arr)){
            $this->db->where($arr);
        }
        $result_set = $this->db->get("vic_forum_likes")->row();
        return $result_set;
    }
    public function getForumResponeLikeData($arr=NULL){
        if(!empty($arr)){
            $this->db->where($arr);
        }
        $result_set = $this->db->get("vic_forum_response_likes")->row();
        return $result_set;
    }
    public function get_Forum_commnet_list($id,$limit=NULL,$notin=NULL,$isRestbl=NULL){

        $limit=($limit==NULL || $limit=='') ? 2 :$limit;
        $notin=($notin==NULL || $notin=='') ? '' :' and a.idvic_forum_responses NOT IN('.$notin.')' ;
        $clause=($isRestbl!=NULL)? 'a.idvic_forum_responses' : 'a.vic_forum_idvic_forum';
        $sql ="SELECT 
                (SELECT COUNT(*) FROM vic_forum_response_likes WHERE vic_forum_responses_idvic_forum_responses=a.`idvic_forum_responses` AND vic_forum_response_like_dislike='like') AS total_like,
                (SELECT COUNT(*) FROM vic_forum_response_likes WHERE vic_forum_responses_idvic_forum_responses=a.`idvic_forum_responses` AND vic_forum_response_like_dislike='dislike') AS total_dis_like,
                a.*,usr.vic_user_firstname AS user_name
                FROM vic_forum_responses AS a INNER JOIN vic_user_details AS usr ON usr.`vic_users_iduser_details`=a.`vic_forum_response_urserid` where 1=1 ".$notin." and ".$clause."=".$id." ORDER BY a.idvic_forum_responses desc  LIMIT  ".$limit;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function isDislike($id,$forum_id){
        $sql = "SELECT * FROM vic_forum_likes WHERE idvic_forum_like=$id AND idvic_forum_vic_forum_likes=$forum_id AND vic_forum_like_dislike='like'";
         $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getUserDetails($id){
        $result=$this->db->select('*')
        ->from('vic_user_details')->where('vic_users_iduser_details',$id)
        ->get()->row()->vic_users_iduser_details;
        return $result;
    }
    public function forum_like_event($data)
    {
        
        $id=$data['id'];
        $status=$data['status'];
        $like_tblid=$data['like_tblid'];
        $event_from=$data['eventfrom'];
        $user="";
        if ($this->session->userdata('userId')) {
            $user=$this->session->userdata('userId');
            $user=$this->getUserDetails($user);
        }    
        
        $where_clause="";
        if($like_tblid!=''){
            $where_clause.=' and idvic_forum_like='.$like_tblid;
        }
        if($id!=''){
            $where_clause.=' and idvic_forum='.$id;
        }
        if($user!=''){
            $where_clause.=' and iduser_details_vic_forum_likes='.$user;
        }
        $sql='select * from vic_forum_likes where 1=1 '.$where_clause;
        $res = $this->db->query($sql)->result();
        
        if(!empty($res)){

            //For Like Request
            if($status=='like')
            {
                if($res[0]->vic_forum_like_dislike=='dislike')
                {
                    $sql = "update vic_forum_likes set vic_forum_like_dislike='like' where 1=1 ".$where_clause;
                }
            }
            if($status=='unlike'){

                if($res[0]->vic_forum_like_dislike=='like')
                {
                    $sql = "DELETE FROM vic_forum_likes WHERE vic_forum_like_dislike='like' ".$where_clause;
                }   
            }
            //For Dislike Rquest

            if($status=='dislike')
            {
                if($res[0]->vic_forum_like_dislike=='like')
                {
                    $sql = "update vic_forum_likes set vic_forum_like_dislike='dislike' where 1=1 ".$where_clause;
                }
            }
            if($status=='undislike')
            {
                if($res[0]->vic_forum_like_dislike=='dislike')
                {
                    $sql = "DELETE FROM vic_forum_likes WHERE vic_forum_like_dislike='dislike' ".$where_clause;;
                }
            }
            
            
        }
        else
        {
            if (isset($status)) 
            {
                switch ($status) 
                {
                    case 'like':

                        $sql = "INSERT INTO vic_forum_likes (idvic_forum, iduser_details_vic_forum_likes,idvic_forum_vic_forum_likes,vic_forum_like_dislike) 
                                    VALUES ($id,$user,$id,'like') ON DUPLICATE KEY UPDATE vic_forum_like_dislike='like'";
                        break;
                    case 'dislike':
                        $sql  = "INSERT INTO vic_forum_likes (idvic_forum, iduser_details_vic_forum_likes,idvic_forum_vic_forum_likes,vic_forum_like_dislike) 
                                    VALUES ($id,$user,$id,'dislike') ON DUPLICATE KEY UPDATE vic_forum_like_dislike='dislike'";
                        break;
                    case 'unlike':
                        $sql = "DELETE FROM vic_forum_likes WHERE vic_forum_like_dislike='like' and idvic_forum_like=$like_tblid";
                        break;
                    case 'undislike':
                        $sql = "DELETE FROM vic_forum_likes WHERE vic_forum_like_dislike='dislike' and idvic_forum_like=$like_tblid";
                        break;
                    default:
                        break;
                }
               
            }
        }
        
         $result_set = $this->db->query($sql);
         return $result_set;
              
    }
    public function forum_res_like_event($data)
    {
        $id=$data['id'];
        $status=$data['status'];
        $like_tblid=$data['like_tblid'];
        $event_from=$data['eventfrom'];
        $forum_id=$data['forum'];
        $user="";

        if ($this->session->userdata('userId')) {
            $user=$this->session->userdata('userId');
            $user=$this->getUserDetails($user);
        } 

        $where_clause="";
        if($like_tblid!=''){
            $where_clause.=' and idvic_forum_response_likes='.$like_tblid;
        }
        if($id!=''){
            $where_clause.=' and vic_forum_responses_idvic_forum_responses='.$id;
        }
        if($user!=''){
            $where_clause.=' and vic_users_iduser_details='.$user;
        }
        $sql='select * from vic_forum_response_likes where 1=1 '.$where_clause;
        $res = $this->db->query($sql)->result();
        
        if(!empty($res)){

            //For Like Request
            if($status=='like')
            {
                if($res[0]->vic_forum_response_like_dislike=='dislike')
                {
                    $sql = "update vic_forum_response_likes set vic_forum_response_like_dislike='like' where 1=1 ".$where_clause;
                }
            }
            if($status=='unlike'){

                if($res[0]->vic_forum_response_like_dislike=='like')
                {
                    $sql = "DELETE FROM vic_forum_response_likes WHERE vic_forum_response_like_dislike='like' ".$where_clause;
                }   
            }
            //For Dislike Rquest

            if($status=='dislike')
            {
                if($res[0]->vic_forum_response_like_dislike=='like')
                {
                    $sql = "update vic_forum_response_likes set vic_forum_response_like_dislike='dislike' where 1=1 ".$where_clause;
                }
            }
            if($status=='undislike')
            {
                if($res[0]->vic_forum_response_like_dislike=='dislike')
                {
                    $sql = "DELETE FROM vic_forum_response_likes WHERE vic_forum_response_like_dislike='dislike' ".$where_clause;;
                }
            }
            
            
        }
        else
        {
            if (isset($status)) 
            {
                switch ($status) 
                {
                    case 'like':

                        $sql = "INSERT INTO vic_forum_response_likes (vic_forum_responses_idvic_forum_responses, vic_forum_responses_vic_forum_idvic_forum,vic_users_iduser_details,vic_forum_response_like_dislike) 
                                    VALUES ($id,$forum_id,$user,'like') ON DUPLICATE KEY UPDATE vic_forum_response_like_dislike='like'";
                        break;
                    case 'dislike':
                        $sql  = "INSERT INTO vic_forum_response_likes (vic_forum_responses_idvic_forum_responses, vic_forum_responses_vic_forum_idvic_forum,vic_users_iduser_details,vic_forum_response_like_dislike) 
                                    VALUES ($id,$forum_id,$user,'dislike') ON DUPLICATE KEY UPDATE vic_forum_response_like_dislike='dislike'";
                        break;
                    case 'unlike':
                        $sql = "DELETE FROM vic_forum_response_likes WHERE vic_forum_response_like_dislike='like' and idvic_forum_response_likes=$like_tblid";
                        break;
                    case 'undislike':
                        $sql = "DELETE FROM vic_forum_response_likes WHERE vic_forum_response_like_dislike='dislike' and idvic_forum_response_likes=$like_tblid";
                        break;
                    default:
                        break;
                }
               
            }
        }
        
         $result_set = $this->db->query($sql);
         return $result_set;
              
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
    public function searchData($data){
        $action='';
        $limit=5;
        if($data['title']!=''){
            $action.= " and vic_forumname like '%".$data['title']."%' ";
        }
        if($data['sector']!= ''){

            $action.= " and vic_forumsectorname  = '".$data['sector']."' ";
        }
        
        $sql = 'SELECT 
                
                DATE_FORMAT(a.vic_created_at, "%d/%m/%Y") as r_date,
                TIMESTAMPDIFF(HOUR, a.`vic_created_at`,CONVERT_TZ(NOW(),"SYSTEM","Asia/Calcutta")) AS post_totalhr,
                (SELECT COUNT(idvic_forum) FROM vic_forum_likes WHERE idvic_forum=a.`idvic_forum` AND vic_forum_like_dislike="like" ) AS total_like,
                (SELECT COUNT(idvic_forum) FROM vic_forum_likes WHERE idvic_forum=a.`idvic_forum` AND vic_forum_like_dislike="dislike" ) AS total_dis_like,
                (SELECT COUNT(vic_forum_idvic_forum) FROM vic_forum_responses WHERE vic_forum_idvic_forum=a.`idvic_forum`  ) AS total_comment,
                 a.*,usr.`vic_user_firstname`
                FROM '.$this->table1.' AS a  LEFT JOIN vic_user_details AS usr  ON a.`vic_forum_userid`=usr.`idvic_user_details` where 1=1
                 '.$action.' ORDER BY a.idvic_forum DESC LIMIT '.$limit;
            $result_set = $this->db->query($sql);
            return $result_set->result();
    }
   
}       