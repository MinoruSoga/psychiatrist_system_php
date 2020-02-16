<?php 
require_once 'class/Patient.php';
require_once 'class/Disease.php';
require_once 'class/CheckSheet.php';
include "./TCPDF/tcpdf.php"; 
$patient = new Patient;
$disease = new Disease;
$check_sheet = new CheckSheet;
$patient_id = $_GET['patient_id'];
$disease_id = $_GET['disease_id'];
$sheetrecord_id = $_GET['sheetrecord_id'];
$patient_row = $patient->get_patient_name($patient_id);
$disease_name = $disease->get_disease_name($disease_id);
?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
    <div class="container-md mt-3">
      <h3><?php echo $patient_row['patient_name'];?>  さん</h3>
      <h3><?php echo $disease_name['disease_name'];?></h3>
      <?php 
      $answer = $check_sheet->get_answer_freetext($sheetrecord_id);
      ?>
      <p class="border"><?php echo $answer['answer']?></p>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">質問</th>
            <th scope="col">答え</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $result = $check_sheet->get_question($disease_id);
          foreach($result as $row){
            $question_id = $row['id'];
            $answer = $check_sheet->get_answer($sheetrecord_id, $question_id);
        ?>
        <tr>
          <?php 
            if($row['question_id'] == 0){
          ?>
          <th scope="row"><?php echo $row['question']?></th>
          <?php
            }else{
          ?>
          <th scope="row" class="pl-5"><?php echo $row['question']?></th>
          <?php
            }
          ?>
          <td><?php echo $answer['answer']?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
