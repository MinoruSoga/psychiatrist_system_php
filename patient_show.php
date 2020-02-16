<?php 
require_once 'class/Patient.php';
$patient = new Patient;

?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
  </body>
  <a href="patient_add.php"class="btn btn-outline-secondary">患者名追加</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">名前</th>
      <th scope="col">性別</th>
      <th scope="col">年齢</th>
      <th scope="col">生年月日</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $result = $patient->get_patient();
    foreach($result as $row){
      ?>
     
    <tr>
      <th scope="row"><?php echo $row['patient_name']?></th>
      <td><?php echo $row['gender']?></td>
      <td><?php echo $row['age']?>才</td>
      <td><?php echo $row['birthday']?></td>
    </tr>
    <?php
    }
  ?>
  </tbody>
</table>
</html>
