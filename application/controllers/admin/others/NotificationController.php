<?php defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/admin/config/AdminController.php';

class NotificationController extends AdminController
{
    public function __construct(){
        parent::__construct(); 
        $this->load->model('admin/others/Notification_model');       
    }

    public function get_unread_count()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->session->userdata('userId');
            $data = $this->Notification_model->get_not_read_count($id);
            echo json_encode($data);
        }else{
            echo json_encode(array('msg'=>'Access Denied'));
        }
    }

    public function get_notification()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->session->userdata('userId');
            $data = $this->Notification_model->get_notification_by_id($id);
            $result = $this->update_notification_status($id);
            $str="";
            foreach($data as $res){
                if($res->vic_is_read == 'false') $color = 'bg-white'; else $color = '';
                $str.='<a class="dropdown-item '.$color.'" href="#">
                            <p class="m-0">' . $res->vic_title . '</p>
                            <span>' . $this->time_elapsed_string($res->vic_created_on) . '</span>
                        </a>';
            }
            echo json_encode(array('value'=>$str, 'status'=> $result));
        }else{
            echo json_encode(array('msg'=>'Access Denied'));
        }
    }

    protected function update_notification_status($id)
    {
        $data = $this->Notification_model->update_notification_status($id);
        return $data;
    }

    
    protected function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}