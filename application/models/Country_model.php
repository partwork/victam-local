<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Country_model extends CI_Model{ 

    protected $table = 'vic_countries_list';
    
    public function getCountryList(){
        $sql = 'select name from '.$this->table.' ORDER BY name ASC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}