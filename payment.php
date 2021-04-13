<?php include 'inc/header.php'; ?>
<?php
// if(isset($_GET['page'])){
// 	$url = $_GET['page'];
// }
?>
<?php if(Session::get('customerSignin') == false){
	header("location: login.php?page=$url");
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="payment">
				<h2>Choose Payment Option</h2>
				<a href="paymentoffline.php">Offline</a>
				<a href="">Online</a>
			</div>
			<div class="back">
				<a href="cart.php">Back To Cart Page</a>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
