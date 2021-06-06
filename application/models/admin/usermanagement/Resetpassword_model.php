<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpassword_model extends CI_Model
{

    protected $table = 'vic_users';


    public function change_password_ifmatch($userid, $oldpass, $newpass)
    {
        $query = $this->db->query("Select user_password from ".$this->table." where iduser_details ='".$userid."'");

        $row = $query->row();
        if($row->user_password){
            if($row->user_password == md5($oldpass)){

                $data = array(
                    'user_password' => md5($newpass)
                    );
                $this->db->where('iduser_details', $userid);
                $this->db->update( $this->table, $data);
                return  array ('msg' =>'Password changed successfully', 'status' => 'success');

            }else{
                return  array ('msg' =>'Please enter correct password', 'status' => 'error');
            }
        }else{
            return  array ('msg' =>'Invalid user', 'status' => 'error');
        }
    }
}