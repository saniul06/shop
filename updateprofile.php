<?php include 'inc/header.php'; ?>
<?php if (Session::get('customerSignin') == false) {
    header("Location: login.php");
}
?>
<style>
    .tblone tr td {text-align: justify;}
    .tblone input[type='text'] {width: 450px;}
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php
            if (isset($_POST['update'])) {
                $update = $customer->updateProfile($_POST);
                if(isset($update)){
                    echo $update;
                }
            }
            ?>
            <h3>Update Your Profile</h3><br />
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
                                    <td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>City :</td>
                                    <td><input type="text" name="city" value="<?php echo $data['city']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Zip Code :</td>
                                    <td><input type="text" name="zipcode" value="<?php echo $data['zipcode']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Email :</td>
                                    <td><input type="text" name="email" value="<?php echo $data['email']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Address :</td>
                                    <td><input type="text" name="address" value="<?php echo $data['address']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Country :</td>
                                    <td><input type="text" name="country" value="<?php echo $data['country']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Phone :</td>
                                    <td><input type="text" name="phone" value="<?php echo $data['phone']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Old Password :</td>
                                    <td><input type="text" name="oldpassword" placeholder="Old Password"></td>
                                </tr>
                                <tr>
                                    <td>New Password :</td>
                                    <td><input type="text" name="newpassword" placeholder="New Password"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="search">
                            <div><button class="grey" name="update">Update Profile</button></div>
                        </div>
                <?php    }
                } else echo $customer ?>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>