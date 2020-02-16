<?php
require_once 'class/Disease.php';
$disease = new Disease;
?>
<!DOCTYPE html>
<html lang="ja">
  <?php include('head.php'); ?>
  <body>
    <?php include('header.php'); ?>
    <form action="" method="post">
    <div class="form-row">
      <div class="col-1">
        <label>病名</label>
      </div>
      <div class="col-5">
        <input type="text" class="form-control" name="disease_name" placeholder="病名を入力して下さい" required />
      </div>
      <div class="col">
        <input type="submit" name="submit" value="追加" class="btn btn-outline-success"/>
      </div>
    </div>
    </form>
  </body>
</html>
<?php
 if(isset($_POST['submit'])){
   $disease_name = $_POST['disease_name'];
   $disease->insert($disease_name);
 }
?>
