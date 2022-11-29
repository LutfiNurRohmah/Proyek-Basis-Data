<?php
 $user_name = "root";
 $password  = "";
 $database  = "ourcinema";
 $host_name = "localhost";

 $mysqli= mysqli_connect($host_name, $user_name, $password, $database) or die('Koneksi ke database gagal!');
 ?>