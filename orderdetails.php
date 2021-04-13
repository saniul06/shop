<?php include 'inc/header.php'; ?>


<?php
//if (!(isset($_GET['action']))) {
if (Session::get('customerSignin') == false) {
    header("location: login.php?page=$url");
}
//}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="orderdetails">
                <?php
                if (isset($_GET['cofirmOrder'])) {
                    $orderId = preg_replace('/[^0-9]/', '', $_GET['cofirmOrder']);
                    $confirm = $cart->cofirmOrder($orderId);
                    if ($confirm) {
                        echo "<span class='success'>Confirem</span>";
                    } else {
                        echo "<span class='error'>Confirmation Failed</span>";
                    }
                }
                ?>
                <?php
                if (isset($_GET['confirm'])) {
                    $orderId = preg_replace('/[^0-9]/', '', $_GET['confirm']);
                    $confirm = $cart->deleteShiftedProduct($orderId);
                    if ($confirm) {
                        echo "<span class='success'>Confirem</span>";
                    } else {
                        echo "<span class='error'>Confirmation Failed</span>";
                    }
                }
                ?>
                <table class="tblone">
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $customerId = Session::get('customerId');
                    $total = 0;
                    $totalQuantity = 0;
                    $grandTotal = 0;
                    $product = $cart->getOrderedProduct($customerId);
                    if ($product) {
                        while ($data = $product->fetch_assoc()) {
                            $productId = $data['productId'];
                            $quantity = $data['quantity'];
                            $price = $data['price'];
                            $taka = $quantity * $price;
                            $total += $taka;
                            $totalQuantity += $quantity;
                            $grandTotal = ($total + $total * 0.1);
                    ?>
                            <tr>
                                <td><?php echo $data['productName']; ?></td>
                                <td><img src="admin/uploads/<?php echo $data['image']; ?>" alt="" /></td>
                                <td>Tk. <?php echo $price; ?></td>
                                <td> <?php echo $quantity; ?> </td>
                                <td>$<?php echo $taka; ?></td>
                                <td>$<?php echo $fm->formatDate($data['date']); ?></td>
                                <td><?php
                                    if ($data['status'] == 0) {
                                        echo "pending";
                                    } elseif ($data['status'] == 1) {
                                        echo "<span class='success'>Shifted</span>";
                                    } else {
                                        echo "<span class='success'>Received</span>";
                                    } ?>


                                </td>
                                <td>
                                    <?php if ($data['status'] == 1) { ?>
                                        <a onclick="return confirm('Do You Receive The Product');" href="?cofirmOrder=<?php echo $data['orderId']; ?>">Confirm</a> <?php } elseif ($data['status'] == 2) {
                                                                                                                                                                    echo "<a href='?confirm=" . $data['orderId'] . "'><span class='error'>Remove</span></a>";
                                                                                                                                                                } else {
                                                                                                                                                                    echo 'N/A';
                                                                                                                                                                } ?>

                                </td>
                            </tr>
                    <?php }
                    } ?>

                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>