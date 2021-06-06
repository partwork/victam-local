<?php
class Oauthtokens_model extends CI_Model
{
    protected $table = 'oauthtokens';

    public function get_token()
    {
        $sql = 'select * from '.$this->table;
        $result_set = $this->db->query($sql);
        $result = $result_set->result();
        return $result[0];
    }
    public function insert($data){
       return $insert = $this->db->insert($this->table, $data); 
    }
    public function update($email,$data){
        $this->db->where('useridentifier', $email);
        return $this->db->update($this->table, $data);
    }
}