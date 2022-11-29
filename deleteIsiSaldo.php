<?php
require "konek.php";

$id_isisaldo = $_GET['IdIsiSaldo'];
$sql = "DELETE FROM pengisian_saldo WHERE id_isisaldo='$id_isisaldo'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_user.php");
}
else{
	echo "GAGAL MENGHAPUS";
}
?>