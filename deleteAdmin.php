<?php
require "konek.php";
require_once("auth_admin.php");

$id_admin = $_GET['IdAdmin'];
$sql = "DELETE FROM admin WHERE id_admin='$id_admin'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_admin.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>