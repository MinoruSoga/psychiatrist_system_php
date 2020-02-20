<?php
require_once 'class/CheckSheet.php';
require_once 'class/Disease.php';
require_once 'class/Patient.php';
$check_sheet = new CheckSheet;
$disease = new Disease;
$patient = new Patient;
?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
    <div class="container-md mt-3">
      <form action="" method="post" class="form-inline">
        <div class="form-group">
          <label for="selectPatient">患者名</label>
          <select name="patient_id" class="form-control" id="selectPatient">
            <option>Please select</option>
            <?php 
              $result = $patient->get_patient();
              foreach($result as $row){
            ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['patient_name']?></option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="selectDisease">病名</label>
          <select name="disease_id" class="form-control" id="selectDisease">
            <option>Please select</option>
            <?php 
              $result = $disease->get_disease();
              foreach($result as $row){
            ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['disease_name']?></option>
            <?php
              }
            ?>
          </select>
        </div>
        <input type="submit" name="next"class="btn btn-outline-primary" value="次へ" />
      </form>

<?php
 if(isset($_POST['next'])){
   $patient_id = $_POST['patient_id'];
   $disease_id = $_POST['disease_id'];
   $result = $check_sheet->next_question($patient_id,$disease_id);
 
 ?>
  <form action="" method="post">
    <input type="hidden" name="patient_id" value="<?php echo $patient_id?>">
    <input type="hidden" name="disease_id" value="<?php echo $disease_id?>">
    <textarea class="form-control" name="answer[0]" placeholder="備考"></textarea>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">質問</th>
            <th scope="col">答え</th>
          </tr>
        </thead>
        <tbody>
        <?php
          if($result){
          foreach($result as $row){
        ?>
        <tr>
          <?php 
            if ($row['question_id'] == 0){
          ?>
          <th scope="row"><?php echo $row['question'];?></th>
          <?php
            }else{
          ?>
          <th scope="row" class="pl-5"><?php echo $row['question'];?></th>
          <?php
            }
            if($row['answer'] == 'check'){
          ?>
          <td>
            <input type="radio" name="answer[<?php echo $row['id'];?>]" value="Yes"> はい
            <input type="radio" name="answer[<?php echo $row['id'];?>]" value="No"> いいえ
            <input type="hidden" name="q_num[<?php echo $row['id'];?>]" value="<?php echo $row['id'];?>">
          </td>
        </tr>
        <?php } elseif($row['answer'] == 'none'){?>
          <td>
          <input type="hidden" name="answer[<?php echo $row['id'];?>]">
        </td>
        <?php } else{?>
        <td>
          <input type="text" name="answer[<?php echo $row['id'];?>]" placeholder="freetext">
        </td>
        <?php 
              }
            }
          }
        ?>
      </tbody>
    </table>
    <input type="submit" name="submit" value="保存" class="btn btn-outline-success"/>
  </form>
  <?php 
    }
  ?>
<?php
 if(isset($_POST['submit'])){
   $patient_id = $_POST['patient_id'];
   $disease_id = $_POST['disease_id'];
   $answer = $_POST['answer'];
   $q_num = $_POST['q_num'];
   $check_sheet->insert($patient_id, $disease_id, $answer, $q_num);
 }
?>
    </div>
  </body>
</html>
