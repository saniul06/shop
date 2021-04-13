<?php include 'inc/header.php'; ?>
<?php if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
	header("location: index.php");
} else {
	$catId = preg_replace('/[^0-9]/', '1111111', $_GET['catId']);
	$checkCat = $cat->showCatName($catId);
	if ($checkCat == false) {
		header("location: 404.php");
	} else {
		$data = $checkCat->fetch_assoc();
	}
}
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Latest from <?php echo $data['catName']; ?></h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$cat = $pr->getProductByCatId($catId);
			if ($cat) {
				while ($data = $cat->fetch_assoc()) { ?>


					<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
						<h2><?php echo $data['productName']; ?></h2>
						<p><?php echo $fm->textShorten($data['body'], 30); ?></p>
						<p><span class="price">$<?php echo $data['price']; ?></span></p>
						<div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
					</div>
			<?php	}
			} else {
				echo "<h2>Products Of This Category Are Not Availabe Now.</h2>";
			}
			?>
		</div>



	</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>