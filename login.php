<?php include 'inc/header.php'; ?>
<?php
$url = "";
if (isset($_GET['page'])) {
	$url = $fm->validation($_GET['page']);
	//$url = $_GET['page'];
}
?>
<?php if (Session::get('customerSignin') == true) {
	if (empty($url)) {
		header("location: index.php");
	} else {
		header("location: $url");
	}
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['signin'])) {
	$signin = $customer->customerSignin($_POST, $url);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {
	$addCustomer = $customer->customerRegistration($_POST);
}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<?php if (isset($signin)) {
				echo $signin;
			} ?>
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<form action="#" method="POST">
				<input name="email" type="text">
				<input name="password" type="password">
				<div class="buttons">
					<div><button class="grey" name="signin">Sign In</button></div>
				</div>
			</form>

		</div>
		<div class="register_account">
			<?php
			if (isset($addCustomer)) {
				echo $addCustomer;
			}
			?>
			<h3>Register New Account</h3>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">
								</div>

								<div>
									<input type="text" name="city" placeholder="City">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Zip Code">
								</div>
								<div>
									<input type="text" name="email" placeholder="E-Mail">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
								<div>
									<input type="text" name="country" placeholder="Country">
								</div>

								<div>
									<input type="text" name="phone" placeholder="Phone">
								</div>

								<div>
									<input type="password" name="password" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button class="grey" name="register">Create Account</button></div>
				</div>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>