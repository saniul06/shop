<?php
//include 't1/t1.php';
// include 't1/t1.php';
// function a($p){
//     if($p ==1){
//         $p = $p +2;
//     }
//     else {
//         $r = "p is not equal to 1";
//         return $r;
//     }
// }

// $s = a(1);
// if($s){
//     echo $s;
// }
// $link = new mysqli('localhost', 'sani', 'asd', 'db_blog');
// $data = "this & this   <hr/><script>CODE</script>";
// $d = "This is regula_expression";
// $data = trim($data);
// $data = stripcslashes($data);
// $data = htmlspecialchars($data);
// $data = mysqli_real_escape_string($link , $data);
// $data = preg_replace('/[^-a-zA-Z0-9_]/', '', $data);
// $d = preg_replace('/[^-a-zA-Z0-9_]/', '', $d);
//$d = preg_replace('/[^-a-zA-Z0-9_]/', '', $d);
// $d = mysqli_real_escape_string($link , $d);
// $d = trim($d);
// $d = stripcslashes($d);
// $d = htmlspecialchars($d);
// echo $d;
// $q = "SELECT concat(author, ' ', title, cat) as ass from tbl_post";
// $qq = "SELECT concat(c.firstname, ' ', c.lastname) as ass from tbl_contact as c";
// $qqq = "select max(cat) from tbl_post";
// $qqqq = "select cat, COUNT(cat) from tbl_post where cat>4 group by cat";
// $result = $link->query($qqqq);
// while($data = $result->fetch_assoc())
// echo implode($data).' <br/>';
// while($data = $result->fetch_assoc())

// echo $data['ass'].'<br/>';
// $a = array(1,2,3,4);
// $b = $a;
// var_dump($b);
// session_start();
// $_SESSION['login'] = "Saniul";
// echo $_SESSION['login'];
// echo '<br/>';
// $_SESSION['login'] = "0";
// if($_SESSION['login'] == false)
// echo "Session already unset";


// if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
//      $url = "https://";   
// else  
//      $url = "http://";   
// // Append the host(domain name, ip) to the URL.   
// $url.= $_SERVER['HTTP_HOST'];   

// // Append the requested resource location to the URL   
// $url.= $_SERVER['REQUEST_URI'];    
  
// echo $url;  
// echo "<br/>";
// $a = "";
// if(empty($a)){
//     echo "a is empty<br>";
// }
// $path = $_SERVER['SCRIPT_FILENAME'];
// $base = basename($path);
// echo $base;

echo '<a href="t1/t1.php?action=logout">this page</a>';
?>   