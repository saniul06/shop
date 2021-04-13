<?php include 'inc/header.php'; ?>
<?php
if (isset($_GET['page'])) {
    $url = $_GET['page'];
}
?>
<?php if (Session::get('customerSignin') == false) {
    header("location: login.php?page=$url");
}
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    if (Session::get('totalQuantity') == false) {
        echo '<h2 class="error">Your Cart Is Empty</h2>';
    } else {
        $customerId = Session::get('customerId');
        $sessionId = session_id();
        $order = $cart->order($customerId, $sessionId);
        if ($order) {
            $order = 'Order Completed Successfully';
            $cart->deleteAllCart();
            Session::set('totalQuantity', 0);
            header("location: success.php?msg=$order");
        } else {
            $order = '<span class="error">Order Failed</span>';
            header("location: success.php?msg=$order");
        }
    }
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division_left">
                <table class="tblone table">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                    <?php
                    $total = 0;
                    $totalQuantity = 0;
                    $product = $cart->getCartProduct();
                    if ($product) {
                        while ($data = $product->fetch_assoc()) {
                            $productId = $data['productId'];
                            $quantity = $data['quantity'];
                            $price = $data['price'];
                            $taka = $quantity * $price;
                            $total += $taka;
                            $totalQuantity += $quantity;
                    ?>
                            <tr>
                                <td><?php echo $data['productName']; ?></td>
                                <td>Tk. <?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td>Tk. <?php echo $taka; ?></td>
                            </tr>
                    <?php }
                    } ?>

                </table>
                <table class="tbltwo">
                    <?php
                    $product = $cart->getCartProduct();
                    if ($product) {
                    ?>
                        <tr>
                            <th>Sub Total : </th>
                            <td>TK. <?php echo $total; ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td>Tk. <?php echo $total + $total * .1; ?></td>
                        </tr>
                        <tr>
                            <th>Total Quantity :</th>
                            <td><?php echo $totalQuantity; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="division_right">
                <?php
                if (isset($_GET['msg'])) {
                    echo $_GET['msg'];
                }
                ?>
                <form action="" method="post">
                    <?php
                    $customerId = Session::get('customerId');
                    $customer = $customer->getCustomerData($customerId);
                    if ($customer) {
                        while ($data = $customer->fetch_assoc()) { ?>


                            <table class='tblone'>
                                <tbody>
                                    <tr>
                                        <th width="20%" colspan=2>Your Profile Info</th>
                                    </tr>
                                    <tr>
                                        <td width='20%'>Name :</td>
                                        <td><?php echo $data['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>City :</td>
                                        <td><?php echo $data['city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Zip Code :</td>
                                        <td><?php echo $data['zipcode']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td><?php echo $data['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address :</td>
                                        <td><?php echo $data['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country :</td>
                                        <td><?php echo $data['country']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone :</td>
                                        <td><?php echo $data['phone']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="search">
                                <div><button><a class="grey" href='updateprofile.php'>Edit Profile</a></button></div>
                            </div>
                    <?php    }
                    } else echo $customer ?>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
    <div class='order'>
        <a href='?orderid=order' class='grey'>ORDER</a>
    </div>
</div>
<?php include 'inc/footer.php'; ?>