<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>
        <?php
        $brand = new brand;
        if (isset($_POST['submit'])) {
            $brandName = $_POST['brandName'];
            $insertBrand = $brand->addBrand($brandName);
            if ($insertBrand) {
                echo $insertBrand;
            }
        }
        ?>
        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Add" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>