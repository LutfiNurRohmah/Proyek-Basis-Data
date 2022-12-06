<?php
require "konek.php";

$kode_tiket = $_GET['KodeTiket'];
$sql = "DELETE FROM transaksi_tiket WHERE kode_tiket='$kode_tiket'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_transaksi_tiket.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>