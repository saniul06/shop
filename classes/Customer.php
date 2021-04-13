<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../lib/database.php';
include_once $filePath . '/../helpers/format.php';
?>
<?php
class Customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    public function customerRegistration($post)
    {
        $name = $this->fm->validation($post['name']);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $city = $this->fm->validation($post['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $zipcode = $this->fm->validation($post['zipcode']);
        $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
        $email = $this->fm->validation($post['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $address = $this->fm->validation($post['address']);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = $this->fm->validation($post['country']);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone = $this->fm->validation($post['phone']);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $password = $this->fm->validation($post['password']);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($name) || empty($city) || empty($zipcode) || empty($email) || empty($address) || empty($country) || empty($phone) || empty($password)) {
            return "<span class='error'>Field Must Not Be Empty</span>";
        }

        $query = "SELECT email FROM tbl_customer WHERE email = '$email'";
        $check = $this->db->select($query);

        if ($check != FALSE) {
            return "<span class='error'>Email Already Exists</span>";
        } else {
            $password = md5($password);
            $query = "INSERT INTO tbl_customer(name, city, zipcode, email, address, country, phone, password) VALUES('$name', '$city', '$zipcode', '$email', '$address', '$country', '$phone', '$password')";
            $result = $this->db->insert($query);
            if ($result) {
                return "<span class='success'>Registration Successful</span>";
            } else {
                return "<span class='error'>Registration Failed</span>";
            }
        }
    }

    public function customerSignin($post, $url)
    {
        $email = $this->fm->validation($post['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = $this->fm->validation($post['password']);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($email) || empty($password)) {
            return "<span class='error'>Field Must Not Be Empty</span>";
        } else {
            $password = md5($password);
            $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($query);
            if ($result) {
                $data = $result->fetch_assoc();
                Session::set('customerSignin', TRUE);
                Session::set('customerId', $data['customerId']);
                if(empty($url)){
                    header("location: index.php");
                } else {
                    header("location: $url");
                }
                
            } else {
                return "<span class='error'>Email or Password Do Not Match</span>";
            }
        }
    }

    public function getCustomerData($customerId)
    {
        $query = "SELECT * FROM  tbl_customer WHERE customerId = '$customerId'";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return "<span class='error'>Do Not Find Customer Details</span>";
        }
    }

    public function updateProfile($post)
    {
        $customerId = Session::get('customerId');
        $name = $this->fm->validation($post['name']);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $city = $this->fm->validation($post['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $zipcode = $this->fm->validation($post['zipcode']);
        $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
        $email = $this->fm->validation($post['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $address = $this->fm->validation($post['address']);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = $this->fm->validation($post['country']);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone = $this->fm->validation($post['phone']);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $oldpassword = $this->fm->validation($post['oldpassword']);
        $oldpassword = mysqli_real_escape_string($this->db->link, $oldpassword);
        $newpassword = $this->fm->validation($post['newpassword']);
        $newpassword = mysqli_real_escape_string($this->db->link, $newpassword);

        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $oldpassword == "" || $newpassword == "") {
            return "<span class='error'>Filed Must Not Be Empty</span>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<span class='error'>Invalid email format</span>";
        }

        $query = "SELECT password FROM tbl_customer WHERE customerId = '$customerId'";
        $result = $this->db->select($query);
        $check = $result->fetch_assoc();
        $checkPassword = $check['password'];
        $oldpassword = md5($oldpassword);
        if ($checkPassword != $oldpassword) {
            return "<span class='error'>Password Do Not Match</span>";
        } else {
            $newpassword = md5($newpassword);
            $query = "UPDATE tbl_customer SET name = '$name', city = '$city', zipcode = '$zipcode', email = '$email', address = '$address', country = '$country', phone = '$phone', password = '$newpassword' WHERE customerId = '$customerId'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class='success'>Profile Updated Successfully</span>";
                header("location: profile.php?msg=$msg");
            } else {
                return "<span class='error'>Profile Update Failed</span>";
            }
        }
    }
}
