<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussion extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('teachermodel');
			$this->load->model('discussionmodel');
			$this->load->helper('url');
			$this->load->library('session');

 }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 // Class section


	 	public function home(){
	 		$datas=$this->session->userdata();
	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $datas['res']=$this->discussionmodel->view_discussion();
	 		 $this->load->view('header');
	 		 $this->load->view('discussion/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create_topic(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
 			if($user_type==1)
			{
		   $discussion_title=$this->db->escape_str($this->input->post('discussion_title'));
			 $discussion_topic=$this->db->escape_str($this->input->post('discussion_topic'));
			 $datas=$this->discussionmodel->create_topic($discussion_title,$discussion_topic,$user_id);
			 }
			 else{
					redirect('/');
			 }
		}



		public function viewtopic($id){
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
			 $datas['res_topic']=$this->discussionmodel->viewtopic($id);
			 $datas['res_comment']=$this->discussionmodel->view_all_comment($id);
	 		 $this->load->view('header');
	 		 $this->load->view('discussion/viewcomments',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }

		}

		public function add_comment(){
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$ds_id=$this->db->escape_str($this->input->post('ds_id'));
 			 $discussion_topic=$this->db->escape_str($this->input->post('discussion_topic'));
			 $datas=$this->discussionmodel->add_comment($ds_id,$discussion_topic,$user_id);
	 		 }
	 		 else{
	 				redirect('/');
	 		 }

		}

		public function changediscussion_status(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$id=$this->input->post('sel');
			$status=$this->input->post('stat');
			$datas=$this->discussionmodel->changediscussion_status($id,$status,$user_id);
		}







}
