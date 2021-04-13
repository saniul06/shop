<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../helpers/format.php';
include_once $filePath . '/../lib/database.php';
class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    public function addProduct($post, $file)
    {
        $productName = $this->fm->validation($post['productName']);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId = $this->fm->validation($post['cId']);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $brandId = $this->fm->validation($post['bId']);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        // $body = $this->fm->validation($post['body']);
        $body = mysqli_real_escape_string($this->db->link, $post['body']);
        $price = $this->fm->validation($post['price']);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = $this->fm->validation($post['type']);
        $type = mysqli_real_escape_string($this->db->link, $type);
        //IMAGE
        $imageName = $this->fm->validation($file['image']['name']);
        $imageName = mysqli_real_escape_string($this->db->link, $imageName);
        $iamgeSize = $file['image']['size'];
        $imageTmpName = $file['image']['tmp_name'];
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $ext = explode('.', $imageName);
        $ext = strtolower(end($ext));
        $uniqueImageName = substr(md5(time()), 1, 10) . '.' . $ext;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $imageName == "") {
            return "<span class='error'>Field Must Not Be Empty</span>";
        } elseif (is_numeric($price) == FALSE) {
            return "<span class='error'>Please Enter Number For Price</span>";
        } elseif (in_array($ext, $permited) === false) {
            return "<span class='error'>Only jpg, jpeg, png, gif File Supported</span>";
        } elseif ($iamgeSize > 1048576) {
            return "<span class='error'>Image Size Should Less Than 1 MB</span>";
        } else {
            move_uploaded_file($imageTmpName, "uploads/" . $uniqueImageName);
            $query = "INSERT INTO tbl_product (productName, cId, bId, body, price, image, type) values('$productName', '$catId', '$brandId', '$body', '$price', '$uniqueImageName', '$type')";
            $this->db->insert($query);
            return "<span class='success'>Product Inserted Successfully</span>";
        }
    }

    public function getAllProduct()
    {
        // $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
        //             FROM tbl_product 
        //             INNER JOIN tbl_brand 
        //             ON tbl_brand.brandId = tbl_product.bId 
        //             INNER JOIN tbl_category 
        //             ON tbl_category.catId = tbl_product.bId 
        //             ORDER BY tbl_product.productId DESC";

        $query = "SELECT p.*, c.catName, b.brandName
                    FROM tbl_product AS p, tbl_category AS c, tbl_brand as b
                    WHERE p.cId = c.catId  AND p.bId = b.brandId
                    ORDER BY p.productId DESC";

        $shwoProduct = $this->db->select($query);
        if ($shwoProduct) {
            return $shwoProduct;
        } else {
            return false;
        }
    }

    public function getFeaturedProduct()
    {
        // $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
        //             FROM tbl_product 
        //             INNER JOIN tbl_brand 
        //             ON tbl_brand.brandId = tbl_product.bId 
        //             INNER JOIN tbl_category 
        //             ON tbl_category.catId = tbl_product.bId 
        //             ORDER BY tbl_product.productId DESC";

        $query = "SELECT * FROM tbl_product WHERE type = 0 ORDER BY productId DESC LIMIT 4";

        $shwoProduct = $this->db->select($query);
        if ($shwoProduct) {
            return $shwoProduct;
        } else {
            return false;
        }
    }

    public function getNewProduct()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";

        $shwoProduct = $this->db->select($query);
        if ($shwoProduct) {
            return $shwoProduct;
        } else {
            return false;
        }
    }

    public function getProductById($productId)
    {
        // $productId = $this->fm->validation($productId);
        // $productId = mysqli_real_escape_string($this->db->link, $productId);
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";

        $showProductName = $this->db->select($query);
        if ($showProductName) {
            return $showProductName;
        } else {
            return false;
        }
    }

    public function getSingleProduct($productId)
    {
        $query = "SELECT p.*, c.catName, b.brandName
                    FROM tbl_product AS p, tbl_category AS c, tbl_brand as b
                    WHERE p.cId = c.catId  AND p.bId = b.brandId AND p.productId = '$productId'
                    ORDER BY p.productId DESC";

        $shwoProduct = $this->db->select($query);
        if ($shwoProduct) {
            return $shwoProduct;
        } else {
            return false;
        }
    }

    public function updateProduct($productId, $post, $file)
    {
        $productId = $this->fm->validation($productId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $productName = $this->fm->validation($post['productName']);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $cId = $this->fm->validation($post['cId']);
        $cId = mysqli_real_escape_string($this->db->link, $cId);
        $bId = $this->fm->validation($post['bId']);
        $bId = mysqli_real_escape_string($this->db->link, $bId);
        //$body = $this->fm->validation($post['body']);
        $body = mysqli_real_escape_string($this->db->link, $post['body']);
        //$body = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $post['body']);
        $price = $this->fm->validation($post['price']);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = $this->fm->validation($post['type']);
        $type = mysqli_real_escape_string($this->db->link, $type);

        $imageName = $this->fm->validation($file['image']['name']);
        $imageName = mysqli_real_escape_string($this->db->link, $imageName);
        $imageSize = $file['image']['size'];
        $imageTmpName = $file['image']['tmp_name'];
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $ext = explode('.', $imageName);
        $ext = strtolower(end($ext));
        $uniqueImageName = substr(md5(time()), 2, 10) . '.' . $ext;

        if ($productId == "" || $productName == "" || $cId == "" || $bId == "" || $body == "" || $price == "" || $type == "") {
            return "<span class='error'>Field Must Not Be Empty</span>";
        } elseif (is_numeric($price) == FALSE) {
            return "<span class='error'>Please Enter Number For Price</span>";
        } else {

            if ($imageName == "") {
                $query = "UPDATE tbl_product SET productName = '$productName', cId = '$cId', bId = '$bId', body = '$body', price = '$price', type = '$type' WHERE productId = $productId";
                $result = $this->db->insert($query);
                if ($result) {
                    return "<span class='success'>Product Update Successfull</span>";
                } else {
                    return "<span class='error'>Product Update Failed</span>";
                }
            } else {
                if ($imageSize > 1048576) {
                    return "<span class='error'>File Size Should Less Than 1 MB</span>";
                } elseif (in_array($ext, $permited) === FALSE) {
                    return  "<span class='error'>Only Support " . implode(", ", $permited) . "</span>";
                } else {
                    move_uploaded_file($imageTmpName, 'uploads/' . $uniqueImageName);
                    $query = "UPDATE tbl_product SET productName = '$productName', cId = '$cId', bId = '$bId', body = '$body', price = '$price', type = '$type', image = '$uniqueImageName', type = '$type' WHERE productId = $productId";
                    $result = $this->db->insert($query);
                    if ($result) {
                        return "<span class='success'>Product Update Successfull</span>";
                    } else {
                        return "<span class='error'>Product Update Failed</span>";
                    }
                }
            }
        }
    }

    public function deleteProductById($productId)
    {
        $query = "SELECT image FROM tbl_product WHERE productId = '$productId'";
        $deleteImage = $this->db->select($query);
        if ($deleteImage) {
            $data = $deleteImage->fetch_assoc();
            unlink("uploads/" . $data['image']);
        }
        $query = "DELETE FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<span class='success'>Product Deleted Successfull</span>";
        } else {
            return "<span class='error'>Product Deletion Failed</span>";
        }
    }

    public function checkExist($productId)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query);
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function checkExistWishlist($customerId, $productId)
    {
        $query = "SELECT * FROM tbl_wishlist WHERE customerId = '$customerId' AND productId = '$productId'";
        $result = $this->db->select($query);
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function checkExistCompare($customerId, $productId)
    {
        $query = "SELECT * FROM tbl_compare WHERE customerId = '$customerId' AND productId = '$productId'";
        $result = $this->db->select($query);
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function newBrand() //FOR INDEX.PHP TO SHOW NEW BRAND PRODUCT
    {
        $individual = array();
        $query = "SELECT * FROM tbl_product ORDER BY bId ASC";
        $result = $this->db->select($query);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                if (empty($individual)) {
                    array_push($individual, $data['bId']);
                } else {
                    $i = $data['bId'];
                    if (in_array($i, $individual) == false) {
                        array_push($individual, $i);
                    }
                }
            }
        }
        $obj = array();
        for ($i = 0; $i < 4; $i++) {
            $a = array_pop($individual);
            array_push($obj, $a);
        }
        return $obj;
    }

    public function getProductByCatId($catId)
    {
        $query = "SELECT * FROM tbl_product WHERE cId = '$catId'";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertToWishlist($customerId, $productId)
    {
        $wishlist = $this->checkExistWishlist($customerId, $productId);
        if ($wishlist == true) {
            return "<span class='error'>Already Added To Wish List</span>";
        } else {
            $product = $this->getProductById($productId)->fetch_assoc();
            if ($product) {
                $productName = $product['productName'];
                $price = $product['price'];
                $image = $product['image'];
            } 
            $query = "INSERT INTO tbl_wishlist(customerId, productId, productName, price, image) VALUES('$customerId', '$productId', '$productName', '$price', '$image')";
            $insert = $this->db->insert($query);
            if ($insert) {
                return "<span class='success'>Added To Wish List</span>";
            } else {
                return "<span class='error'>Failed To Add Wish List</span>";
            }
        }
    }

    public function insertToCompare($customerId, $productId)
    {
        $compare = $this->checkExistCompare($customerId, $productId);
        if ($compare == true) {
            return "<span class='error'>Already Added To Compare List</span>";
        } else {
            $product = $this->getProductById($productId)->fetch_assoc();
            if ($product) {
                $productName = $product['productName'];
                $price = $product['price'];
                $image = $product['image'];
            } 
            $query = "INSERT INTO tbl_compare(customerId, productId, productName, price, image) VALUES('$customerId', '$productId', '$productName', '$price', '$image')";
            $insert = $this->db->insert($query);
            if ($insert) {
                return "<span class='success'>Added To Compare List</span>";
            } else {
                return "<span class='error'>Failed To Add Compare</span>";
            }
        }
    }

    public function getCompareProduct($customerId)
    {
        $query = "SELECT * FROM tbl_compare WHERE customerId = '$customerId' ORDER BY compareId DESC";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getWishlistProduct($customerId)
    {
        $query = "SELECT * FROM tbl_wishlist WHERE customerId = '$customerId' ORDER BY wishlistId DESC";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function deleteCompareProduct($compareId)
    {
        $query = "DELETE FROM tbl_compare WHERE compareId = '$compareId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<span class='success'>Remove Successfully</span>";
        } else {
            return "<span class='error'>Can Not Delete</span>";
        }
    }

    public function deleteWishlistProduct($wishlistId)
    {
        $query = "DELETE FROM tbl_wishlist WHERE wishlistId = '$wishlistId'";
        $result = $this->db->delete($query);
        if ($result) {
            return "<span class='success'>Remove Successfully</span>";
        } else {
            return "<span class='error'>Can Not Delete</span>";
        }
    }

    public function deleteAllCompare()
    {
        $customerId = Session::get('customerId');
        $query = "DELETE FROM tbl_compare WHERE customerId = '$customerId'";
        $result = $this->db->delete($query);
    }

    public function acer(){
        $query = "SELECT * FROM tbl_product WHERE bId = 1 LIMIT 4";

        $showProductName = $this->db->select($query);
        if ($showProductName) {
            return $showProductName;
        } else {
            return false;
        }
    }

    public function samsung(){
        $query = "SELECT * FROM tbl_product WHERE bId = 2 LIMIT 4";

        $showProductName = $this->db->select($query);
        if ($showProductName) {
            return $showProductName;
        } else {
            return false;
        }
    }

    public function canon(){
        $query = "SELECT * FROM tbl_product WHERE bId = 3 LIMIT 4";

        $showProductName = $this->db->select($query);
        if ($showProductName) {
            return $showProductName;
        } else {
            return false;
        }
    }
}
