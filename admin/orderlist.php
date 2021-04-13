<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../classes/Cart.php';
include_once $filePath . '/../helpers/format.php';
$cart = new Cart;
$fm = new Format;
?>

<div class="grid_10">
    <div class="box round first grid">
        <?php if (isset($_GET['orderId']) && isset($_GET['price']) && isset($_GET['date'])) {
            $orderId = $fm->validation($_GET['orderId']);
            $price = $_GET['price'];
            //      $date = $fm->validation($_GET['date']);
            $date = $_GET['date'];
            $delete = $cart->updateStatus($orderId, $price, $date);
            if ($delete) {
                echo '<span class="success">Status Updated Successfully</span>';
            } else {
                echo '<span class="error">Status Update Failed</span>';
            }
        }
        ?>
        <?php if (isset($_GET['deleteId']) && isset($_GET['price']) && isset($_GET['date'])) {
            $deleteId = $fm->validation($_GET['deleteId']);
            $price = $_GET['price'];
            //      $date = $fm->validation($_GET['date']);
            $date = $_GET['date'];
            $statusUpdate = $cart->deleteShiftedProduct($deleteId);
            if ($statusUpdate) {
                echo '<span class="success">Deleted Successfully</span>';
            } else {
                echo '<span class="error">Deletion Failed</span>';
            }
        }
        ?>
        <h2>Order List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Order Id</th>
                        <th>Order Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Customer Id</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $totalQuantity = 0;
                    $order = $cart->getAllOrder();
                    if ($order) {
                        $i = 1;
                        while ($data = $order->fetch_assoc()) {
                            $quantity = $data['quantity'];
                            $price = $data['price'];
                            $taka = $quantity * $price;
                            $total += $taka;
                            $totalQuantity += $quantity;
                            $grandTotal = ($total + $total * 0.1);
                    ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['orderId'] ?></td>
                                <td><?php echo $fm->formatDate($data['date']) ?></td>
                                <td><?php echo $data['productName'] ?></td>
                                <td class="center"><?php echo $data['quantity'] ?></td>
                                <td><?php echo $taka ?></td>
                                <td class='center'><?php echo $data['customerId'] ?></td>
                                <td><a href="customeraddress.php?customerId=<?php echo $data['customerId'] ?>">View Details</a></td>
                                <?php
                                if ($data['status'] == 0) { ?>
                                    <td><a href="?orderId=<?php echo $data['orderId']; ?>&price=<?php echo $data['price']; ?>&date=<?php echo $data['date']; ?>">Shift Now</a></td>
                                <?php  } else if ($data['status'] == 1) { ?>
                                    <td>Pending</td>
                                <?php } else { ?>
                                    <td><a href="?deleteId=<?php echo $data['orderId']; ?>&price=<?php echo $data['price']; ?>&date=<?php echo $data['date']; ?>">Remove</a></td>
                                <?php } ?>

                            </tr>
                    <?php }
                    } ?>
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