<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polling extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('subjectmodel');
			$this->load->model('pollingmodel');
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
			 $datas['get_user_role']=$this->pollingmodel->get_user_role();
			 $datas['get_all_polls']=$this->pollingmodel->view_polls();
	 		 $this->load->view('header');
	 		 $this->load->view('polling/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create_poll(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
 			if($user_type==1)
			{
		   $user_role=$this->input->post('user_role');
			 $end_date=$this->input->post('poll_end_date');
			 $dateTime = new DateTime($end_date);
			 $poll_end_date=date_format($dateTime,'Y-m-d' );
			 $poll_title=$this->input->post('poll_title');
		   $poll_desc=$this->input->post('poll_desc');
			 $status=$this->input->post('status');
			 $datas=$this->pollingmodel->create_poll($user_role,$poll_end_date,$poll_title,$poll_desc,$status,$user_id);
			 }
			 else{
					redirect('/');
			 }
		}


		public function update_poll(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		 {
			 $user_role=$this->input->post('user_role');
			 $end_date=$this->input->post('poll_end_date');
			 $dateTime = new DateTime($end_date);
			 $poll_end_date=date_format($dateTime,'Y-m-d' );
			 $poll_title=$this->input->post('poll_title');
			 $poll_desc=$this->input->post('poll_desc');
			 $status=$this->input->post('status');
			 $id=$this->input->post('id');
			 $datas=$this->pollingmodel->update_poll($user_role,$poll_end_date,$poll_title,$poll_desc,$status,$id,$user_id);
			}
			else{
				 redirect('/');
			}
		}


// GET ALL ADMISSION DETAILS

		public function view(){
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
      $user_type=$this->session->userdata('user_type');
			 if($user_type==1){

			 $datas['res']=$this->studymaterialmodel->view_material();
			 $this->load->view('header');
			 $this->load->view('studymaterial/view',$datas);
			 $this->load->view('footer');
			 }
		 else{
				redirect('/');
		 }
		}



		public function edit_polls($id){
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res']=$this->pollingmodel->edit_polls($id);
			if($user_type==1){
			  $datas['get_user_role']=$this->pollingmodel->get_user_role();
	 		 $this->load->view('header');
	 		 $this->load->view('polling/edit_material',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }

		}

		public function options(){
			$datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$m_id=$this->uri->segment(3);
				$datas['res_option']=$this->pollingmodel->viewoptions($m_id);
				$this->load->view('header');
				$this->load->view('polling/add_options',$datas);
				$this->load->view('footer');
			}else{

			}
		}






		public function addoptions(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 $poll_id=$this->input->post('poll_id');
				 $status=$this->input->post('status');
				 $poll_option=$this->input->post('poll_options');
				 $datas=$this->pollingmodel->addoptions($poll_id,$status,$poll_option,$user_id);
					 if($datas['status']=='success'){
						 	$this->session->set_flashdata('msg', 'Option Added Successfully');
							redirect('polling/options/'.$poll_id.'');
					 }else{
						 redirect('polling/options/'.$poll_id.'');
					 }
			}else{

			}
		}


		public function changepolling_status(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$id=$this->input->post('sel');
			$status=$this->input->post('stat');
			$datas=$this->pollingmodel->changepolling_status($id,$status,$user_id);
		}



		public function check_option_exist(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$poll_options=$this->input->post('poll_options');
			$id=$this->uri->segment(3);
			$datas=$this->pollingmodel->check_option_exist($id,$poll_options);
		}







}
