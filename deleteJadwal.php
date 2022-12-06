<?php
require "konek.php";
require_once("auth_admin.php");

$id_jadwal = $_GET['IdJadwal'];
$sql = "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_jadwal.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>