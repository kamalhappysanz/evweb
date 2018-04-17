<?php

Class Stafftaskmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }


  function get_user_list($user_role){
    $query="SELECT eu.user_master_id,et.name,eu.user_id FROM edu_users AS eu LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id WHERE eu.user_type='$user_role' AND eu.status='Active' AND et.status='Active'";
    $resultset=$this->db->query($query);
    if($resultset->num_rows()==0){
      $data= array("status" => "nodata");
      return $data;
    }else{
      $res= $resultset->result();
      $data= array("status" => "success","res" => $res);
      return $data;
    }
  }


  function create_task($role_type_id,$task_to_user_id,$due_date,$task_title,$task_desc,$status,$user_id){
    $query="INSERT INTO edu_task (user_role,task_to_user_id,due_date_task,task_title,task_desc,status,viewed,created_at,created_by)VALUES('$role_type_id','$task_to_user_id','$due_date','$task_title','$task_desc','$status','0',NOW(),'$user_id')";
    $resultset=$this->db->query($query);
    if($resultset){
      echo "success";
    }else{
      echo "failed";
    }
  }

  function view_task(){

    $query="SELECT eu.name,et.* FROM edu_task AS et LEFT JOIN edu_users AS eu ON et.task_to_user_id=eu.user_id order by et.id desc";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


function edit_task($id){
  $query="SELECT eu.name,et.* FROM edu_task AS et LEFT JOIN edu_users AS eu ON et.task_to_user_id=eu.user_id where et.id='$id'";
  $resultset=$this->db->query($query);
  return $resultset->result();
}

function get_user_list_staff(){
  $query="SELECT eu.user_master_id,et.name,eu.user_id  FROM edu_users AS eu LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id WHERE eu.user_type='5' AND eu.status='Active' AND et.status='Active'";
   $resultset=$this->db->query($query);
   return $resultset->result();

}

function get_user_list_teacher(){
  $query="SELECT eu.user_master_id,et.name,eu.user_id FROM edu_users AS eu LEFT JOIN edu_teachers AS et ON et.teacher_id=eu.user_master_id WHERE eu.user_type='2' AND eu.status='Active' AND et.status='Active'";
  $resultset=$this->db->query($query);
  return $resultset->result();

}

function update_task($role_type_id,$task_to_user_id,$due_date,$task_title,$task_desc,$status,$user_id,$id){
   $query="UPDATE edu_task SET user_role='$role_type_id',task_to_user_id='$task_to_user_id',task_date='$due_date',task_title	='$task_title',task_desc='$task_desc',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
  $resultset=$this->db->query($query);
  if($resultset){
    echo "success";
  }else{
    echo "failed";
  }
}


}
?>
