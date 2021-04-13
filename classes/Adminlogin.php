<?php
include '../helpers/format.php';
include '../lib/database.php';
class AdminLogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    public function adminLogin($adminName, $adminPassword, $url)
    {
        $adminName = $this->fm->validation($adminName);
        $adminPassword = $this->fm->validation($adminPassword);
        $adminName = mysqli_real_escape_string($this->db->link, $adminName);
        $adminPassword = mysqli_real_escape_string($this->db->link, $adminPassword);
        if ($adminName == "" || $adminPassword == "") {
            $error = "<span style='color:red;font-size:20px'>Field Must Not Be Empty</span>";
            return $error;
        } else {
            $adminPassword = mysqli_real_escape_string($this->db->link, md5($adminPassword));
            $query = "SELECT * FROM tbl_admin WHERE adminName = '$adminName' AND adminPassword = '$adminPassword'";
            $result = $this->db->select($query);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::set('login', true);
                Session::set('adminName', $value['adminName']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminId', $value['adminId']);
                Session::set('level', $value['level']);
                if (empty($url)) {
                    header("Location: index.php");
                } else {
                    header("Location: $url");
                }
            } else {
                $error = "<span style='color:red;font-size:20px'>Username or Password Not Found</span>";
                return $error;
            }
        }
    }
}
