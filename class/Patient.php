<?php
require_once 'Config.php';

class Patient extends Config{
  
  public function insert($patient_name,$gender, $birthday, $login_id){
    $sql = "INSERT INTO patient(patient_name, gender, birthday, user_id) VALUES('$patient_name', '$gender', '$birthday', '$login_id')";
    $result = $this->conn->query($sql);
    if($result){
      $this->redirect_js('patient_show.php');
    }else{
      echo "Error in inserting record".$this->conn->error;
    }
  }

  public function get_patient($login_id){
    //query
    $sql = "SELECT * FROM patient WHERE user_id=$login_id";
    $result = $this->conn->query($sql);

    //initialize an array
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }
    else{
      return $this->conn->error;
    }
  }
  public function get_patient_name($patient_id){
    $sql = "SELECT * FROM patient WHERE id=$patient_id";
      $result = $this->conn->query($sql);
  
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return $this->conn->error;
      }
  }













}
?>
