<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php';
$brand = new Brand;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteId'])) {
	$db = new Database;
	$fm = new Format;
	$brandId = $fm->validation($_GET['deleteId']);
//	$brandId = mysqli_real_escape_string($db->link, $_GET['deleteId']);
	$brandId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['deleteId']);
	$deletebrand = $brand->deletebrand($brandId);
	if ($deletebrand) {
		$msg = "<span class='success'>Brand Deleted Successfully</span>";
	} else {
		$msg = "<span class='error'>Brand Deletion Failed</span>";
	}
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Brand List</h2>
		<?php if (isset($msg)) {
			echo $msg;
		} ?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$showBrand = $brand->getAllBrand();
					if ($showBrand) {
						$i = 1;
						while ($data = $showBrand->fetch_assoc()) { ?>
							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><?php echo $data['brandName']; ?></td>
								<td><a href="brandedit.php?brandId=<?php echo $data['brandId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure want to delete');" href="?deleteId=<?php echo $data['brandId']; ?>">Delete</a></td>
							</tr>
					<?php	}
					} else {
						echo "<tr><td></td><td><span style='font-size:30px'>No Data Found</span></td><td></td></tr>";
					}
					?>
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