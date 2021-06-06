<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Home_model extends CI_Model{ 

    protected $table1 = 'vic_home_banner';
    protected $table2 = 'vic_company';
    protected $table3 = 'vic_blogs_news';
    protected $table4 = 'vic_events';
    protected $table5 = 'vic_company';
    protected $table6 = 'vic_promoted_video';
    protected $table7 = 'vic_advertisment';

    //it will return active banner images
    public function get_active_banner()
    {
        $status = 'Published';
        $is_active = 'enable';
        $type = 'banner';
        $sql = 'select * from '.$this->table1.' where vic_banner_type = "'.$type.'" AND vic_banner_is_active = "'.$is_active.'" AND vic_banner_status = "'.$status.'" order by vic_banner_postition limit 20';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
     //it will return latest news limit 10
     public function get_latest_news()
     {
         $type = 'news';
         $status = 'Published';
         $is_active = 'active';

         $sql = 'select * from '.$this->table3.' where vic_bn_type = "'.$type.'" AND vic_bn_status = "'.$is_active.'" AND vic_modification_status = "'.$status.'" ORDER BY idvic_blogs_news DESC limit 0, 6';
         $result_set = $this->db->query($sql);
         return $result_set->result();
     }
     //it will return latest interview limit 10
    public function get_latest_interview()
    {
        $type = 'interview';
        $status = 'Published';
        $is_active = 'active';

        $sql = 'select * from '.$this->table3.' where vic_bn_type = "'.$type.'" AND vic_bn_status = "'.$is_active.'" AND vic_modification_status = "'.$status.'" ORDER BY idvic_blogs_news DESC limit 0, 7';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
     //it will return top events
     public function get_latest_events()
     {
        //  $sql = 'select * from '.$this->table4.' ORDER BY idvic_events DESC limit 0, 10';
         $sql = 'select t1.*,t2.vic_companyname from '.$this->table4.' as t1 join '.$this->table5.' as t2 ON t1.vic_company_idvic_company = t2.idvic_company AND t1.vic_modification_status = "Published" ORDER BY t1.idvic_events DESC limit 0, 10';
         $result_set = $this->db->query($sql);
         return $result_set->result();
     }
     public function get_top_rated_events(){
        $upcoming_date = date('Y-m-d',strtotime('+1 day'));
        $sql = 'select * from '.$this->table4.' 
        where vic_events_register_count > 0
        AND vic_modification_status = "Published" 
        AND DATE("'.$upcoming_date.'") BETWEEN vic_eventstartdate AND vic_eventenddate
        order by vic_events_register_count desc
        limit 5 ;';
        $result_set = $this->db->query($sql);
        return $result_set->result();
     }
     public function get_upcoming_events(){
        $upcoming_date = date('Y-m-d',strtotime('+1 day'));
        $sql = 'select * from '.$this->table4.' where vic_modification_status = "Published" AND DATE("'.$upcoming_date.'") BETWEEN vic_eventstartdate AND vic_eventenddate order by vic_date limit 5';
        $result_set = $this->db->query($sql);
        return $result_set->result();
     }
    //List of registered suppliers list
    public function get_company_info()
    {
        $is_active = 'enable';
        $type = 'slider';
        $status = 'Published';

        $sql = 'select * from '.$this->table1.' where vic_banner_type = "'.$type.'" AND vic_banner_is_active = "'.$is_active.'" AND vic_banner_status = "'.$status.'" AND date(vic_banner_duration_to) >=DATE(CURRENT_DATE()) order by vic_banner_postition limit 0, 12';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_home_company_list()
    {
        $is_active = 'enable';
        $type = 'slider';
        $status = 'Published';
        
        $sql = 'select vic_companylogo from '.$this->table2.' ORDER BY idvic_company ASC limit 0, 16';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    function get_event_rightbar(){
        $str="SELECT * FROM
          vic_events 
          WHERE DATE_FORMAT(`vic_eventstartdate`,'%Y-%m-%d')>CURDATE()
          and vic_eventtype IN ('virtual exhibition','meeting','Webinar')
         ORDER BY vic_eventstartdate DESC LIMIT 5";
         $result_set = $this->db->query($str);
        return $result_set->result();
    }
    
    public function get_active_promoted_video()
    {
        $status = 'active';
        $sql = 'select * from '.$this->table6.' where vic_promoted_video_is_active = "'.$status.'" AND vic_promoted_video.`vic_promoted_type`="promoted" AND vic_promoted_video.`vic_promoted_video_status`="Published" ORDER BY vic_promoted_video_position ASC limit 0, 5';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_active_advertisment_video($reqpage)
    {
        $status = 'Published';
        $isactive = 'active';
        $where=" and vic_advertisment_date_from >=CURDATE() and vic_advertisment_date_to<=CURDATE() ";

        $sql = 'select idvic_advertisment, vic_advertisment_company_name, vic_advertisment_ads_url, vic_advertisment_img_path from '.$this->table7.' where vic_advertisment_is_active = "'.$isactive.'" AND vic_advertisment_status = "'.$status.'" AND vic_advertisment_ads_page = "'.$reqpage.'" ORDER BY vic_advertisment_ads_position ASC';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}       