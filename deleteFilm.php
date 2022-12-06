<?php
require "konek.php";

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