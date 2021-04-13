<?php include 'inc/header.php'; ?>
<style>
	table.tblone tr td {
		text-align: center;
	}
</style>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<?php if (isset($_GET['deleteCompare'])) {
					$compareId = preg_replace('/[^0-9]/', '', $_GET['deleteCompare']);
					$delete = $pr->deleteCompareProduct($compareId);
					if ($delete) {
						echo $delete;
					}
				}
				?>
				<h2>Compare</h2>
				<table class="tblone">
					<tr>
						<th width="20%">No</th>
						<th width="20%">Product Name</th>
						<th width="10%">Price</th>
						<th width="15%">Image</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$customerId = Session::get('customerId');
					$compare = $pr->getCompareProduct($customerId);
					if ($compare) {
						$i = 1;
						while ($data = $compare->fetch_assoc()) {	?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $data['productName']; ?></td>
								<td>$ <?php echo $data['price']; ?></td>
								<td><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" style="width:100px;height:100px" /></td>
								<td><a href="details.php?productId=<?php echo $data['productId']; ?>">View</a> || <a onclick="return confirm('Are You Sure To Delete');" href="?deleteCompare=<?php echo $data['compareId']; ?>">Remove</a></td>
							</tr>
					<?php }
					} ?>
				</table>
			</div>
		</div>
		<div class="shopping">
				<div class="shopleft" style="width:100%">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
		<div class="clear"></div>
	</div>
</div>
</div>

<?php include 'inc/footer.php'; ?>