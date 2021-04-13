<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php
if (!isset($_GET['brandId']) || $_GET['brandId'] == null) {
    echo "<script>window.location = 'brandlist.php'</script>";
} else {
    $db = new Database;
    $fm = new Format;
    $brand = new Brand;
    $brandId = preg_replace('/[^0-9_]/', '', $_GET['brandId']);
    $brandId = $fm->validation($brandId);
?>
    <?php
    if (isset($_POST['submit'])) {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->updateBrand($brandId, $brandName);
        if ($updateBrand) {
            $message = "<span class='success'>Brand Successfully Updated</span>";
        } else {
            $message = "<span class='error'>Field Must Not Be Empty</span>";
        }
    }
    ?>

<?php
    $brandName = $brand->getBrandById($brandId);
    if ($brandName == false) {
        $msg = "<span class='error'>Can not Find Brand Name</span>";
        $data['brandName'] = "";
    } else {
        $data = $brandName->fetch_assoc();
    }
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Brand</h2>
        <?php if (isset($msg)) {
            echo $msg;
        }
        if (isset($message)) {
            echo $message;
        }
        ?>
        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" value="<?php echo $data['brandName']; ?>" placeholder="Enter Brand Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>