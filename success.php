<?php include 'inc/header.php'; ?>


<?php
if (isset($_GET['msg'])) {
	$msg = $fm->validation($_GET['msg']);
	$amount = Session::get('totalAmount');
}
if (!isset($_GET['msg'])) {
	echo "<a class='s' href='index.php'>Please Shop First</a>";
} else {
?>
	<?php
	if (!(isset($_GET['action']))) {
		if (Session::get('customerSignin') == false) {
			header("location: login.php?page=$url");
		}
	}
	?>

	<div class="main">
		<div class="content">
			<div class="section group">
				<div class="psuccess">
					<h2><?php echo '<span class="success">' . $msg . '</span>'; ?></h2>
					<?php
					//if (isset($_GET['msg']) && isset($_GET['amount'])) { 
					?>
					<p>Total payable amount(including vat) is : $<?php echo $amount; ?> Thanks for purchase.We receive your order successfully.We will contact you as soon as possible with delivery details.Here is your order details... <a href="orderdetails.php">Visit Here</a></p>
					<?php //} 
					?>

				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php include 'inc/footer.php'; ?>