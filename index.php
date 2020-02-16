<?php 
require_once 'class/Patient.php';
$patient = new Patient;

?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
  

  <table class="table">
  <thead>
    <tr>
      <th scope="col">名前</th>
      <th scope="col">生年月日</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $result = $patient->get_patient();
    foreach($result as $row){
      ?>
     
    <tr>
      <th scope="row"><a href="patient_detail.php?patient_id=<?php echo $row['id']?>"><?php echo $row['patient_name']?></a></th>
      <td><?php echo $row['birthday']?></td>
    </tr>
    <?php
    }
  ?>
  </tbody>
</table>
</body>
</html>
