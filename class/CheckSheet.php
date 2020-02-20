<?php
require_once 'Config.php';

class CheckSheet extends Config{
  
  public function insert($patient_id, $disease_id, $answer, $q_num){
    $today = date('Y-m-d');
    $sql = "INSERT INTO sheetrecord(patient_id, disease_id, created_at) VALUES('$patient_id', '$disease_id', '$today')";
    $result = $this->conn->query($sql);
    $sheetrecord_id = $this->conn->insert_id;
    if($result){
      foreach ($q_num as $num){
        $sql2 = "INSERT INTO checksheet(sheetrecord_id, question_id, answer) VALUES( '$sheetrecord_id', '$num', '$answer[$num]')";
        $result2 = $this->conn->query($sql2);
      }
      $sql3 = "INSERT INTO checksheet(sheetrecord_id, question_id, answer) VALUES( '$sheetrecord_id', '0', '$answer[0]')";
      $result3 = $this->conn->query($sql3);
      if($result2){
        $this->redirect_js('check_sheet_create1.php');
        return true;
      }
      else{
        return $this->conn->error;
      }

    }else{
      return $this->conn->error;
    }
  }
  public function next_question($patient_id, $disease_id){
    $sql = "SELECT * FROM question WHERE disease_id = $disease_id";
    $result = $this->conn->query($sql);
    $rows = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }else{
      return $this->conn->error;
    }
  }
  public function get_disease(){
    //query
    $sql = "SELECT * FROM disease";
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
  public function get_sheetrecord($patient_id){
    //query
    $sql = "SELECT * FROM sheetrecord WHERE patient_id=$patient_id";
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
  public function get_question($disease_id){
    //query
    $sql = "SELECT * FROM question WHERE disease_id=$disease_id";
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
  public function get_answer($sheetrecord_id, $question_id){
    // echo $sheetrecord_id;
    // echo '/';
    // echo $question_id;

    $sql = "SELECT * FROM checksheet WHERE sheetrecord_id=$sheetrecord_id AND question_id=$question_id";
    $result = $this->conn->query($sql);
    // echo $result;
    if($result->num_rows > 0){
      $answer = $result->fetch_assoc();
      return $answer;
    }else{
      return $this->conn->error;
    }
  }
  public function get_answer_freetext($sheetrecord_id){
    // echo $sheetrecord_id;
    // echo '/';
    // echo $question_id;

    $sql = "SELECT * FROM checksheet WHERE sheetrecord_id=$sheetrecord_id AND question_id=0";
    $result = $this->conn->query($sql);
    // echo $result;
    if($result->num_rows > 0){
      $answer = $result->fetch_assoc();
      return $answer;
    }else{
      return $this->conn->error;
    }
  }





}
?>
