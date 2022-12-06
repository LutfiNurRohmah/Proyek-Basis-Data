<?php
require "konek.php";
require_once("auth_admin.php");

$id_user = $_GET['IdUser'];
$sql = "DELETE FROM user WHERE id_user='$id_user'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_user.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>