<?php

Class Studymaterialmodel extends CI_Model
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





  function create_material($class_id,$subject_id,$e_title,$e_desc,$status,$user_id){
    $year_id=$this->getYear();
    $query="INSERT INTO edu_e_learn_master (year_id,class_id,e_title,e_desc,subject_id,status,created_at,created_by)VALUES('$year_id','$class_id','$e_title','$e_desc','$subject_id','$status',NOW(),'$user_id')";
    $resultset=$this->db->query($query);
    if($resultset){
      echo "success";
    }else{
      echo "failed";
    }
  }

  function view_material(){

    $query="SELECT eu.name,IFNULL(c.class_name, '') AS class_name,IFNULL(s.sec_name, '') AS sec_name,esu.subject_name,eelm.* FROM edu_e_learn_master AS eelm LEFT JOIN edu_users AS eu ON eelm.created_by=eu.user_id LEFT JOIN edu_classmaster AS cm ON eelm.class_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
    LEFT JOIN edu_sections AS s ON  cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON eelm.subject_id=esu.subject_id ORDER BY eelm.id DESC";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


function edit_material($id){
   $de_id=base64_decode($id);
   $m_id=$de_id/5678;
  $query="SELECT eu.name,IFNULL(c.class_name, '') AS class_name,IFNULL(s.sec_name, '') AS sec_name,esu.subject_name,eelm.* FROM edu_e_learn_master AS eelm LEFT JOIN edu_users AS eu ON eelm.created_by=eu.user_id LEFT JOIN edu_classmaster AS cm ON eelm.class_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id
  LEFT JOIN edu_sections AS s ON  cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON eelm.subject_id=esu.subject_id where eelm.id='$m_id'";
  $resultset=$this->db->query($query);
  return $resultset->result();
}



function update_material($id,$class_id,$subject_id,$e_title,$e_desc,$status,$user_id){
   $query="UPDATE edu_e_learn_master SET class_id='$class_id',subject_id='$subject_id',e_title='$e_title',e_desc	='$e_desc',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
  $resultset=$this->db->query($query);
  if($resultset){
    echo "success";
  }else{
    echo "failed";
  }
}

function uploadfile($e_learn_id,$e_learn_file,$ext,$status,$user_id){
  $de_id=base64_decode($e_learn_id);
  $m_id=$de_id/5678;
  $query="INSERT INTO edu_e_learning_file (e_learn_id,file_type,e_learn_file,status,created_at,created_by)VALUES('$m_id','$ext','$e_learn_file','$status',NOW(),'$user_id')";
  $resultset=$this->db->query($query);
  if($resultset){
    $data= array("status" => "success");
    return $data;
  }else{
    $data= array("status" => "success");
    return $data;
  }
}

function video_link($e_learn_id,$e_learn_video_link,$status,$user_id){
  $de_id=base64_decode($e_learn_id);
  $m_id=$de_id/5678;
  $query="INSERT INTO edu_e_learning_video (e_learn_id,e_learn_video_link,status,created_at,created_by)VALUES('$m_id','$e_learn_video_link','$status',NOW(),'$user_id')";
  $resultset=$this->db->query($query);
  if($resultset){
    $data= array("status" => "success");
    return $data;
  }else{
    $data= array("status" => "success");
    return $data;
  }
}

function view_uploaded_file($e_learn_id){
  $de_id=base64_decode($e_learn_id);
  $m_id=$de_id/5678;
  $query="SELECT * FROM edu_e_learning_file WHERE e_learn_id='$m_id' order by id desc";
  $resultset=$this->db->query($query);
  return $resultset->result();
}


function view_video_file($e_learn_id){
  $de_id=base64_decode($e_learn_id);
  $m_id=$de_id/5678;
  $query="SELECT * FROM edu_e_learning_video WHERE e_learn_id='$m_id' order by id desc";
  $resultset=$this->db->query($query);
  return $resultset->result();
}


  function changestatus_video($id,$status,$user_id){
    $query="UPDATE edu_e_learning_video SET status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $resultset=$this->db->query($query);
   if($resultset){
     echo "success";
   }else{
     echo "failed";
   }
  }

  function changestatus_file($id,$status,$user_id){
    $query="UPDATE edu_e_learning_file SET status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $resultset=$this->db->query($query);
   if($resultset){
     echo "success";
   }else{
     echo "failed";
   }
  }

}
?>
