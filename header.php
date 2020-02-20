<?php
require_once 'class/User.php';
$user = new User;
$row = $user->get_user($login_id);
$user_name = $row['user_name'];
?>
<header>
  <nav class="navbar navbar-light bg-light">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link active" href="top.php">Home</a>
    </li>
    <?php if($login_id == 1){
    ?>
    <li class="nav-item">
      <a class="nav-link" href="patient_show.php">患者名登録</a>
    </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link" href="disease_show.php">病名</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="check_sheet_create1.php">カルテ作成</a>
    </li>
  </ul>
  <a>ログインユーザー名<?php echo $user_name?>さん</a>
  <a class="nav-link" href="logout.php" tabindex="-1" aria-disabled="true">ログアウト</a>
  </nav>
</header>
