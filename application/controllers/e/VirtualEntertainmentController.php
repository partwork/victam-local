<?php defined('BASEPATH') or exit('No direct script access allowed');

class VirtualEntertainmentController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('VirtualEntertainment_model', 'vet');
    }

    public function load_video_gallery_View()
    {
        if ($this->session->userdata('userId')) {
            $data['activePage'] = "virtualEntertainment";
            $list = $this->vet->getGallaryvideo_list();
            $data['list'] = (!empty($list)) ? $list : NULL;
            $this->load->view('css_js_helpers');
            $this->load->view('virtual_entertainment/video_gallery/vg_css_js_helpers');
            $this->load->view('virtual_entertainment/video_gallery/video_gallery', $data);
        } else {
            redirect('register');
        }
    }
}
