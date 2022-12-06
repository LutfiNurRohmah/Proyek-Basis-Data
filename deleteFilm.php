<?php
require "konek.php";
require_once("auth_admin.php");

$id_film = $_GET['IdFilm'];
$sql = "DELETE FROM film WHERE id_film='$id_film'";
$execute= mysqli_query($mysqli, $sql);

if($execute){
	header("Location:kelola_film.php");
}
else{
	echo '<script>alert("Gagal Menghapus")</script>';
}
?>