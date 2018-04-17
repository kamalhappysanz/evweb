<?php

Class Discussionmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }


  function getYear()
    {
      $sqlYear = "SELECT * FROM edu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year = $year_result->result();

      if($year_result->num_rows()==1)
      {
        foreach ($year_result->result() as $rows)
        {
            $year_id = $rows->year_id;
        }
        return $year_id;
      }
    }






  function create_topic($discussion_title,$discussion_topic,$user_id){
     $query="INSERT INTO edu_discussion_forum_master (discussion_title,discussion_topic,status,created_at,created_by)VALUES('$discussion_title','$discussion_topic','Active',NOW(),'$user_id')";
    $resultset=$this->db->query($query);
    if($resultset){
      echo "success";
    }else{
      echo "failed";
    }
  }

  function view_discussion(){

    $query="SELECT eu.name,eu.user_type,er.user_type_name,edfm.* FROM edu_discussion_forum_master AS edfm LEFT JOIN edu_users AS eu ON eu.user_id=edfm.created_by LEFT JOIN edu_role AS er ON er.role_id=eu.user_type  order by edfm.id desc";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


function viewtopic($id){
   $de_id=base64_decode($id);
   $m_id=$de_id/5678;
  $query="SELECT eu.name,eu.user_type,er.user_type_name,edfm.* FROM edu_discussion_forum_master AS edfm LEFT JOIN edu_users AS eu ON eu.user_id=edfm.created_by LEFT JOIN edu_role AS er ON er.role_id=eu.user_type WHERE edfm.id ='$m_id'";
  $resultset=$this->db->query($query);
  return $resultset->result();
}




function add_comment($ds_id,$discussion_topic,$user_id){
  $de_id=base64_decode($ds_id);
  $m_id=$de_id/5678;
  $query="INSERT INTO edu_discussion_comments (discussion_id,discussion_user_id,user_comment,status,created_at,created_by)VALUES('$m_id','$user_id','$discussion_topic','Active',NOW(),'$user_id')";
 $resultset=$this->db->query($query);
 if($resultset){
   echo "success";
 }else{
   echo "failed";
 }
}


function view_comments($id){
  $de_id=base64_decode($id);
  $m_id=$de_id/5678;
  $query="SELECT eu.name,eu.user_type,er.user_type_name,edfm.* FROM edu_discussion_comments AS edfm LEFT JOIN edu_users AS eu ON eu.user_id=edfm.created_by LEFT JOIN edu_role AS er ON er.role_id=eu.user_type WHERE edfm.id ='$m_id'";
  $resultset=$this->db->query($query);
  return $resultset->result();
}


  function view_all_comment($id){
    $de_id=base64_decode($id);
    $m_id=$de_id/5678;
    $query="SELECT eu.name,eu.user_type,er.user_type_name,edfm.* FROM edu_discussion_comments AS edfm LEFT JOIN edu_users AS eu ON eu.user_id=edfm.created_by LEFT JOIN edu_role AS er ON er.role_id=eu.user_type WHERE edfm.discussion_id ='$m_id'";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }

  function changediscussion_status($id,$status,$user_id){
    $query="UPDATE edu_discussion_forum_master SET status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $resultset=$this->db->query($query);
   if($resultset){
     echo "success";
   }else{
     echo "failed";
   }
  }

}
?>
