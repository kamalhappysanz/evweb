<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studymaterial extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('teachermodel');
			$this->load->model('class_manage');
			$this->load->model('subjectmodel');
			$this->load->model('studymaterialmodel');
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
			 $datas['getall_class']=$this->class_manage->getall_class();
	 		 $this->load->view('header');
	 		 $this->load->view('studymaterial/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create_material(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
 			if($user_type==1)
			{
		   $class_id=$this->input->post('class_id');
			 $subject_id=$this->input->post('subject_id');
			 $e_title=$this->input->post('e_title');
		   $e_desc=$this->input->post('e_desc');
			 $status=$this->input->post('status');
			 $datas=$this->studymaterialmodel->create_material($class_id,$subject_id,$e_title,$e_desc,$status,$user_id);
			 }
			 else{
					redirect('/');
			 }
		}


		public function update_material(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		 {
			$id=$this->input->post('id');
			$class_id=$this->input->post('class_id');
		  $subject_id=$this->input->post('subject_id');
		  $e_title=$this->input->post('e_title');
		  $e_desc=$this->input->post('e_desc');
		  $status=$this->input->post('status');
			$datas=$this->studymaterialmodel->update_material($id,$class_id,$subject_id,$e_title,$e_desc,$status,$user_id);
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

		public function get_subject_for_class(){
			$user_id=$this->session->userdata('user_id');
			$class_id=$this->input->post('class_id');
			$datas['res']=$this->subjectmodel->get_subject_to_class($class_id);
			echo json_encode($datas['res']);

		}

		public function edit_material($id){
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res']=$this->studymaterialmodel->edit_material($id);
			if($user_type==1){
			 $datas['getall_class']=$this->class_manage->getall_class();
	 		 $this->load->view('header');
	 		 $this->load->view('studymaterial/edit_material',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }

		}

		public function contents(){
			$datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$e_learn_id=$this->uri->segment(3);
				$datas['res_file']=$this->studymaterialmodel->view_uploaded_file($e_learn_id);
				$datas['res_video']=$this->studymaterialmodel->view_video_file($e_learn_id);
				$this->load->view('header');
				$this->load->view('studymaterial/add_contents',$datas);
				$this->load->view('footer');
			}else{

			}
		}


		public function uploadfile(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$e_learn_id=$this->input->post('e_learn_id');
						$status=$this->input->post('status');
					$user_file = $_FILES["e_learn_file"]["name"];
					if(empty($user_file)){
						 $e_learn_file=' ';
					 }else{
						 $temp = pathinfo($user_file, PATHINFO_EXTENSION);
						 $e_learn_file = round(microtime(true)) . '.' . $temp;
						 $uploaddir_file = 'assets/material/';
						 $user_resume_file = $uploaddir_file.$e_learn_file;
						 move_uploaded_file($_FILES['e_learn_file']['tmp_name'], $user_resume_file);
					 }
					  $ext='.'.$temp;
					 $datas=$this->studymaterialmodel->uploadfile($e_learn_id,$e_learn_file,$ext,$status,$user_id);
					 if($datas['status']=='success'){
						 	redirect('studymaterial/contents/'.$e_learn_id.'');
					 }else{
						 redirect('studymaterial/contents/'.$e_learn_id.'');
					 }
			}else{

			}
		}



		public function videolink(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 $e_learn_id=$this->input->post('e_learn_id');
				 $status=$this->input->post('status');
				 $e_learn_video_link=$this->input->post('e_learn_video_link');
				 $datas=$this->studymaterialmodel->video_link($e_learn_id,$e_learn_video_link,$status,$user_id);
					 if($datas['status']=='success'){
							redirect('studymaterial/contents/'.$e_learn_id.'');
					 }else{
						 redirect('studymaterial/contents/'.$e_learn_id.'');
					 }
			}else{

			}
		}


		public function changestatus_video(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$id=$this->input->post('sel');
			$status=$this->input->post('stat');
			$datas=$this->studymaterialmodel->changestatus_video($id,$status,$user_id);
		}

		public function changestatus_file(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$id=$this->input->post('sel');
			$status=$this->input->post('stat');
			$datas=$this->studymaterialmodel->changestatus_file($id,$status,$user_id);
		}









}
