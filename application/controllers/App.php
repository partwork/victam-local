<?php

use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

defined('BASEPATH') or exit('No direct script access allowed');
class App extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('Forums_model', 'forums_model');
		$this->load->model('MarketingInfo_model', 'mkt_model');
	}

	public function index()
	{
		if ($this->session->userdata('userrole')) {
		} else {
			try {
				$data['activePage'] = "home";
				$data['banner'] = $this->home_model->get_active_banner();
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['news'] = $this->home_model->get_latest_news();

				$this->load->view('css_js_helpers');
				$this->load->view('home/h_css_js_helpers');
				$this->load->view('home/home', $data);
			} catch (\Throwable $th) {
				throw $th; 
			}
		}
	}

	public function market_info()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "marketInfo";

				$magzine_data = $this->mkt_model->get_magazins();
				$magzine_data = (!empty($magzine_data)) ? $magzine_data : NULL;
				$data['magzine_list'] = $magzine_data;

				$this->load->view('css_js_helpers');
				$this->load->view('market_info/m_css_js_helpers');
				$this->load->view('market_info/market_info', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function who_Is_Who()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "whoIsWho";
				$this->load->view('css_js_helpers');
				$this->load->view('who_is_who/w_css_js_helpers');
				$this->load->view('who_is_who/who_is_who', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function resource_library()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "resourceLibrary";
				$this->load->view('css_js_helpers');
				$this->load->view('resource-library/rl_css_js_helpers');
				$this->load->view('resource-library/resource-library', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function events()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "events";
				$this->load->view('css_js_helpers');
				$this->load->view('events/e_css_js_helpers');
				$this->load->view('events/events', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function matchmaking()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "matchmaking";
				$this->load->view('css_js_helpers');
				$this->load->view('matchmaking/mm_css_js_helpers');
				$this->load->view('matchmaking/matchmaking', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function jobs()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "jobs";
				$this->load->view('css_js_helpers');
				$this->load->view('jobs/j_css_js_helpers');
				$this->load->view('jobs/jobs', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function forums($limit = NULL, $offset = NULL)
	{
		try {

			$limit = ($limit == NULL) ? '' : $limit;
			$offset = ($limit == NULL) ? '' : $offset;

			$forum_data = $this->forums_model->get_Forum_list();
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
					

					$res1 = (isset($data)) ? true : false;
						
					
					$like_status = 'default';
					$dislike_status = 'default';

					if ($res1 == true && isset($data->vic_forum_like_dislike) && $data->vic_forum_like_dislike == 'like') {
						$like_status = 'like';
					}
					if ($res1 == true && isset($data->vic_forum_like_dislike) && $data->vic_forum_like_dislike == 'dislike') {
						$dislike_status = 'dislike';
					}



					$like_tbl_id = ($res1 == true) ? $data->idvic_forum_like : '';

					$img_like_default = base_url('application/assets/shared/img/icon/thumbs_up.png');
					$img_like_blue = base_url('application/assets/shared/img/icon/thumbs_up_blue.png');

					$img_dislike_default = base_url('application/assets/shared/img/icon/thumbs_down.png');
					$img_dislike_red = base_url('application/assets/shared/img/icon/thumbs_down_red.png');

					$like_img = ($like_status == true && isset($data->vic_forum_like_dislike) && $data->vic_forum_like_dislike == 'like') ? $img_like_blue : $img_like_default;
					$dis_like_img = ($res1 == true && isset($data->vic_forum_like_dislike) && $data->vic_forum_like_dislike == 'dislike') ? $img_dislike_red : $img_dislike_default;

					$obj_like = json_encode(array(
						"liktblid" => $like_tbl_id, "event" => $like_btn, "status" => $like_status,
						"id" => $value->idvic_forum, "defaultimg" => $img_like_default, "blueimg" => $img_like_blue
					));

					$obj_dislike = json_encode(array(
						'liktblid' => $like_tbl_id, 'event' => $like_btn, 'status' => $dislike_status,
						'id' => $value->idvic_forum, 'defaultimg' => $img_dislike_default, 'blueimg' => $img_dislike_red
					));

					$time=((int)$value->post_totalmin>60) ? $value->post_totalhr.' hr' : $value->post_totalmin.' min';

		                if((int)$value->post_totalmin<60 && (int)$value->post_totalmin!=0){
		                    $time=$value->post_totalmin.' min.';
		                }
		                elseif((int)$value->post_totalhr<24 && (int)$value->post_totalmin>60){
		                    $time=$value->post_totalhr.' hr';
		                }
		                elseif($value->DAY!=0 && (int)$value->post_totalhr>=24){
		                    $time=$value->DAY.' Days';
		                
		                }

					$str .= '<div class="row mt-5 forums-card" id="forum_section'.$value->idvic_forum.'">
	                    <div class="col-sm-12 col-md-10 col-lg-12 mt-3 mb-3" id="main_like_div' . $value->idvic_forum . '">
	                        <div class="forums-title-des-like-wrap center-align-lable">
	                            <div class="text-center vertical-align pl-5 pr-5" id="lik_dislike_div'.$value->idvic_forum.'">
	                                <div class="like-wrap mb-2 "  data-id="' . $value->idvic_forum . '" >

	                                    <img id="like_btn_img' . $value->idvic_forum . '" class="like_btn like_event" src="' . $like_img . '" data-obj='.$obj_like.' >
	                                    
	                                    <span class="fs-12 fw-600 mb-1 mt-2 like-dislike-count" id="like_' . $value->idvic_forum . '">' . $value->total_like . '</span>
	                                </div>
	                                <div class="dislike-wrap " data-id="' . $value->idvic_forum . '" data-event="' . $dislike_btn . '">

	                                    <img id="dislike_btn_img' . $value->idvic_forum . '" class="dislike_btn unlike_event" width="17px" height="17px" src="' . $dis_like_img . '" data-obj=' . $obj_dislike . '>
	                                     
	                                    <span class="fs-12 fw-600 mb-1 mt-2 like-dislike-count" id="unlike_' . $value->idvic_forum . '">' . $value->total_dis_like . '</span>
	                                </div>
	                            </div>
	                            <div class="forums-title-des-like-wrap">
	                                <h5 class="fw-500 mb-3 text-title-small">' . $value->vic_forumname . '</h5>
	                                <p class="f-14 mb-1 desc-text">' . $value->vic_forumdescription . '</p>
	                            </div>
	                        </div>
	                        <div class="share-section f-14 ml-5">
	                            <span class="mr-3 text-light-grey fs-12"> 
	                            <img class="comment-icon mr--3" data-toggle="collapse" href="#collapseExample' . $value->idvic_forum . '" src="' . base_url() . 'application/assets/shared/img/icon/comment.png" width="14px" height="14px">' . $value->total_comment . '+</span>
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

	                                ' . $this->getCommentsDesign($value->idvic_forum,3) . '

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

			if ($this->session->userdata('userId')) {
				$sector_data = $this->forums_model->getSector($limit, $offset);
				$xdata['sector_list'] = $sector_data;
				$xdata['forum_list'] = $str;
				$xdata['activePage'] = "forums";
				$this->load->view('css_js_helpers');
				$this->load->view('forums/f_css_js_helpers');
				$this->load->view('forums/forums', $xdata);
			} else {
				redirect('register');
			}
		} catch (\Throwable $th) {
			throw $th;
		}
	}
	public function getCommentsDesign($id, $limit = NULL, $offset = NULL)
	{

		$forum_data = $this->forums_model->get_Forum_commnet_list($id, $limit, $offset);
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
			$str .= '<div class="comment-card mt-4 mb-4">
                    <div class="name-image-comment-wrap">
                        <img  src="' . base_url() . 'application/assets/shared/img/icon/user_icon.png" width="25px">
                        <div class="name-comment-wrap ml-3">
                            <p class="text-blue fs-16 fw-400 mb-1">' . $value->user_name . '</p>
                            <p class="fs-12 lh-1-8 fw-400 mb-2">' . $value->vic_forum_responsetext . '</p>

                            <div class="d-flex mb-2" id="lik_dislike_div'.$value->idvic_forum_responses.'">
                                <div class="mr-3">
                                    <img id="res_like_img' . $value->idvic_forum_responses . '" class="thumb-icon res_like_event" data-obj=' . $obj_like . ' src="' . base_url() . 'application/assets/shared/img/icon/thumbs_up_blue.png" width="15px" height="">
                                    <span class="text-blue fw-500 fs-12" id="res_like_count' . $value->idvic_forum_responses . '">' . $value->total_like . '</span>
                                </div>
                                <div class="mr-3">
                                    <img id="res_dislike_img' . $value->idvic_forum_responses . '" class="thumb-icon res_dislike_event" data-obj=' . $obj_dislike . ' src="' . base_url() . 'application/assets/shared/img/icon/thumbs_down_red.png" width="15px" height="">
                                    <span class="text-red fw-500 fs-12" id="res_unlike_count' . $value->idvic_forum_responses . '">' . $value->total_dis_like . '</span>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>';
		}
		$str_id = implode(',', $idnot);
		$str .= '<input type="hidden" name="notin" id="notin' . $id . '" value="' . $str_id . '">';
		return $str;
	}
	public function virtual_entertainment()
	{
		if ($this->session->userdata('userId')) {
			try {
				$data['company_logo'] = $this->home_model->get_active_banner();
				$data['activePage'] = "virtualEntertainment";
				$this->load->view('css_js_helpers');
				$this->load->view('virtual_entertainment/v_css_js_helpers');
				$this->load->view('virtual_entertainment/virtual_entertainment', $data);
			} catch (\Throwable $th) {
				throw $th;
			}
		} else {
			redirect('register');
		}
	}

	public function get_home_interview_list()
	{
		$result = $this->home_model->get_latest_interview();
		echo json_encode($result);
	}
	public function get_home_events_list()
	{
		$result = $this->home_model->get_latest_events();
		echo json_encode($result);
	}
	public function get_home_company_list()
	{
		$result = $this->home_model->get_company_info();
		echo json_encode($result);
	}
	public function get_home_latest_events()
	{
		$result = $this->home_model->get_latest_events();
		foreach ($result as $re) {
			$re->vic_date = date('m-d-Y', strtotime($re->vic_date));
			$re->vic_eventtype = ucfirst($re->vic_eventtype);
		}
		echo json_encode($result);
	}
	public function get_top_rated_events(){
		$result = $this->home_model->get_top_rated_events();
		echo json_encode($result);
	}
	public function get_upcoming_events()
	{
		$result = $this->home_model->get_upcoming_events();
		foreach ($result as $re) {
			if($re->vic_eventfrequency == 'Custom') {
				$re->vic_date = date('d M Y', strtotime($re->vic_eventstartdate)).' - '.date('d M Y', strtotime($re->vic_eventenddate)); 
			}else{	
				if(date('Y-m-d', strtotime($re->vic_date)) >= date('Y-m-d')){
					$re->vic_date = date('d M Y', strtotime($re->vic_date));
				}else{
					$re->vic_date = date('d M Y', strtotime('+1 day'));
				}
			}
		}
		echo json_encode($result);
	}
	public function mpdf()
	{
		require_once APPPATH . 'third_party/fpdf/fpdf.php';
		require_once APPPATH . 'third_party/fpdf/exfpdf.php';
		require_once APPPATH . 'third_party/fpdf/easyTable.php';
		$pdf = new exFPDF();
		$pdf->AddPage();
		$pdf->SetFont('Times', 'U', '', 10);
		$pdf->SetFillColor(100, 100, 100);
		$pdf->Image(base_url('upload/company/1.png'), 75, 0, 70, 33);
		$table1 = new easyTable($pdf, 1);
		$table1->easyCell('', 'font-size:20;align:C;font-style:B;paddingY:10');
		$table1->printRow();
		$table1->easyCell('www.google.com', 'font-size:12; align:R;paddingY:5; font-color:#00008B;');
		$table1->printRow();
		$table1->easyCell('Jan 15, 2021', 'font-size:12; align:R;');
		$table1->printRow();
		$table1->easyCell('VICTAM and Animal Health and Nutrition Asia postponed to 18 to 20 January 2021', 'font-size:16; align:L;');
		$table1->printRow();
		$table1->easyCell('', 'font-size:16; align:L;paddingY:3');
		$table1->printRow();
		$table1->easyCell('Due to the worldwide COVID-19 crisis, the management teams from the VICTAM Corporation and VIV
				  worldwide had decided earlier to postpone VICTAM and Animal Health and Nutrition Asia in Bangkok
				  to the second quarter of 2020.', 'font-size:12; align:L;');
		$table1->printRow();
		$table1->endTable(5);
		/**********************************/;
		$pdf->Output();
		//   $filename= ('sdsdf.pdf');
		//    $pdf->Output($filename,'D');
	}
	public function get_events_rightside_bar()
	{
		$result = $this->home_model->get_event_rightbar();
		if (!empty($result[0])) {
			echo json_encode($result);
		} else {
			echo json_encode(NULL);
		}
	}

	public function get_promoted_video()
	{
		$data = $this->home_model->get_active_promoted_video();
		echo json_encode($data);
	}

	public function get_advertisment_video()
	{
		$reqpage = $this->uri->segment(3);
		$value = urldecode($reqpage);
		
		$data = $this->home_model->get_active_advertisment_video($value);
		echo json_encode($data);
	}
	public function active_data()
	{
	    $data['vic_blogs_news']=array('set_column'=>'vic_bn_status','from_column'=>'duration_from');
	    $data['vic_advertisment']=array('set_column'=>'vic_advertisment_is_active','from_column'=>'vic_advertisment_date_from');
	    $data['vic_promoted_video']=array('set_column'=>'vic_promoted_video_is_active','from_column'=>'vic_promoted_video_duration_from');
	    $data['vic_home_banner']=array('set_column'=>'vic_banner_is_active','from_column'=>'vic_banner_duration_from','val'=>'enable');

	    $str='';
	    foreach ($data as $key => $value) {
	        $isactive=(isset($value['val'])) ? $value['val'] : 'active';
	       $str='update '.$key.' set '.$value["set_column"].'="'.$isactive.'" where DATE_FORMAT('.$value['from_column'].',"%Y-%m-%d")="'.date('Y-m-d').'"<br>'; 
	       $query = $this->db->query($str);
	    }
	    echo $str;
    }
    public function deactive_data()
	{
	    $data['vic_blogs_news']=array('set_column'=>'vic_bn_status','to_column'=>'duration_to');
	    $data['vic_advertisment']=array('set_column'=>'vic_advertisment_is_active','to_column'=>'vic_advertisment_date_to');
	    $data['vic_promoted_video']=array('set_column'=>'vic_promoted_video_is_active','to_column'=>'vic_promoted_video_duration_to');
	    $data['vic_home_banner']=array('set_column'=>'vic_banner_is_active','to_column'=>'vic_banner_duration_to','val'=>'enable');

	    $str='';
	    foreach ($data as $key => $value) {
	        $isactive=(isset($value['val'])) ? $value['val'] : 'inactive';
	       $str='update '.$key.' set '.$value["set_column"].'="'.$isactive.'" where DATE_FORMAT('.$value['to_column'].',"%Y-%m-%d")="'.date('Y-m-d').'"<br>'; 
	       $query = $this->db->query($str);
	    }
	    echo $str;
    }
}
