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

if($cek){
    session_start();
    $_SESSION["user"] = $result;
    header("Location: home_user.php");
}else{
    if($email=="admin@gmail.com" && $password==md5("admin1234")){
        session_start();
        $_SESSION["admin"];
        header("Location: home_admin.php");
    } else {
    echo "email atau password salah";
    }
}

?>