<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by Anand Kulkarni.
 * Date: 06/08/2020
 * Project: MyHelse Project
 */
class File_upload_model extends CI_Model{

    var $data = array();

    /**
     * @param $field_name input type file field name
     * @param $file_type desired file types allowed. for eg. jpg|png or pdf|doc
     * @param null $destination subdirectory to move uploaded file to. for eg. slider, article, profile_pictures
     * @return array return error if occurred of file path of uploaded file
     */
    function do_upload($field_name, $file_type, $destination = null ){
        $config = array();
        
        if( null != $destination) {
            $config['upload_path'] = './upload/' . $destination;
        }
        else {
            $config['upload_path'] = './upload/';
        }
        $config['allowed_types'] = $file_type;
        $config['encrypt_name']= true;
        
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            $this->data['error'] = true;
            $this->data['msg'] = $this->upload->display_errors('<span>', '</span>');
        } else {
            $file_data = $this->upload->data();
            $this->data['error'] = false;
            $this->data['msg'] = "File uploaded. ";
            $this->data['file_path'] = $file_data['file_name'];
            $this->do_thumbnail($file_data, $destination);
        }
        return $this->data;
    }

    function do_thumbnail($file, $destination){
        $config['image_library'] = 'gd2';
        $config['source_image']	= $file['full_path'];
        $config['quality'] = '1000%';
        $config['new_image'] = './upload/' . $destination .'/thumbs/';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']	= 240 ;
        $config['height']	= 200;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }
}
