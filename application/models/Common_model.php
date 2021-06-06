<?php

class Common_model extends CI_Model
{
    public function get_company_info($id)
    {
        $sql = 'select idvic_company as id, vic_companyname as name, vic_companydesc as description from vic_company where idvic_company = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function resource_library_details_by_id($id)
    {
        $sql = 'select idvic_resource_library as id, vic_resource_title as name, vic_resource_desc as description from vic_resource_library where idvic_resource_library = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_jobs_details_by_id($id)
    {
        $sql = 'select idvic_jobs as id, vic_jobsdesignation as name, vic_jobsdescription as description from vic_jobs where idvic_jobs = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
    public function get_forum_details_by_id($id)
    {
        $sql = 'select idvic_forum as id, vic_forumname as name, vic_forumdescription as description from vic_forum where idvic_forum = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_news_details_by_id($id)
    {
        $sql = 'select idvic_blogs_news as id, vic_bn_title as name, vic_description as description from vic_blogs_news where idvic_blogs_news = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }

    public function get_articles_details_by_id($id)
    {
        $sql = 'select idvic_blogs_news as id, vic_bn_title as name, vic_description as description from vic_blogs_news where idvic_blogs_news = "'.$id.'"';
        $result_set = $this->db->query($sql);
        return $result_set->result();
    }
}