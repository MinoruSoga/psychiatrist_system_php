<?php
require_once 'class/Patient.php';
$patient = new Patient;
?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
    <form action="" method="post">
    <div class="form-row">
    <div class="col-4">
      <input type="text" name="patient_name" class="form-control" placeholder="名前">
    </div>
    <div class="col-2">
          <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="男">
        <label class="form-check-label" for="inlineRadio1">男</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="女">
        <label class="form-check-label" for="inlineRadio2">女</label>
      </div>
    </div>
    <div class="col-2">
      <input type="number" name="age" class="form-control" placeholder="年齢">
    </div>
    <div class="col-4">
      <input type="date" name="birthday" class="form-control" placeholder="生年月日">
    </div>
  </div>
    <input type="submit" name="submit" value="追加" class="btn btn-outline-success"/>
    </form>
  </body>
</html>
<?php
 if(isset($_POST['submit'])){
   $patient_name = $_POST['patient_name'];
   $gender = $_POST['gender'];
   $age = $_POST['age'];
   $birthday = $_POST['birthday'];
   $patient->insert($patient_name, $gender, $age, $birthday);
 }
?>
