<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ForumsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forums_model', 'forums_model');
        $this->load->model('admin/others/Notification_model');   

    }

    public function index()
    {
        try {
            $this->load_forums_View();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function lik_dislike_count($limit = NULL, $offset = NULL, $id = NULL)
    {
        
        $limit = ($limit == NULL) ? '' : $limit;
        $offset = ($limit == NULL) ? '' : $offset;

        $forum_data = $this->forums_model->get_Forum_list(NULL, NULL, $id);
        $str = "";

        if (isset($forum_data) && !empty($forum_data)) {
            foreach ($forum_data as $key => $value) 
            {

                $like_btn = 'like';
                $dislike_btn = 'dislike';

                $user_id = '';
                if ($this->session->userdata('userId')) {
                    $user_id = $this->session->userdata('userId');
                }
                $data = $this->forums_model->getForumLikeData(array('idvic_forum' => $value->idvic_forum, 'iduser_details_vic_forum_likes' => $user_id));
                $res1 = (!empty($data)) ? true : false;

                $like_status = 'default';
                $dislike_status = 'default';

                if ($res1 == true && $data->vic_forum_like_dislike == 'like') {
                    $like_status = 'like';
                }
                if ($res1 == true && $data->vic_forum_like_dislike == 'dislike') {
                    $dislike_status = 'dislike';
                }



                $like_tbl_id = ($res1 == true) ? $data->idvic_forum_like : '';

                $img_like_default = base_url('application/assets/shared/img/icon/thumbs_up.png');
                $img_like_blue = base_url('application/assets/shared/img/icon/thumbs_up_blue.png');

                $img_dislike_default = base_url('application/assets/shared/img/icon/thumbs_down.png');
                $img_dislike_red = base_url('application/assets/shared/img/icon/thumbs_down_red.png');

                $like_img = ($res1 == true && $data->vic_forum_like_dislike == 'like') ? $img_like_blue : $img_like_default;
                $dis_like_img = ($res1 == true && $data->vic_forum_like_dislike == 'dislike') ? $img_dislike_red : $img_dislike_default;

                $obj_like = json_encode(array(
                    "liktblid" => $like_tbl_id, "event" => $like_btn, "status" => $like_status,
                    "id" => $value->idvic_forum, "defaultimg" => $img_like_default, "blueimg" => $img_like_blue
                ));

                $obj_dislike = json_encode(array(
                    'liktblid' => $like_tbl_id, 'event' => $like_btn, 'status' => $dislike_status,
                    'id' => $value->idvic_forum, 'defaultimg' => $img_dislike_default, 'blueimg' => $img_dislike_red
                ));

                $str .= '
                            <div class="text-center vertical-align pl-5 pr-5" id="lik_dislike_div'.$value->idvic_forum.'">
                                <div class="like-wrap mb-2 "  data-id="' . $value->idvic_forum . '" >

                                    <img class="like_btn like_event ld-img" src="' . $like_img . '" data-obj=' . $obj_like . ' >
                                    
                                    <span class="fs-12 fw-600 mb-1 mt-2 like-dislike-count" id="like_'.$value->idvic_forum.'">' . $value->total_like. '</span>
                                </div>
                                <div class="dislike-wrap " data-id="' . $value->idvic_forum . '" data-event="' . $dislike_btn . '">

                                    <img class="dislike_btn unlike_event ld-img" src="' . $dis_like_img . '" data-obj=' . $obj_dislike . '>
                                     
                                    <span class="fs-12 fw-600 mb-1 mt-2 like-dislike-count" id="unlike_'.$value->idvic_forum.'">' . $value->total_dis_like . '</span>
                                </div>
                            </div>';
            }
        }
        return $str;
    }
    public function res_like_dislike_count($id, $limit = NULL, $notin = NULL){
        $limit = ($limit == NULL) ? '' : $limit;
        $notin = ($notin == NULL || $notin == '') ? NULL : $notin;

        $forum_data = $this->forums_model->get_Forum_commnet_list($id, $limit, $notin,'true');
        $str = "";

        $idnot = array();
        foreach ($forum_data as $key => $value) {

            $like_btn = 'like';
            $dislike_btn = 'dislike';

            $data = $this->forums_model->getForumResponeLikeData(array('vic_forum_responses_idvic_forum_responses' => $value->idvic_forum_responses, 'vic_users_iduser_details' => 13));
            $res1 = (!empty($data)) ? true : false;

            $like_status = 'default';
            $dislike_status = 'default';

            if ($res1 == true && $data->vic_forum_response_like_dislike == 'like') {
                $like_status = 'like';
            }
            if ($res1 == true && $data->vic_forum_response_like_dislike == 'dislike') {
                $dislike_status = 'dislike';
            }

            $like_tbl_id = ($res1 == true) ? $data->idvic_forum_response_likes : '';
            $forum_id = $value->vic_forum_idvic_forum;
            $obj_like = json_encode(array("liktblid" => $like_tbl_id, "event" => $like_btn, "status" => $like_status, "id" => $value->idvic_forum_responses, 'forum' => $forum_id));

            $obj_dislike = json_encode(array('liktblid' => $like_tbl_id, 'event' => $like_btn, 'status' => $dislike_status, 'id' => $value->idvic_forum_responses, 'forum' => $forum_id));
            $idnot[] = $value->idvic_forum_responses;
            $str .= '<div class="d-flex mb-2" id="lik_dislike_div'.$value->idvic_forum_responses.'">
                        <div class="mr-3">
                            <img class="thumb-icon res_like_event" data-obj=' . $obj_like . ' src="' . base_url() . 'application/assets/shared/img/icon/thumbs_up_blue.png" width="15px" height="">
                            <span class="text-blue fw-500 fs-12" id="res_like_count'.$value->idvic_forum_responses.'">' . $value->total_like . '</span>
                        </div>
                        <div class="mr-3">
                            <img class="thumb-icon res_dislike_event" data-obj=' . $obj_dislike . ' src="' . base_url() . 'application/assets/shared/img/icon/thumbs_down_red.png" width="15px" height="">
                            <span class="text-red fw-500 fs-12" id="res_unlike_count'.$value->idvic_forum_responses.'">' . $value->total_dis_like . '</span>
                        </div>
                    </div>';
        }
        $str_id = implode(',', $idnot);
        $str_id = trim($str_id . ',' . $notin, ',');
        if ($str == '') {
            return $str;
        }
        $str .= '<input type="hidden" name="notin" id="notin' . $id . '" value="' . $str_id . '">';
        return $str;
    }
    public function load_forums_View($limit = NULL, $offset = NULL, $id = NULL)
    {

        $limit = ($limit == NULL) ? '' : $limit;
        $offset = ($limit == NULL) ? '' : $offset;

        $forum_data = $this->forums_model->get_Forum_list(NULL, NULL, $id);
        $str = "";

        if (isset($forum_data) && !empty($forum_data)) {
            foreach ($forum_data as $key => $value) {

                $like_btn = 'like';
                $dislike_btn = 'dislike';

                $user_id = '';
                if ($this->session->userdata('userId')) {
                    $user_id = $this->session->userdata('userId');
                }
                $data = $this->forums_model->getForumLikeData(array('idvic_forum' => $value->idvic_forum, 'iduser_details_vic_forum_likes' => $user_id));
                $res1 = (!empty($data)) ? true : false;

                $like_status = 'default';
                $dislike_status = 'default';

                if ($res1 == true && $data->vic_forum_like_dislike == 'like') {
                    $like_status = 'like';
                }
                if ($res1 == true && $data->vic_forum_like_dislike == 'dislike') {
                    $dislike_status = 'dislike';
                }



                $like_tbl_id = ($res1 == true) ? $data->idvic_forum_like : '';

                $img_like_default = base_url('application/assets/shared/img/icon/thumbs_up.png');
                $img_like_blue = base_url('application/assets/shared/img/icon/thumbs_up_blue.png');

                $img_dislike_default = base_url('application/assets/shared/img/icon/thumbs_down.png');
                $img_dislike_red = base_url('application/assets/shared/img/icon/thumbs_down_red.png');

                $like_img = ($res1 == true && $data->vic_forum_like_dislike == 'like') ? $img_like_blue : $img_like_default;
                $dis_like_img = ($res1 == true && $data->vic_forum_like_dislike == 'dislike') ? $img_dislike_red : $img_dislike_default;

                $obj_like = json_encode(array(
                    "liktblid" => $like_tbl_id, "event" => $like_btn, "status" => $like_status,
                    "id" => $value->idvic_forum, "defaultimg" => $img_like_default, "blueimg" => $img_like_blue
                ));

                $obj_dislike = json_encode(array(
                    'liktblid' => $like_tbl_id, 'event' => $like_btn, 'status' => $dislike_status,
                    'id' => $value->idvic_forum, 'defaultimg' => $img_dislike_default, 'blueimg' => $img_dislike_red
                ));
                
                $time='';
                if((int)$value->post_totalmin<60 && (int)$value->post_totalmin!=0){
                    $time=$value->post_totalmin.' min.';
                }
                elseif((int)$value->post_totalhr<24 && (int)$value->post_totalmin>60){
                    $time=$value->post_totalhr.' hr';
                }
                elseif($value->DAY!=0 && (int)$value->post_totalhr>=24){
                    $time=$value->DAY.' Days';
                
                }
                $str .= '<div class="row mt-4 forums-card" id="forum_section'.$value->idvic_forum.'" >
                    <div class="col-sm-12 col-md-10 col-lg-12 mt-3 mb-3" id="main_like_div' . $value->idvic_forum . '">
                        <div class="forums-title-des-like-wrap center-align-lable">
                            <div class="text-center vertical-align pl-5 pr-5" id="lik_dislike_div'.$value->idvic_forum.'">
                                <div class="like-wrap mb-2 "  data-id="' . $value->idvic_forum . '" >

                                    <img class="like_btn like_event ld-img" src="' . $like_img . '" data-obj=' . $obj_like . ' >
                                    
                                    <span class="fs-12 fw-600 mb-1 mt-2 like-dislike-count" id="like_'.$value->idvic_forum.'">' . $value->total_like. '</span>
                                </div>
                                <div class="dislike-wrap " data-id="' . $value->idvic_forum . '" data-event="' . $dislike_btn . '">

                                    <img class="dislike_btn unlike_event ld-img" src="' . $dis_like_img . '" data-obj=' . $obj_dislike . '>
                                     
                                    <span class="fs-12 fw-600 mb-1 mt-2 like-dislike-count" id="unlike_'.$value->idvic_forum.'">' . $value->total_dis_like . '</span>
                                </div>
                            </div>
                            <div class="forums-title-des-like-wrap">
                                <h5 class="fw-500 mb-3 text-title-small">' . $value->vic_forumname . '</h5>
                                <p class="f-14 mb-1 desc-text">' . $value->vic_forumdescription . '</p>
                            </div>
                        </div>
                        <div class="share-section f-14 ml-5">
                            <span class="mr-3 text-light-grey fs-12"> <img class="comment-icon mr--3" data-toggle="collapse" href="#collapseExample' . $value->idvic_forum . '" src="' . base_url() . 'application/assets/shared/img/icon/comment.png" width="14px" height="14px">' . $value->total_comment . '+</span>
                            <!-- <span class="mr-3 text-light-grey fs-12">
                                 <img class="mr--3" src="' . base_url() . 'application/assets/shared/img/icon/view.png" width="20px" height=""></i> 226</span> -->
                            <span class="mr-3 text-light-grey fs-12">Share
                           
                           <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_forum_by_id/'.$value->idvic_forum.'" target="__blank"><span class="share-social-icon"><img class="ml-1" src="' . base_url() . 'application/assets/shared/img/icon/linkedin.png" width="15px" height="15px"></a>
                           
                            <a target="__blank" href="https://twitter.com/intent/tweet?text='.$value->vic_forumname.'-'.$value->vic_forumdescription.'" ><img class="ml-1" src="' . base_url() . 'application/assets/shared/img/icon/twitter.png" width="15px" height="15px"></a>
                            </span>

                            <span class="float-right">
                                <img src="' . base_url() . 'application/assets/shared/img/icon/user_icon.png" width="20px" height="">
                                <span class="ml-2 fs-12">Posted by <span class="text-red">' . $value->vic_user_firstname . '</span> <span class="text-light-grey ml-2">' . $time . ' ago</span> </span>
                            </span>
                        </div>

                        <div class="row ml-5">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comment_input' . $value->idvic_forum . '" placeholder="Write comment">
                            </div>
                            <div class="col-sm-2">
                                <button data-id="' . $value->idvic_forum . '" class="btn btn-blue btn-send btn-sm w-100 send_comment">Post</button>
                            </div>

                        </div>
                        <div class="row ml-5 collapse" id="collapseExample' . $value->idvic_forum . '">
                            <div class="col-sm-12" id="test' . $value->idvic_forum . '">

                                ' . $this->getCommentsDesign($value->idvic_forum) . '

                                <a  id="loadmore_btn' . $value->idvic_forum . '"  data-limit="1" data-offset="0" data-totalcomment="' . $value->total_comment . '"  data-id="' . $value->idvic_forum . '"role="button" class="text-blue f-14 text-right comm_loadmore">Load More Comments</a>
                            </div>
                        </div>
                        <div class="row ml-5 collapse show" id="loadMoreComment' . $value->idvic_forum . '">
                            

                        </div>
                        <div id="err_msg' . $value->idvic_forum . '"></div>
                    </div>
                </div>';
            }
        }
        if ($limit != NULL) {
            echo json_encode($str);
            exit;
        }
        if ($id != NULL) {
            return $str;
        }

        $sector_data = $this->forums_model->getSector($limit, $offset);
        $data['sector_list'] = $sector_data;

        $data['activePage'] = "forums";
        $data['forum_list'] = $str;

        $this->load->view('css_js_helpers');
        $this->load->view('forums/f_css_js_helpers');
        $this->load->view('forums/forums', $data);
    }
    public function load_morecomment()
    {
        $id = $_POST['id'];
        $limit = $_POST['limit'];
        $notin = (isset($_POST['notin'])) ? $_POST['notin'] : NULL;;

        // $CI =&get_instance();

        if ($this->input->is_ajax_request()) {
            $data = $this->getCommentsDesign($id,8, $notin);
            echo $data;
        } else {
            exit('No direct script access allowed');
        }
    }
    public function getCommentsDesign($id, $limit = NULL, $notin = NULL)
    {
        $limit = ($limit == NULL) ? '' : $limit;
        $notin = ($notin == NULL || $notin == '') ? NULL : $notin;

        $forum_data = $this->forums_model->get_Forum_commnet_list($id, $limit, $notin);
        $str = "";
        $idnot = array();
        foreach ($forum_data as $key => $value) {

            $like_btn = 'like';
            $dislike_btn = 'dislike';

            $data = $this->forums_model->getForumResponeLikeData(array('vic_forum_responses_idvic_forum_responses' => $value->idvic_forum_responses, 'vic_users_iduser_details' => 13));
            $res1 = (!empty($data)) ? true : false;

            $like_status = 'default';
            $dislike_status = 'default';

            if ($res1 == true && $data->vic_forum_response_like_dislike == 'like') {
                $like_status = 'like';
            }
            if ($res1 == true && $data->vic_forum_response_like_dislike == 'dislike') {
                $dislike_status = 'dislike';
            }

            $like_tbl_id = ($res1 == true) ? $data->idvic_forum_response_likes : '';
            $forum_id = $value->vic_forum_idvic_forum;
            $obj_like = json_encode(array("liktblid" => $like_tbl_id, "event" => $like_btn, "status" => $like_status, "id" => $value->idvic_forum_responses, 'forum' => $forum_id));

            $obj_dislike = json_encode(array('liktblid' => $like_tbl_id, 'event' => $like_btn, 'status' => $dislike_status, 'id' => $value->idvic_forum_responses, 'forum' => $forum_id));
            $idnot[] = $value->idvic_forum_responses;
            $str .= '
                   <div class="comment-card mt-4 mb-4">
                    <div class="name-image-comment-wrap">
                        <img src="' . base_url() . 'application/assets/shared/img/icon/user_icon.png" width="25px">
                        <div class="name-comment-wrap ml-3">
                            <p class="text-blue fs-16 fw-400 mb-1">' . $value->user_name . '</p>
                            <p class="fs-12 lh-1-8 fw-400 mb-2">' . $value->vic_forum_responsetext . '</p>

                            <div class="d-flex mb-2" id="lik_dislike_div'.$value->idvic_forum_responses.'">
                                <div class="mr-3">
                                    <img class="thumb-icon res_like_event" data-obj=' . $obj_like . ' src="' . base_url() . 'application/assets/shared/img/icon/thumbs_up_blue.png" width="15px" height="">
                                    <span class="text-blue fw-500 fs-12" id="res_like_count'.$value->idvic_forum_responses.'">' . $value->total_like . '</span>
                                </div>
                                <div class="mr-3">
                                    <img class="thumb-icon res_dislike_event" data-obj=' . $obj_dislike . ' src="' . base_url() . 'application/assets/shared/img/icon/thumbs_down_red.png" width="15px" height="">
                                    <span class="text-red fw-500 fs-12" id="res_unlike_count'.$value->idvic_forum_responses.'">' . $value->total_dis_like . '</span>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                ';
        }
        $str_id = implode(',', $idnot);
        $str_id = trim($str_id . ',' . $notin, ',');
        if ($str == '') {
            return $str;
        }
        $str .= '<input type="hidden" name="notin" id="notin' . $id . '" value="' . $str_id . '">';
        return $str;
    }

    public function like_event()
    {
      if ($this->input->is_ajax_request())
      {
        $result=$this->forums_model->forum_like_event($_POST);
        if($result)
        {
            $id=$this->input->post('id');
            $forum_data=$this->forums_model->get_Forum_list(NULL,NULL,$id);
            //$design=$this->load_forums_View(NULL,NULL,$id);
            //echo json_encode($forum_data[0]);
            $design = $this->lik_dislike_count(NULL, NULL, $id);
            echo $design;
            exit;
        }
    }
   } 
    public function res_like_event()
    {

      if ($this->input->is_ajax_request())
      {
        $result=$this->forums_model->forum_res_like_event($_POST);
        // $forum_data=$this->forums_model->get_Forum_commnet_list($_POST['forum'],NULL,NULL);
        // $forum_data=(isset($forum_data[0])) ? $forum_data[0] : NULL;
        // echo json_encode($forum_data);
        $design = $this->res_like_dislike_count($_POST['id'], NULL,NULL);
        echo $design;
      }  
    }
    public function load_new_forum_View()
    {
        if (!$this->session->userdata('userId')) {
            redirect('register');
        } else {
            $data['activePage'] = "forums";
            $sector_data = $this->forums_model->getSector();
            $data['sector_list'] = $sector_data;
            $this->load->view('css_js_helpers');
            $this->load->view('forums/f_css_js_helpers');
            $this->load->view('forums/new_forum', $data);
        }
    }
    public function add_forum()
    {
        $data['vic_forumname'] = $_POST['forumName'];
        $data['vic_forumsectorname'] = $_POST['sector'];
        $data['vic_forumdescription'] = $_POST['forumDescription'];
        $data['vic_created_at'] = date('Y-m-d H:i:s');
        $data['vic_forum_modification_dt'] = date('Y-m-d H:i:s');
        //$data['vic_modification_status'] ='Published';
        $data['vic_modification_status'] ='Published';

        $user_id = '';
        if ($this->session->userdata('userId')) {
            $user_id = $this->session->userdata('userId');
        }
        $data['vic_forum_userid'] = $user_id;

        $this->form_validation->set_rules('forumName', 'Forum Name', 'required');
        $this->form_validation->set_rules('sector', 'Secotr', 'required');
        $this->form_validation->set_rules('forumDescription', 'Forum Description', 'required');

        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('category_error', validation_errors());
            redirect(base_url('forums/new-forum'));
        }

        $result = $this->forums_model->add_forum($data, false);
        if ($result) {
            $this->send_notification();

            //$this->session->set_flashdata('category_success', 'Forum successfully posted.');
            echo json_encode(array('status'=>'success','msg'=>'Forum updated successfully.'));
        } else {
            //$this->session->set_flashdata('category_error', 'Failed to post forum');
            //redirect(base_url('forums/new-forum'));
            echo json_encode(array('status'=>'error','msg'=>'Failed to update the forum'));
        }
    }
    public function store_comment()
    {
        if ($this->input->is_ajax_request()) {
            $user_id = '';
            if ($this->session->userdata('userId')) {
                $user_id = $this->session->userdata('userId');
            }

            $data['vic_forum_responsetext'] = $this->input->post('comment');
            $data['vic_forum_idvic_forum'] = $this->input->post('id');
            $data['vic_forum_response_date'] = date('Y-m-d H:i:s');
            $data['vic_forum_response_urserid'] = $user_id;
            $result = $this->forums_model->comment_store($data);
            if ($result) {
                $id = $this->input->post('id');
                $design = $this->load_forums_View(NULL, NULL, $id);
                echo $design;
                exit;
            }
            echo json_encode($result);
        }
    }
    public function search_forums()
    {
        if ($this->input->is_ajax_request()) {

            $data = $this->forums_model->searchData($_POST);
            $design='';
            if (isset($data[0]) && !empty($data)) {
                //$id = $data[0]->idvic_forum;
                foreach ($data as $key => $value) {
                    $design.= $this->load_forums_View(NULL, NULL, $value->idvic_forum);    
                }

                
                echo $design;
                exit;
            } else {
                echo '<h2 class="text-center mt-5 text-blue">No Data Found</h2>';
            }
        } else {
            exit('No direct script access allowed');
        }
    }
    public function send_notification(){
        $userID = $this->session->userdata('userId');
        //notification
        $adminlist = $this->Notification_model->notify_user_list($userID);
        $output = $this->Notification_model->get_user_name($userID);
        
        $val['vic_user_id_sender'] = $userID;
        $val['vic_created_on'] = date('Y-m-d H:i:s');
        $val['vic_title'] = 'A new forum added to the portal';

        
        $insert_notification_batch = array();
        foreach($adminlist as $li){
            
            $val['vic_user_id_receiver'] = $li->iduser_details;
            array_push($insert_notification_batch,$val);   
        }
        
        $this->Notification_model->insert_notify_batch($insert_notification_batch);
    }
}
