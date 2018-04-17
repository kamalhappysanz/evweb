<?php

Class Pollingmodel extends CI_Model
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



    function get_user_role(){
      $select="SELECT * FROM  edu_role WHERE role_id!='1' AND role_id!='5'";
      $resultset=$this->db->query($select);
      return $resultset->result();

    }



  function create_poll($user_role,$poll_end_date,$poll_title,$poll_desc,$status,$user_id){
    $year_id=$this->getYear();
    $query="INSERT INTO edu_poll_master (year_id,user_role,poll_date,poll_due_date,poll_title,poll_desc,status,created_at,created_by)VALUES('$year_id','$user_role',NOW(),'$poll_end_date','$poll_title','$poll_desc','$status',NOW(),'$user_id')";
    $resultset=$this->db->query($query);
    if($resultset){
      echo "success";
    }else{
      echo "failed";
    }
  }

  function view_polls(){

    $query="SELECT er.user_type_name,epm.* FROM edu_poll_master AS epm LEFT JOIN edu_role AS er ON er.role_id=epm.user_role order by epm.id desc";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


function edit_polls($id){
   $de_id=base64_decode($id);
   $m_id=$de_id/5678;
  $query="SELECT er.user_type_name,epm.* FROM edu_poll_master AS epm LEFT JOIN edu_role AS er ON er.role_id=epm.user_role where epm.id='$m_id'";
  $resultset=$this->db->query($query);
  return $resultset->result();
}



function update_poll($user_role,$poll_end_date,$poll_title,$poll_desc,$status,$id,$user_id){
   $query="UPDATE edu_poll_master SET user_role='$user_role',poll_due_date='$poll_end_date',poll_title='$poll_title',poll_desc	='$poll_desc',status='$status',created_at=NOW(),created_by='$user_id' WHERE id='$id'";
  $resultset=$this->db->query($query);
  if($resultset){
    echo "success";
  }else{
    echo "failed";
  }
}



function addoptions($poll_id,$status,$poll_option,$user_id){
  $de_id=base64_decode($poll_id);
  $m_id=$de_id/5678;
  $query="INSERT INTO edu_poll_options (poll_id,poll_options,status,created_at,created_by)VALUES('$m_id','$poll_option','$status',NOW(),'$user_id')";
  $resultset=$this->db->query($query);
  if($resultset){
    $data= array("status" => "success");
    return $data;
  }else{
    $data= array("status" => "success");
    return $data;
  }
}


function check_option_exist($id,$poll_options){
  $de_id=base64_decode($id);
  $m_id=$de_id/5678;
  $query="SELECT * FROM edu_poll_options WHERE id!='$m_id' and poll_options='$poll_options'";
  $resultset=$this->db->query($query);
  if($resultset->num_rows()>0){
    echo "false";
      }else{
        echo "true";
    }

}


function viewoptions($m_id){
  $de_id=base64_decode($m_id);
  $id=$de_id/5678;
  $query="SELECT * FROM edu_poll_options WHERE poll_id='$id' order by id desc";
  $resultset=$this->db->query($query);
  return $resultset->result();
}




  function changepolling_status($id,$status,$user_id){
    $query="UPDATE edu_poll_options SET status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $resultset=$this->db->query($query);
   if($resultset){
     echo "success";
   }else{
     echo "failed";
   }
  }

}
?>
