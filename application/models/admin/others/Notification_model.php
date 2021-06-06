<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Notification_model extends CI_Model
{
    protected $table1 = 'vic_users';
    protected $table2 = 'vic_user_notification';
    protected $table3 = 'vic_user_details';
    public function get_not_read_count($id)
    {
        $isread = 'false';
        $sql = 'select count(*) as count from '.$this->table2.' where vic_is_read = "'.$isread.'" AND vic_user_id_receiver = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_notification_by_id($id)
    {
        $sql = 'select vic_title, vic_created_on, vic_is_read from '.$this->table2.' where vic_user_id_receiver = "'.$id.'" order by idvic_notification desc';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function update_notification_status($id)
    {
        $data = [
            'vic_is_read' => 'true',
        ];
        $this->db->where('vic_user_id_receiver', $id);
        $this->db->update('vic_user_notification', $data);
        return true;
    }
    public function add_notify($data)
    {
        $col = array();
        $col['vic_user_id_sender'] = $data['sender_id'];
        $col['vic_user_id_receiver'] = $data['receiver_id'];
        $col['vic_title'] = $data['title'];
        $col['vic_created_on'] = date('Y-m-d H:i:s');
        $result = $this->db->insert($this->table2, $col);
        return $result;
    }
    public function insert_notify_batch($data){
        return $this->db->insert_batch($this->table2, $data);
    }
    public function get_user_name($id)
    {
        $sql = 'select vic_user_firstname, vic_user_lastname from '.$this->table3.' where vic_users_iduser_details = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_admin_list()
    {
        $id = 'super admin';
        $sql = 'select iduser_details from '.$this->table1.' where vic_user_role = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function notify_user_list($userId)
    {
        $sql = 'select iduser_details from '.$this->table1.' where vic_user_role IS NOT NULL AND  iduser_details != "'.$userId.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}
