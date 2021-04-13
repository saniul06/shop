<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../lib/database.php';
include_once $filePath . '/../helpers/format.php';
?>
<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    public function addToCart($quantity, $productId)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];

        $query = "INSERT INTO tbl_cart(sessionId, productId, productName, price, quantity, image) VALUES('$sessionId', '$productId', '$productName', '$price', '$quantity', '$image')";
        $result = $this->db->insert($query);
        if ($result) {
            header("location: cart.php");
        } else {
            header("location: 404.php");
        }
        // $check = $this->check($sessionId, $productId);
        // if ($check != false) {
        //     $data = $check->fetch_assoc();
        //     $singleQuantity = $quantity + $data['quantity'];
        //     $query = "UPDATE tbl_cart SET quantity = '$singleQuantity' WHERE sessionId = '$sessionId' AND productId = '$productId'";
        //     $result = $this->db->update($query);
        //     if ($result == false) {
        //         header("location: 404.php");
        //     } else {
        //         header("location: cart.php");
        //     }
        // } else {
        //     $query = "INSERT INTO tbl_cart(sessionId, productId, productName, price, quantity, image) VALUES('$sessionId', '$productId', '$productName', '$price', '$quantity', '$image')";
        //     $result = $this->db->insert($query);
        //     if ($result) {
        //         header("location: cart.php");
        //     } else {
        //         header("location: 404.php");
        //     }
        // }
    }

    public function getCarttBySession($sessionId)
    {
        // $productId = $this->fm->validation($productId);
        // $productId = mysqli_real_escape_string($this->db->link, $productId);
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";

        $showProductName = $this->db->select($query);
        if ($showProductName) {
            return $showProductName;
        } else {
            return false;
        }
    }

    public function getCartProduct()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getOrderedProduct($customerId)
    {
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY date DESC";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        $sessionId = session_id();
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE sessionId = '$sessionId' AND productId = '$productId'";
        $result = $this->db->update($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCart($productId)
    {
        $query = "DELETE FROM tbl_cart WHERE productId = '$productId'";
        $result = $this->db->delete($query);
    }

    public function check($sessionId, $productId)
    {
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' AND productId = '$productId'";
        $result = $this->db->select($query);
        if ($result != false) {
            return $result;
        } else {
            return false;
        }
    }

    public function deleteAllCart()
    {
        $sessionId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->delete($query);
    }

    public function order($customerId, $sessionId)
    {
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $productId = $data['productId'];
                $productName = $data['productName'];
                $price = $data['price'];
                $quantity = $data['quantity'];
                $image = $data['image'];
                $query = "INSERT INTO tbl_order(customerId, productId, productName, price, quantity, image) VALUES('$customerId', '$productId', '$productName', '$price', '$quantity', '$image')";
                $insert = $this->db->insert($query);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAllOrder(){
        $query = "SELECT * FROM tbl_order ORDER BY date ASC";
        $result = $this->db->select($query);
        if($result){
            return $result;
        } else {
            return false;
        }
    }

    public function updateStatus($orderId, $price, $date){
        $query = "UPDATE tbl_order SET status = 1 WHERE orderId = '$orderId' AND price = '$price' AND date = '$date'";
        $result = $this->db->update($query);
        if($result){
            return $result;
        } else {
            return false;
        }
    }

    public function deleteShiftedProduct($deleteId){
        $query = "DELETE FROM tbl_order WHERE orderId = '$deleteId'";
        $result = $this->db->delete($query);
        if($result){
            return $result;
        } else {
            return false;
        }
    }

    public function cofirmOrder($orderId){
        $query = "UPDATE tbl_order SET status = 2 WHERE orderId = '$orderId'";
        $result = $this->db->update($query);
        if($result){
            return true;
        } else {
            return false;
        }
    }
}
