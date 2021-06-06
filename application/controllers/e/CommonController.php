<?php

class CommonController extends CI_Controller
{
	public function get_company_by_id()
	{
        $this->load->model('common_model');
		$id = $this->uri->segment(4);
		if($id){
			$data['company'] = $this->common_model->get_company_info($id);	
			$this->load->view('social/facebook', $data);
		}else{
			redirect('');
		}
	}


	public function get_resource_library_details_by_id($id)
	{
		$this->load->model('common_model');
		$id = $this->uri->segment(4);
		if($id){
			$data['company'] = $this->common_model->resource_library_details_by_id($id);	
			$this->load->view('social/resource-library', $data);
		}else{
			redirect('');
		}
	}

	public function get_jobs_by_id($id) 
	{
		$this->load->model('common_model');
		$id = $this->uri->segment(4);
		if($id){
			$data['company'] = $this->common_model->get_jobs_details_by_id($id);	
			$this->load->view('social/jobs', $data);
		}else{
			redirect('');
		}
	}
	public function get_forum_by_id($id)
	{
		$this->load->model('common_model');
		$id = $this->uri->segment(4);
		if($id){
			$data['company'] = $this->common_model->get_forum_details_by_id($id);	
			$this->load->view('social/forum', $data);
		}else{
			redirect('');
		}
	}

	public function get_news_by_id()
	{
		$this->load->model('common_model');
		$id = $this->uri->segment(4);
		if($id){
			$data['company'] = $this->common_model->get_news_details_by_id($id);	
			$this->load->view('social/news', $data);
		}else{
			redirect('');
		}
	}

	public function get_articles_by_id()
	{
		$this->load->model('common_model');
		$id = $this->uri->segment(4);
		if($id){
			$data['company'] = $this->common_model->get_articles_details_by_id($id);	
			$this->load->view('social/articles', $data);
		}else{
			redirect('');
		}
	}
}