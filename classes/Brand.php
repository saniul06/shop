<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../helpers/format.php';
include_once $filePath . '/../lib/database.php';
class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }

    public function addBrand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            return "<span style='color:red;font-size:20px'>Field Must Not Be Empty</span>";
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
            $result = $this->db->insert($query);
            if ($result) {
                return "<span class='success'>Brand Inserted Successfully</span>";
            } else {
                return "<span class='error'>Field Must Not Be Empty</span>";
            }
        }
    }

    public function getAllBrand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $shwoBrand = $this->db->select($query);
        if ($shwoBrand) {
            return $shwoBrand;
        } else {
            return false;
        }
    }

    public function getBrandById($brandId)
    {
        $query = "SELECT brandName FROM tbl_brand WHERE brandId = '$brandId'";
        $getBrandById = $this->db->select($query);
        if ($getBrandById) {
            return $getBrandById;
        } else {
            return false;
        }
    }

    public function updateBrand($brandId, $brandName)
    {
        $brandId = $this->fm->validation($brandId);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            return false;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$brandId'";
            $updateBrand = $this->db->update($query);
            if ($updateBrand) {
                return $updateBrand;
            } else {
                return false;
            }
        }
    }

    public function deleteBrand($brandId)
    {
        $query = "DELETE FROM tbl_brand WHERE brandId = '$brandId'";
        $q = "SELECT * FROM tbl_brand WHERE brandId = '$brandId'";
        $ifIdExists = $this->db->select($q);
        if ($ifIdExists) {
            $deleteBrand = $this->db->delete($query);
            if ($deleteBrand) {
                return $deleteBrand;
            }
        } else {
            return false;
        }
    }
}
