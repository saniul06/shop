<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/Product.php';
$pr = new Product;
$fm = new Format;
$db = new Database;
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<?php if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteId'])) {
			$deleteId = $fm->validation($_GET['deleteId']);
			$deleteId = mysqli_real_escape_string($db->link, $deleteId);
			$delete = $pr->deleteProductById($deleteId);
			if ($delete) {
				echo $delete;
			}
		}
		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width='4%'>No</th>
						<th width='11%'>Product Name</th>
						<th width='11%'>Category</th>
						<th width='11%'>Brand</th>
						<th width='19%'>Description</th>
						<th width='11%'>Price</th>
						<th width='15%'>Image</th>
						<th width='7%'>Type</th>
						<th width='11%'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$shwoProduct = $pr->getAllProduct();
					if ($shwoProduct) {
						$i = 1;
						while ($data = $shwoProduct->fetch_assoc()) {
					?>
							<tr class="odd gradeX">
								<td><?php echo $i++ ?></td>
								<td><?php echo $data['productName']; ?></td>
								<td><?php echo $data['catName']; ?></td>
								<td><?php echo $data['brandName']; ?></td>
								<td> <?php echo $fm->textShorten($data['body'], 50); ?></td>
								<td>$ <?php echo $data['price']; ?></td>
								<td> <img src='uploads/<?php echo $data['image']; ?>' width=50 height=30></td>
								<td> <?php if ($data['type'] == 0) {
											echo 'Featured';
										} else {
											echo "General";
										}
										?></td>
								<td><a href="productedit.php?productId=<?php echo $data['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?deleteId=<?php echo $data['productId']; ?>">Delete</a></td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>