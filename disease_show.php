<?php 
require_once 'class/Disease.php';
$disease = new Disease;

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
            <th scope="col"></th>
            <th scope="col">病名</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $result = $disease->get_disease();
            foreach($result as $row){
          ?>
          <tr>
            <th scope="row"></th>
            <td><?php echo $row['disease_name']?></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
      <a href="disease_add.php"class="btn btn-outline-secondary float-right">病名追加</a>
    </div>
  </body>
</html>
