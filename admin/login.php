<?php
include_once '../lib/session.php';
include '../classes/Adminlogin.php';
$fm = new Format;
$url = "";

if(isset($_GET['page'])){
	$url = $fm->validation($_GET['page']);
} 

Session::checkLogin($url);

$al = new AdminLogin;
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<form action="" method="post">
				<h1>Admin Login</h1>
				<?php
				if (isset($_POST['submit'])) {
					$adminName = $_POST['adminName'];
					$adminPassword = $_POST['adminPassword'];
					
					$loginCheck = $al->adminLogin($adminName, $adminPassword, $url);
					if ($loginCheck) {
						echo $loginCheck;
					}
				}
			
				?>
				<div>
					<input type="text" placeholder="Enter Name" name="adminName" />
				</div>
				<div>
					<input type="password" placeholder="Enter Password" name="adminPassword" />
				</div>
				<div>
					<input type="submit" name="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">My E-Commerce Site</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>