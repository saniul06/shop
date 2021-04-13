<?php include 'inc/header.php'; ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php 
				$product = $pr->acer();
				if($product){
					while($data = $product->fetch_assoc()){?>

				
				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
                        <h2><?php echo $data['productName']; ?> </h2>
                        <p><?php echo $fm->textShorten($data['body'], 80); ?></p>
                        <p><span class="price">$<?php echo $data['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php	}
				}
			  ?>
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Samsung</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			  <?php 
				$product = $pr->samsung();
				if($product){
					while($data = $product->fetch_assoc()){?>

				
				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
                        <h2><?php echo $data['productName']; ?> </h2>
                        <p><?php echo $fm->textShorten($data['body'], 80); ?></p>
                        <p><span class="price">$<?php echo $data['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php	}
				}
			  ?>
			</div>
	<div class="content_bottom">
    		<div class="heading">
    		<h3>Canon</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			  <?php 
				$product = $pr->canon();
				if($product){
					while($data = $product->fetch_assoc()){?>

				
				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?productId=<?php echo $data['productId']; ?>"><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></a>
                        <h2><?php echo $data['productName']; ?> </h2>
                        <p><?php echo $fm->textShorten($data['body'], 80); ?></p>
                        <p><span class="price">$<?php echo $data['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $data['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php	}
				}
			  ?>
			</div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>