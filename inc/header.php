<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../lib/session.php';
include_once $filePath . '/../helpers/format.php';
include_once $filePath . '/../lib/database.php';

spl_autoload_register(function ($classes) {
    $filePath = realpath(dirname(__FILE__));
    include_once $filePath . '/../classes/' . $classes . '.php';
    // include_once 'classes/' . $classes . '.php'; This will use as it included in root folder(index.php)
});
Session::init();
$db = new Database;
$fm = new Format;
$br = new Brand;
$cart = new Cart;
$cat = new Category;
$pr = new Product;
$customer = new Customer;
?>

<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];
?>

<?php
if (isset($_GET['action'])) {
    $cart->deleteAllCart();
    $pr->deleteAllCompare();
    Session::destroy();
}
?>

<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script>
   
</head>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action='search.php' method="get">
                        <input name="search" type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product" id='cart'> </span>
                        </a>
                    </div>
                </div>
                <?php if (Session::get('customerSignin') != true) { ?>
                    <div class="login"><a href="login.php">Login</a></div>
                <?php } else { ?>
                    <div class="login"><a href="?action=logout">LogOut</a></div>
                <?php } ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <?php $path = $_SERVER['SCRIPT_FILENAME'];
            $base = basename($path, '.php');
            ?>
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php" <?php if ($base == 'index') echo "class='active'"; ?>>Home</a></li>
                <li><a href="topbrands.php" <?php if ($base == 'topbrands') echo "class='active'"; ?>>Top Brands</a></li>
                <li><a href="cart.php" <?php if ($base == 'cart') echo "class='active'"; ?>>Cart</a></li>
                <?php $product = $cart->getCartProduct();
                if ($product != false) { ?>
                    
                    <li><a href="payment.php" <?php if ($base == 'payment') echo "class='active'"; ?>>Payment</a></li>
                <?php } ?>
                <?php if (Session::get('customerSignin') == true) { ?>
                    <li><a href="profile.php" <?php if ($base == 'profile') echo "class='active'"; ?>>Profile</a></li>
                <?php } ?>
                <li><a href="contact.php" <?php if ($base == 'contact') echo "class='active'"; ?>>Contact</a> </li>
                <?php
                $customerId = Session::get("customerId");
                $order = $cart->getOrderedProduct($customerId);
               // if ($order) { ?>
                    <li><a href="orderdetails.php" <?php if ($base == 'orderdetails') echo "class='active'"; ?>>Order Details</a> </li>
                <?php //} ?>
                <?php
                $customerId = Session::get('customerId');
                $compare = $pr->getCompareProduct($customerId);
                if ($compare) { ?>
                    <li><a href="compare.php" <?php if ($base == 'compare') echo "class='active'"; ?>>Compare</a> </li>
                <?php } ?>
                <?php
                $wishlistId = Session::get('customerId');
                $compare = $pr->getWishlistProduct($wishlistId);
                if ($compare) { ?>
                    <li><a href="wishlist.php" <?php if ($base == 'wishlist') echo "class='active'"; ?>>Wishlist</a> </li>
                <?php } ?>
                <div class="clear"></div>
            </ul>
        </div>