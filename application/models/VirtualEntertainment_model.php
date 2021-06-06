<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class VirtualEntertainment_model extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'vic_promoted_video';
    } 
     
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            // if(!array_key_exists("created", $data)){ 
            //     $data['created'] = date("Y-m-d H:i:s"); 
            // } 
            // if(!array_key_exists("modified", $data)){ 
            //     $data['modified'] = date("Y-m-d H:i:s"); 
            // } 
             
            // Insert member data 
            $insert = $this->db->insert($this->table, $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 
    public function getGallaryvideo_list(){
        $sql = 'select * from '.$this->table.' where vic_promoted_video_status = "Published" and vic_promoted_video_is_active="active" and vic_promoted_type="virtual"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}