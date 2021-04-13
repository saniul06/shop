<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            $result = $pr->getFeaturedProduct();
            if ($result) {
                while ($data = $result->fetch_assoc()) { ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
                        <h2><?php echo $data['productName']; ?> </h2>
                        <p><?php echo $fm->textShorten($data['body'], 80); ?></p>
                        <p><span class="price">$<?php echo $data['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
                    </div>
            <?php       }
            } else {
                echo "<h2>There is no Featured Product</h2>";
            }
            ?>
        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $result = $pr->getNewProduct();
            if ($result) {
                while ($data = $result->fetch_assoc()) { ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
                        <h2><?php echo $data['productName']; ?> </h2>
                        <p><span class="price">$<?php echo $data['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
                    </div>
            <?php       }
            } else {
                echo "<h2>There is no Featured Product</h2>";
            }
            ?>
        </div>
    </div>
</div>
</div>

<?php include_once 'inc/footer.php'; ?>