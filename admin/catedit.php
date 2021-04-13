<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
if (!isset($_GET['catId']) || $_GET['catId'] == null) {
    echo "<script>window.location = 'catlist.php'</script>";
} else {
    $db = new Database;
    $fm = new Format;
    $cat = new Category;
    $catId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
    $catId = $fm->validation($catId);
?>
    <?php
    if (isset($_POST['submit'])) {
        $catName = $_POST['catName'];
        $updateCat = $cat->updateCat($catId, $catName);
        if ($updateCat) {
            $message = "<span class='success'>Category Successfully Updated</span>";
        } else {
            $message = "<span class='error'>Field Must Not Be Empty</span>";
        }
    }
    ?>

<?php
    $catName = $cat->showCatName($catId);
    if ($catName == false) {
        $msg = "<span class='error'>Can not Find Category Name</span>";
        $data['catName'] = "";
    } else {
        $data = $catName->fetch_assoc();
    }
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
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
                            <input type="text" name="catName" value="<?php echo $data['catName']; ?>" placeholder="Enter Category Name..." class="medium" />
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