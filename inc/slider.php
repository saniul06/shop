<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            // $get = array();
            // $get = $pr->newBrand();
            // for ($i = 0; $i < 4; $i++) {
            //     $query = "SELECT p.*, b.brandName from tbl_product as p, tbl_brand As b WHERE p.bId = '$get[$i]' AND b.brandId = '$get[$i]' LIMIT 1";
            //     $result = $db->select($query);
            $query = "SELECT tbl_product.*, tbl_brand.brandName 
                    FROM tbl_product 
                    INNER JOIN tbl_brand 
                    ON tbl_brand.brandId = tbl_product.bId 
                    ORDER BY tbl_product.productId Desc limit 4";
            $result = $db->select($query);
            while ($data = $result->fetch_assoc()) { ?>


                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                        <a href="details.php?productId=<?php echo $data['productId']; ?>"> <img src="admin/uploads/<?php echo $data['image']; ?>" alt="" width=133 height=90 /></a>
                    </div>
                    <div class="text list_2_of_1">
                        <h2><?php echo $data['brandName']; ?></h2>
                        <p><?php echo $fm->textShorten($data['productName'], 30); ?></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>">Add to cart</a></span></div>
                    </div>
                </div>
            <?php    }
            // }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt="" /></li>
                    <li><img src="images/2.jpg" alt="" /></li>
                    <li><img src="images/3.jpg" alt="" /></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>