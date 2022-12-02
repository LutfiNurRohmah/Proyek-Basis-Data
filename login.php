<?php
require "konek.php";
$find= mysqli_select_db($mysqli, $database);

$email = $_POST['email'];
$ubah=$_POST['password'];
$password=md5($ubah);
 
$query = "SELECT * FROM user where email='$email' AND password='$password'";
$data= mysqli_query($mysqli, $query);
$result= mysqli_fetch_assoc($data);
$cek = mysqli_num_rows($data);

$query2 = "SELECT * FROM admin where email='$email' AND password='$password'";
$data2= mysqli_query($mysqli, $query2);
$result2= mysqli_fetch_assoc($data2);
$cek2 = mysqli_num_rows($data2);

if($cek){
    session_start();
    $_SESSION["user"] = $result;
    header("Location: home_user.php");
}else if($cek2){
    session_start();
    $_SESSION["admin"] = $result2;
    header("Location: home_admin.php");
}else {
    echo "email atau password salah";
}
?>