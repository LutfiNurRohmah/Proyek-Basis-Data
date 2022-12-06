<?php
require "konek.php";
require_once("auth.php");

$id_isisaldo = $_GET['IdIsiSaldo'];
$sql = "DELETE FROM pengisian_saldo WHERE id_isisaldo='$id_isisaldo'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:pengisian_saldo.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>