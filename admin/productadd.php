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

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $addProduct = $pr->addProduct($_POST, $_FILES);
            if($addProduct){
                echo $addProduct;
            }
        }
        ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cId">
                                <option disabled>Select Category</option>
                                <?php
                                $result = $cat->getAllCat();
                                if ($result) {
                                    while ($data = $result->fetch_assoc()) { ?>

                                        <option value="<?php echo $data['catId'] ?>"><?php echo $data['catName']; ?></option>
                                <?php    }
                                }
                                ?>
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
                                <?php
                                $result = $br->getAllBrand();
                                if ($result) {
                                    while ($data = $result->fetch_assoc()) { ?>

                                        <option value="<?php echo $data['brandId'] ?>"><?php echo $data['brandName']; ?></option>
                                <?php    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
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
                                <option value="0">Featured</option>
                                <option value="1">General</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add" />
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