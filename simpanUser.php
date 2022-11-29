<?php
require "konek.php";
$find= mysqli_select_db($mysqli, $database);


$nama = @$_POST["nama"];
$alamat = @$_POST["alamat"];
$nomorhp = @$_POST["nomor"];
$email = @$_POST["email"];
$ubah=$_POST['password'];
$password=md5($ubah);

$query="INSERT INTO user (nama_lengkap, alamat, email, nomor_hp, password) VALUES('$nama','$alamat','$email','$nomorhp','$password')";
$simpan= mysqli_query($mysqli, $query);
if($simpan){
    echo "Data tersimpan:<br>";
    echo "Nama                : ".$nama."<br>";
    echo "Alamat              : ".$alamat."<br>";
    echo "Email       		  : ".$email."<br>";
    echo "Nomor HP            : ".$nomorhp."<br>"; 
    //echo "Password            : ".$password."<br>";
}else{
    echo "Data gagal disimpan";}
?>

