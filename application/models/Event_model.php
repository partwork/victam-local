<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Event_model extends CI_Model{ 

    protected $table = 'vic_events';
    protected $table1 = 'vic_sectors';
    protected $table2 = 'vic_company';
    protected $table3 = 'vic_users';
    protected $table4 = 'vic_user_details';


    //get all events
    public function get_events_list($sector,$search,$type,$date)
    {
        $sectorWhere =""; $searchWhere = ""; $typeWhere =""; $dateWhere="";
        if($sector!=NULL && $sector !='AllSector'){
            $sector = str_replace("-"," ",$sector);
            $sector = str_replace("_","&",$sector);
            
            $sectorID = $this->getSectorIDbyName($sector);
            if($sectorID){
                $sectorWhere = ' and vic_sector_id = '.$sectorID;
            }
        }
        if($search != NULL && $search !='search'){
            $searchWhere = ' and vic_eventtitle like "%'.$search.'%"';
        }

        if($type != NULL && $type!='AllEvents'){
            if($type == 'online'){
                $typeWhere = ' and vic_eventtype IN ("virtual exhibition", "meeting", "Webinar")';
            }elseif($type == 'onsite'){
                $typeWhere = ' and vic_eventtype IN ("Exhibition","Conference","seminars")';
            }
        }
        if($date != NULL && $date !=""){
            $eventDate = date('Y-m-d',strtotime($date));
            $dateWhere = ' AND DATE("'.$eventDate.'") BETWEEN vic_eventstartdate AND vic_eventenddate';
        }else{
            $dateWhere = ' AND DATE(CURRENT_DATE()) BETWEEN vic_eventstartdate AND vic_eventenddate';
        }

        $sql = 'select * from '.$this->table.' where vic_modification_status = "Published" '.$sectorWhere.$searchWhere.$typeWhere.$dateWhere.' order by vic_date';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function getSectorIDbyName($sectorName){
        $sql = 'select * from '.$this->table1.' where vic_bn_sector_name = "'.$sectorName.'"';
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            $result = $result_set->result();
            return $result[0]->vic_bn_sector_id;
        }else{
            return false;
        }
    }
    public function getSectorList(){
        $sql = 'select * from vic_sectors where vic_sectors_industry_category = "event"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_event_date(){
        $today = date('Y-m-d');
        $sql = 'select DATE(vic_eventstartdate) as vic_eventstartdate,DATE(vic_eventenddate) as vic_eventenddate,vic_date,vic_eventfrequency from '.$this->table.' where date(vic_date) >= "'.$today.'" OR DATE(CURRENT_DATE()) BETWEEN vic_eventstartdate AND vic_eventenddate AND vic_modification_status = "Published" order by vic_date';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function insert($data = array()) { 
        if(!empty($data)){
            $insert = $this->db->insert($this->table, $data); 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }
    public function get_online_event(){
        $time=date('h:i A');
        $sql = 'select * from '.$this->table.' where vic_eventtype IN ("virtual exhibition", "meeting", "Webinar") AND DATE(CURRENT_DATE()) BETWEEN vic_eventstartdate AND vic_eventenddate AND vic_modification_status = "Published" order by vic_date';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_online_upcoming_event(){
        $eventDate = date('Y-m-d',strtotime('+1 day'));
        $sql = 'select t1.*,t2.vic_companyname from '.$this->table.' as t1 join '.$this->table2.' as t2 ON t1.vic_company_idvic_company = t2.idvic_company where vic_eventtype IN ("virtual exhibition", "meeting", "Webinar") AND DATE("'.$eventDate.'") BETWEEN vic_eventstartdate AND vic_eventenddate AND vic_modification_status = "Published" order by vic_date';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_onsite_event(){
        $sql = 'select * from '.$this->table.' where vic_eventtype IN ("Exhibition","Conference","seminars") AND DATE(CURRENT_DATE()) BETWEEN vic_eventstartdate AND vic_eventenddate AND vic_modification_status = "Published" order by vic_date';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_onsite_upcoming_event(){
        $eventDate = date('Y-m-d',strtotime('+1 day'));
        $sql = 'select t1.*,t2.vic_companyname from '.$this->table.' as t1 join '.$this->table2.' as t2 ON t1.vic_company_idvic_company = t2.idvic_company where vic_eventtype IN ("Exhibition","Conference","seminars") AND DATE("'.$eventDate.'") BETWEEN vic_eventstartdate AND vic_eventenddate AND vic_modification_status = "Published" order by vic_date';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_event_info($eventID){
        $sql = 'select * from '.$this->table.' where idvic_events = '.$eventID;
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function get_event_logo_ads_banner($eventID){
        $sql = 'select vic_logo,vic_banners,vic_advertisement,vic_advertisement from '.$this->table.' where idvic_events = '.$eventID;
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function get_conclusion_report($eventID){
        $sql = 'select vic_conclusion_report from '.$this->table.' where idvic_events = '.$eventID;
        $result_set = $this->db->query($sql);
        if($result_set->num_rows() > 0){
            return $result_set->first_row();
        }else{
            return false;
        }
    }
    public function get_booked_event_bydate($date){
        $sql = 'select * from '.$this->table.' where "'.$date.'" BETWEEN vic_eventstartdate AND vic_eventenddate  AND vic_modification_status = "Published"';
        $result_set = $this->db->query($sql);
        if($result_set){
            return $result_set;
        }
        else
        {
            return false;
        }
    }


    public function get_user_id_by_event_id($id)
    {
        $sql = 'select vic_user_id from '.$this->table.' where idvic_events = "'.$id.'"';
        $result_set = $this->db->query($sql);
        if($result_set){
            return $result_set->result();
        }else{
            return false;
        }
    }

    public function get_email_by_user_id($userid)
    {
        $sql = 'select user_email from '.$this->table3.' where iduser_details = "'.$userid.'"';
        $result_set = $this->db->query($sql);
        if($result_set){
            return $result_set->result();
        }else{
            return false;
        }
    }

    public function get_mail_by_event_id($id)
    {
        $sql = 'select vic_user_firstname, user_email from '.$this->table3.' INNER JOIN '.$this->table4.' ON '.$this->table3.'.iduser_details = '.$this->table4.'.vic_users_iduser_details where vic_users_iduser_details = "'.$id.'"';
        $result_set = $this->db->query($sql);
        if($result_set){
            return $result_set->result();
        }else{
            return false;
        }
    }
    public function update_registration_count($id){
        $this->db->set('vic_events_register_count', 'vic_events_register_count+1', FALSE);        
        $where = array('idvic_events' =>$id);
        $this->db->where($where);
        $this->db->update($this->table);
    }
    public function get_email_by_company_id($companyId)
    {
        $sql = 'select user_email from '.$this->table3.' INNER JOIN '.$this->table4.' ON '.$this->table3.'.iduser_details = '.$this->table4.'.vic_users_iduser_details where vic_company_idvic_company = "'.$companyId.'"';
        $result_set = $this->db->query($sql);
        if($result_set){
            return $result_set->result();
        }else{
            return false;
        }
    }
}       