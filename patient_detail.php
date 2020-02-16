<?php 
require_once 'class/Patient.php';
require_once 'class/Disease.php';
require_once 'class/CheckSheet.php';
$patient = new Patient;
$disease = new Disease;
$check_sheet = new CheckSheet;
$patient_id = $_GET['patient_id'];
$patient_row = $patient->get_patient_name($patient_id);
?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
    <div class="container-md mt-3">
    <h3><?php echo $patient_row['patient_name'];?> さん</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">病名</th>
          <th scope="col">日付</th>
        </tr>
      </thead>
        <tbody>
        <?php 
          $result = $check_sheet->get_sheetrecord($patient_id);
          foreach($result as $row){
            $disease_id = $row['disease_id'];
            $disease_name = $disease->get_disease_name($disease_id);
        ?>
        <tr>
          <th scope="row"><a href="patient_sheetrecord.php?patient_id=<?php echo $patient_id?>&disease_id=<?php echo $disease_id?>&sheetrecord_id=<?php echo $row['id']?>"><?php echo $disease_name['disease_name']?></a></th>
          <td><?php echo $row['created_at']?></td>
        </tr>
        <?php
          }
        ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
