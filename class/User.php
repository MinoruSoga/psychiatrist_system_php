<?php
  require_once "Config.php";

  class User extends Config{

    // public function insert($name, $email, $phone, $pass, $conpass){   

    //   $sql1 = "SELECT * FROM users WHERE user_name = '$name' ";

    //   if($this->conn->query($sql1)->num_rows > 0){
    //     echo "<h3 class = 'container text-center mt-3 text-danger'>'Username is already taken'</h3>";

    //   }
    //   elseif($pass != $conpass){
    //     echo "<h3 class = 'text-white'>alart</h3>";
    //   }
    //   $sql = "INSERT INTO login(email, password,status) VALUES('$email', '$pass','admin')";
    //   $result = $this->conn->query($sql);
    //   $login_id = $this->conn->insert_id;
    //   if($result){
    //     $sql1 = "INSERT INTO users(user_name, user_phone, login_id) VALUES('$name', '$phone', $login_id)";
    //     session_start();
    //     $result = $this->conn->query($sql1);
    //     if($result){
    //       $_SESSION['login_id'] = $login_id;
    //       header("Location: home.php");
        
    //     }else{
    //       echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
    //     }
    //   }
    // }
    
    

    public function login($name, $password){
      $sql = "SELECT * FROM user WHERE user_name='$name' AND password='$password'";
      $result=$this->conn->query($sql);
      if($result->num_rows > 0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['login_id'] = $row['id'];
        // $this->redirect_js("../index.php");
        header("Location: top.php");
        // if($row['permission'] == 'admin'){
        //   $this->redirect_js("admin/index.php");
        //   // echo $_SESSION['user_id'];
        // }
        // elseif($row['permission'] == 'user'){
        //   $this->redirect_js('user/index.php');
        //   // echo $_SESSION['user_id'];
        // }
      }
      else{
        echo "Invalid Username or Password";
      }
    } 
    public function logout(){
      session_start();
      session_destroy();
      $this->redirect_js('index.php');
    }

    public function get_user($login_id){
      $sql = "SELECT * FROM user WHERE id=$login_id";
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
