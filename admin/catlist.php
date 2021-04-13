<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php';
$cat = new Category;
 ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['deleteId'])) {
	$db = new Database;
	$fm = new Format;
	$catId = $fm->validation($_GET['deleteId']);
//	$catId = mysqli_real_escape_string($db->link, $_GET['deleteId']);
	$catId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['deleteId']);
	$deleteCat = $cat->deleteCat($catId);
	if ($deleteCat) {
		$msg = "<span class='success'>Category Deleted Successfully</span>";
	} else {
		$msg = "<span class='error'>Category Deletion Failed</span>";
	}
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<?php if (isset($msg)) {
			echo $msg;
		} ?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$showCat = $cat->getAllCat();
					if ($showCat) {
						$i = 1;
						while ($data = $showCat->fetch_assoc()) { ?>
							<tr class="odd gradeX">
								<td><?php echo $i++; ?></td>
								<td><?php echo $data['catName']; ?></td>
								<td><a href="catedit.php?catId=<?php echo $data['catId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure want to delete');" href="?deleteId=<?php echo $data['catId']; ?>">Delete</a></td>
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