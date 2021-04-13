<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['productId']) || $_GET['productId'] == null) {
	echo '<script>window.location = "index.php"</script>';
} else {
	$productId = preg_replace('/[^0-9]/', '12111', $_GET['productId']);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$productName = $pr->getProductById($productId);
			if ($productName == false) {
				if (!isset($_GET['action'])){  //THIS IS FOR IF LOGOUT BUTTON IS PRESSED
				header("location: 404.php");
			} }else {
				$data = $productName->fetch_assoc();
				$result = $pr->getSingleProduct($productId);
				if ($result) {
					while ($data = $result->fetch_assoc()) { ?>
						<div class="cont-desc span_1_of_2">
							<div class="grid images_3_of_2">
								<img src="admin/uploads/<?php echo $data['image']; ?>" alt="" />
							</div>
							<div class="desc span_3_of_2">
								<h2><?php echo $data['productName']; ?> </h2>
								<div class="price">
									<p>Price: <span>$<?php echo $data['price']; ?></span></p>
									<p>Category: <span><?php echo $data['catName']; ?></span></p>
									<p>Brand:<span><?php echo $data['brandName']; ?></span></p>
								</div>
								<div class="add-cart">
									<form action="" method="post">
										<input type="number" class="buyfield" name="quantity" value="1" />
										<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
									</form><br />
									<?php
									if (isset($_POST['submit'])) {
										if (is_numeric($_POST['quantity']) == false) {
											echo "<span class='error'>Please Enter Valid Quantity</span>";
										} else {
											$check = $cart->check(session_id(), $productId);
											if ($check == true) {
												echo "<span class='error'>Product Already Added To Cart</span>";
											} else {
												$quantity = $_POST['quantity'];
												if ($quantity <= 0) {
													echo '<span class="error">Enter Valid Number</span>';
												} else
													$addCart = $cart->addToCart($quantity, $productId);
											}
											// $quantity = $_POST['quantity'];
											// if ($quantity <= 0) {
											// 	echo '<span class="error">Enter Valid Number</span>';
											// } else
											// 	$addCart = $cart->addToCart($quantity, $productId);
										}
									}
									?>
								</div>
								<div class="add-cart">
								<?php// if(Session::get('customerSignin') == true){?>

									<a class="buysubmit" href="?wishlist=<?php echo $productId; ?>&productId=<?php echo $productId; ?>">Save To List</a>

									<a class="buysubmit" href="?compare=<?php echo $productId; ?>&productId=<?php echo $productId; ?> ">Add To Compare</a>
									<?php// }?>
									<br/><br/>
								</div>
								<?php
								if (isset($_GET['wishlist'])) {
									$customerId = Session::get('customerId');
									$wishlist = $pr->insertToWishlist($customerId, $productId);
									if ($wishlist) {
										echo $wishlist;
									}
								}
								?>
								<?php
								if (isset($_GET['compare'])) {
									$customerId = Session::get('customerId');
									$compare = $pr->insertToCompare($customerId, $productId);
									if ($compare) {
										echo $compare;
									}
								}
								?>
							</div>
							<div class="product-desc">
								<h2>Product Details</h2>
								<?php echo $data['body']; ?>
							</div>
						</div>
			<?php	}
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
					$result = $cat->getAllCat();
					if ($result) {
						while ($data = $result->fetch_assoc()) { ?>
							<li><a href="productbycat.php?catId=<?php echo $data['catId']; ?>"><?php echo $data['catName']; ?></a></li>
					<?php	}
					} else {
						echo '<li><a href="productbycat.php">No Category Found</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>