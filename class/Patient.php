<?php
require_once 'Config.php';

class Patient extends Config{
  
  public function insert($patient_name,$gender, $age, $birthday){
    $sql = "INSERT INTO patient(patient_name, gender, age, birthday) VALUES('$patient_name', '$gender', '$age', '$birthday')";
    $result = $this->conn->query($sql);
    if($result){
      $this->redirect_js('patient_show.php');
    }else{
      echo "Error in inserting record".$this->conn->error;
    }
  }

  public function get_patient(){
    //query
    $sql = "SELECT * FROM patient";
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
