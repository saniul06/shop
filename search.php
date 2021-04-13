<?php include 'inc/header.php'; ?>
<style>
.images_1_of_4 {
	margin: 6px;
}
.grid_1_of_4, .grid_1_of_4:first-child {
	display: block;
	float: left;
	margin: 1% 6px 1% 0.6%;
	box-shadow: 0px 0px 3px rgb(150, 150, 150);
}
}
</style>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Search Result</h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            $real = mysqli_real_escape_string($db->link, $_GET['search']);
            if (!isset($real) || $real == null) {
                header('location: 404.php');
            } else {
                $search = $real;
            }
            $sql = "SELECT * from tbl_product where productName LIKE '%$search%' OR body LIKE '%$search%' ";
            $post = $db->select($sql);
            if ($post) {
                while ($data = $post->fetch_assoc()) { ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
                        <h2><?php echo $data['productName']; ?> </h2>
                        <p><?php echo $fm->textShorten($data['body'], 80); ?></p>
                        <p><span class="price">$<?php echo $data['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
                    </div>
            <?php       }
            } else {
                echo "<h2>No product found</h2>";
            }
            ?>
        </div>

    </div>
</div>

<?php include_once 'inc/footer.php'; ?>