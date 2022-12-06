<?php
require "konek.php";
require_once("auth_admin.php");
$find= mysqli_select_db($mysqli, $database);

$judul = @$_POST["judul"];
$genre = @$_POST["genre"];
$durasi = @$_POST["durasi"];
$sinopsis = @$_POST["sinopsis"];
$tanggal_rilis = @$_POST["tanggal_rilis"];
$produser = @$_POST["produser"];
$sutradara = @$_POST["sutradara"];
$penulis = @$_POST["penulis"];
$produksi = @$_POST["produksi"];
$gambar = @$_POST["gambar"];


$query="INSERT INTO film (judul, genre, gambar, durasi, sinopsis, tanggal_rilis, produser, penulis, sutradara, produksi) VALUES('$judul','$genre','$gambar','$durasi','$sinopsis', '$tanggal_rilis', '$produser', '$penulis', '$sutradara', '$produksi')";
$simpan= mysqli_query($mysqli, $query);
if($simpan){
    header("Location:kelola_film.php");
}else{
    echo "Data gagal disimpan";}
?>

