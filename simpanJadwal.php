<?php
require "konek.php";
require_once("auth_admin.php");
$find= mysqli_select_db($mysqli, $database);

$id_film = @$_POST["id_film"];
$tanggal_tayang = @$_POST["tanggal_tayang"];
$jam_tayang = @$_POST["jam_tayang"];
$studio = @$_POST["studio"];
$total_kursi= @$_POST["total_kursi"];
$harga = @$_POST["harga"];


$query="INSERT INTO jadwal (id_film, studio, total_kursi, sisa_kursi, tanggal_tayang, jam_tayang, harga) 
        VALUES('$id_film', '$studio', '$total_kursi', '$total_kursi', '$tanggal_tayang', '$jam_tayang', '$harga')";
$simpan= mysqli_query($mysqli, $query);
if($simpan){
    header("Location:kelola_jadwal.php");
}else{
    echo "Data gagal disimpan";}
?>

