<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Sector_model extends CI_Model{ 

    protected $table = 'vic_sectors';
    
    public function getSectorList(){
        $sql = 'select * from '.$this->table;
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}

