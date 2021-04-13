<?php //FOR SHOWING CART UPDATE
if (Session::get('totalQuantity') == false) {
    $cart = '(empty)';
} else {
    $quantity = Session::get('totalQuantity');
    $amount = Session::get('totalAmount');
    $cart = '$' . $amount . ' | Qty: ' . $quantity;
}
?>
<script>
    document.getElementById("cart").innerHTML = "<?php echo  $cart; ?>";
</script>

<div class="footer">
    <div class="wrapper">
        <div class="section group">
            <div class="col_1_of_4 span_1_of_4">
                <h4>Information</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#"><span>Advanced Search</span></a></li>
                    <li><a href="#">Orders and Returns</a></li>
                    <li><a href="#"><span>Contact Us</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Why buy from us</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#"><span>Site Map</span></a></li>
                    <li><a href="#"><span>Search Terms</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>My account</h4>
                <ul>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="cart.php">View Cart</a></li>
                    <li><a href="wishlist.php">My Wishlist</a></li>
                    <li><a href="order.php">Track My Order</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Contact</h4>
                <ul>
                    <li><span>+xx-xxxxxxxx</span></li>
                    <li><span>+xx-xxxxxxxxx</span></li>
                </ul>
                <div class="social-icons">
                    <h4>Follow Us</h4>
                    <ul>
                        <li class="facebook">
                            <a href="#" target="_blank"> </a>
                        </li>
                        <li class="twitter">
                            <a href="#" target="_blank"> </a>
                        </li>
                        <li class="googleplus">
                            <a href="#" target="_blank"> </a>
                        </li>
                        <li class="contact">
                            <a href="#" target="_blank"> </a>
                        </li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copy_right">
            <p>Training with live project &amp; All rights Reseverd </p>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        /*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(function() {
        SyntaxHighlighter.all();
    });
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
</body>

</html>