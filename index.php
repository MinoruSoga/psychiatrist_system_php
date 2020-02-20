<?php
require_once 'class/User.php';
?>
<!DOCTYPE html>
<html>


<head>
	<title>Login</title>
	<?php include('head.php'); ?>
</head>
	<!--font_awesome_icons-->
  <body class="text-center">
    <form class="form-signin w-50 m-auto pt-5" action="" method="post">

			<h1 class="h3 mb-3 font-weight-normal">Please login</h1>
			<label for="inputName" class="sr-only">名前</label>
			<input type="text" id="inputName" class="form-control" placeholder="名前" name="name" required autofocus>

			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log in</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
		</form>
	</body>

</html>

<?php
  if(isset($_POST['login'])){
    $name = $_POST['name'];
		$password = $_POST['password'];
		$user = new User;
    $user->login($name, $password);
  }

?>
