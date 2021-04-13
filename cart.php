<?php include 'inc/header.php'; ?>
<?php
$sessionId = session_id();
?>
<?php
if (isset($_POST['update'])) {
	$productId = $fm->validation($_POST['productId']);
	$productId = mysqli_real_escape_string($db->link, $productId);
	$quantity = $fm->validation($_POST['quantity']);
	$quantity = mysqli_real_escape_string($db->link, $quantity);
	if ($quantity <= 0) {
		$delete = $cart->deleteCart($productId);
	} else {
		$cart->updateQuantity($productId, $quantity);
		if ($cart == false) {
			echo "Please Enter Valid Amount";
		}
	}
}
?>

<?php if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteCart'])) {
	if (is_numeric(($_GET['deleteCart']) == FALSE)) {
		header("locaiton: 404.php");
	} else {
		$productId = preg_replace('/[^0-9]/', '', $_GET['deleteCart']);
		$delete = $cart->deleteCart($productId);
	}
}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$total = 0;
					$totalQuantity = 0;
					$grandTotal = 0;
					$product = $cart->getCartProduct();
					if ($product) {
						while ($data = $product->fetch_assoc()) {
							$productId = $data['productId'];
							$quantity = $data['quantity'];
							$price = $data['price'];
							$taka = $quantity * $price;
							$total += $taka;
							$totalQuantity += $quantity;
							$vat = $total * 0.1;
							$grandTotal = $total + $vat;
					?>
							<tr>
								<td><?php echo $data['productName']; ?></td>
								<td><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></td>
								<td>Tk. <?php echo $price; ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="quantity" value="<?php echo $quantity; ?>" />
										<input type="number" name="productId" value="<?php echo $data['productId']; ?>" hidden />
										<input type="submit" name="update" value="Update" />
									</form>
								</td>
								<td>$<?php echo $taka; ?></td>
								<td><a onclick="return confirm('Are You Sure To Delete');" href="?deleteCart=<?php echo $productId; ?>">X</a></td>
							</tr>
					<?php }
					}
					Session::set('totalQuantity', $totalQuantity);
					Session::set('totalAmount', $grandTotal); ?>

				</table>
				<table style="float:right;text-align:left;" width="40%">
					<?php
					$product = $cart->getCartProduct();
					if ($product == false) {
						header("location: index.php");
					} else {
					?>
						<tr>
							<th>Sub Total : </th>
							<td>$<?php echo $total; ?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td><?php echo $grandTotal; ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php?page=<?php echo $url;?>"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>

<?php include 'inc/footer.php'; ?>