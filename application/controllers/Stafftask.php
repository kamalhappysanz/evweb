<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stafftask extends CI_Controller {


	function __construct() {
		 parent::__construct();
			$this->load->model('teachermodel');
			$this->load->model('stafftaskmodel');
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
			$datas['res_user_role']=$this->teachermodel->get_user_rolename();
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
	 		 $this->load->view('header');
	 		 $this->load->view('task/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function create_task(){
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
 			if($user_type==1)
			{
		   $role_type_id=$this->input->post('user_role');
			 $task_to_user_id=$this->input->post('user_id');
			 $due_date_task=$this->input->post('due_date');
			 $dateTime = new DateTime($due_date_task);
       $due_date=date_format($dateTime,'Y-m-d' );
			 $task_title=$this->input->post('task_title');
		   $task_desc=$this->input->post('task_desc');
			 $status=$this->input->post('status');
			 $datas=$this->stafftaskmodel->create_task($role_type_id,$task_to_user_id,$due_date,$task_title,$task_desc,$status,$user_id);
			 }
			 else{
					redirect('/');
			 }
		}


		public function update_task(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		 {
			$role_type_id=$this->input->post('user_role');
			$task_to_user_id=$this->input->post('user_id');

			$id=$this->input->post('id');
			$due_date_task=$this->input->post('due_date');
			$dateTime = new DateTime($due_date_task);
			$due_date=date_format($dateTime,'Y-m-d' );
			$task_title=$this->input->post('task_title');
			$task_desc=$this->input->post('task_desc');
			$status=$this->input->post('status');
			$datas=$this->stafftaskmodel->update_task($role_type_id,$task_to_user_id,$due_date,$task_title,$task_desc,$status,$user_id,$id);
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

				 $datas['res']=$this->stafftaskmodel->view_task();
			 $this->load->view('header');
			 $this->load->view('task/view',$datas);
			 $this->load->view('footer');
			 }
		 else{
				redirect('/');
		 }
		}

		public function get_user_list(){
			$user_id=$this->session->userdata('user_id');
			$user_role=$this->input->post('user_role');
			$datas['res']=$this->stafftaskmodel->get_user_list($user_role);
			echo json_encode($datas['res']);

		}

		public function edit_task($id){
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$datas['res']=$this->stafftaskmodel->edit_task($id);
			if($user_type==1){
				$datas['res_user_role']=$this->teachermodel->get_user_rolename();
				$datas['res_staff']=$this->stafftaskmodel->get_user_list_staff();
				$datas['res_teacher']=$this->stafftaskmodel->get_user_list_teacher();
	 		 $this->load->view('header');
	 		 $this->load->view('task/edit_task',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }

		}









}
