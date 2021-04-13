<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <?php
        $cat = new Category;
        if (isset($_POST['submit'])) {
            $catName = $_POST['catName'];
            $insertCat = $cat->addCat($catName);
            if ($insertCat) {
                echo $insertCat;
            }
        }
        ?>
        <div class="block copyblock">
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="catName" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>