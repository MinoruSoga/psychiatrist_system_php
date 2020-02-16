<?php
require_once 'Config.php';

class Disease extends Config{
  
  public function insert($disease_name){
    $sql = "INSERT INTO disease(disease_name) VALUES('$disease_name')";
    $result = $this->conn->query($sql);
    if($result){
      $this->redirect_js('disease_show.php');
    }else{
      echo "Error in inserting record".$this->conn->error;
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
  public function get_disease_name($disease_id){
    $sql = "SELECT * FROM disease WHERE id=$disease_id";
    $result = $this->conn->query($sql);
    if($result->num_rows > 0){
      $disease_name = $result->fetch_assoc();
      return $disease_name;
    }else{
      return $this->conn->error;
    }
  }




}
?>
