<?php
include('konek.php');
if(isset($_GET['IdFilm'])) 
{
    $query = mysqli_query($mysqli,"SELECT gambar FROM film WHERE id_film='".$_GET['IdFilm']."'");
    $row = mysqli_fetch_array($query);
    //header("Content-type: " . $row["tipe_gambar"]);
    echo $row["gambar"];
}
else
{
    header('location:detail_film.php');
}
?>