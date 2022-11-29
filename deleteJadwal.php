<?php
require "konek.php";

$id_jadwal = $_GET['IdJadwal'];
$sql = "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_jadwal.php");
}
else{
	echo "GAGAL MENGHAPUS";
}
?>