<?php 
require_once 'class/Patient.php';
$patient = new Patient;
session_start();
$login_id = $_SESSION['login_id'];
?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
    <div class="container-md mt-3">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">名前</th>
            <th scope="col">年齢</th>
            <th scope="col">生年月日</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $result = $patient->get_patient($login_id);
          foreach($result as $row){
            $birthday = $row['birthday'];
              $now = date("Ymd");
              $birthday = str_replace("-", "", $birthday);
              $age = floor(($now-$birthday)/10000);
        ?>
        <tr>
          <th scope="row"><a href="patient_detail.php?patient_id=<?php echo $row['id']?>"><?php echo $row['patient_name']?></a></th>
          <td><?php echo $age?></td>
          <td><?php echo $row['birthday']?></td>
        </tr>
        <?php
          }
        ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
