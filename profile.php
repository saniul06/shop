<?php include 'inc/header.php'; ?>
<?php if (Session::get('customerSignin') == false) {
    header("Location: login.php");
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php
            if (isset($_GET['msg'])) {
                    echo $_GET['msg'];
                }
            ?>
            <h3>Your Profile Info</h3><br />
            <form action="" method="post">
                <?php
                $customerId = Session::get('customerId');
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
                            <div><button class='grey'><a class="grey" href='updateprofile.php'>Edit Profile</button></div>
                        </div>
                <?php    }
                } else echo $customer ?>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>