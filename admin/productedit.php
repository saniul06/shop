<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/Product.php';
include '../classes/Category.php';
include '../classes/Brand.php';
$pr = new Product;
$cat = new Category;
$br = new Brand;
?>
<?php
if (!isset($_GET['productId']) || $_GET['productId'] == null) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $productId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productId']);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
        $checkExist = $pr->checkExist($productId);
        if ($checkExist == false) {
            echo '<script>window.location = "productlist.php"</script>';
        }
        ?>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $update = $pr->updateProduct($productId, $_POST, $_FILES);
            if ($update) {
                echo $update;
            }
        }
        ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $product = $pr->getProductById($productId);
                    $data = $product->fetch_assoc(); ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $data['productName']; ?>" placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cId">
                                <option disabled>Select Category</option>
                                <?php $result = $cat->getAllCat();
                                if ($result) {
                                    while ($category = $result->fetch_assoc()) { ?>

                                        <option <?php
                                                if ($data['cId'] == $category['catId']) {
                                                    echo "selected";
                                                }
                                                ?> value="<?php echo $category['catId'] ?>"><?php echo $category['catName'] ?></option>
                                <?php       }
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="bId">
                                <option disabled>Select Brand</option>
                                <?php $result = $br->getAllBrand();
                                if ($result) {
                                    while ($brand = $result->fetch_assoc()) { ?>
                                        <option <?php
                                                if ($data['bId'] == $brand['brandId']) {
                                                    echo "selected";
                                                }
                                                ?> value="<?php echo $brand['brandId'] ?>"><?php echo $brand['brandName']; ?></option>
                                <?php       }
                                } ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body">
                            <?php echo $data['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $data['price']; ?>" name="price" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="uploads/<?php echo $data['image']; ?>" width=200 height=200 alt=""> <br />
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option disabled>Select Type</option>
                                <option value="0" <?php if ($data['type'] == '0') {
                                                        echo "selected";
                                                    } ?>>Featured</option>
                                <option <?php if ($data['type'] == '1') {
                                            echo "selected";
                                        } ?> value="1">General</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>