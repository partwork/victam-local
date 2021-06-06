<?php

class Search_model extends CI_Model
{

    protected $table = 'vic_blogs_news';

    public function get_value_by_q($val)
    {
        $action = "vic_bn_type = 'news' AND vic_bn_title like '%".$val."%'";

        $sql = 'select idvic_blogs_news, vic_bn_title, vic_bn_storytext, vic_description from '.$this->table.' where '.$action.'';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    
} 