<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../helpers/format.php';
include_once $filePath . '/../lib/database.php';
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    public function addCat($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            return "<span style='color:red;font-size:20px'>Field Must Not Be Empty</span>";
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                return "<span class='success'>Category Inserted Successfully</span>";
            } else {
                return "<span class='error'>Field Must Not Be Empty</span>";
            }
        }
    }

    public function getAllCat()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $showCat = $this->db->select($query);
        if ($showCat) {
            return $showCat;
        } else {
            return false;
        }
    }

    public function showCatName($catId)
    {
        $query = "SELECT catName FROM tbl_category WHERE catId = '$catId'";
        $showCatName = $this->db->select($query);
        if ($showCatName) {
            return $showCatName;
        } else {
            return false;
        }
    }

    public function updateCat($catId, $catName)
    {
        $catId = $this->fm->validation($catId);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            return false;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$catId'";
            $updateCat = $this->db->update($query);
            if ($updateCat) {
                return $updateCat;
            } else {
                return false;
            }
        }
    }

    public function deleteCat($catId)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$catId'";
        $q = "SELECT * FROM tbl_category WHERE catId = '$catId'";
        $ifIdExists = $this->db->select($q);
        if ($ifIdExists) {
            $deleteCat = $this->db->delete($query);
            if ($deleteCat) {
                return $deleteCat;
            }
        } else {
            return false;
        }
    }
}
