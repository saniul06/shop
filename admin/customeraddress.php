<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Customer.php'; ?>
<?php if (isset($_GET['customerId'])) {
    $customerId = preg_replace('/[^0-9]/', '', $_GET['customerId']);
} else {
    echo '<script>window.location = "orderlist.php"</script>';
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Details</h2>
        <div class="block copyblock">
            <?php
            $customer = new Customer;
            $customer = $customer->getCustomerData($customerId);
            if ($customer) {
                while ($data = $customer->fetch_assoc()) { ?>


                    <table class='tblone'>
                        <tbody>
                            <tr>
                                <td width='15%'>Name :</td>
                                <td><?php echo $data['name']; ?></td>
                            </tr>
                            <tr>
                                <td width='15%'>Id :</td>
                                <td><?php echo $data['customerId']; ?></td>
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
                            <tr>
                            
                             <td><a href='orderlist.php'><button>OK</button></a></td>
                       
                            </tr>
                        </tbody>
                    </table>
            <?php    }
            } else echo $customer ?>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>