<?php
require "konek.php";
$find= mysqli_select_db($mysqli, $database);

if(isset($_POST['simpan'])){
$nama = @$_POST["nama"];
$alamat = @$_POST["alamat"];
$nomorhp = @$_POST["nomor"];
$email = @$_POST["email"];
$ubah=$_POST['password'];
$password=md5($ubah);

$eemail = "SELECT email FROM user WHERE email='$email'";
$execute2 = mysqli_query($mysqli, $eemail);
$cek_email=mysqli_num_rows($execute2);

if($cek_email){
  echo '<script>alert("Email sudah terdaftar")</script>';
}else{
    $query="INSERT INTO user (nama_lengkap, alamat, email, nomor_hp, password) 
            VALUES('$nama','$alamat','$email','$nomorhp','$password')";
    $simpan= mysqli_query($mysqli, $query);
    if($simpan){
        echo '<script>alert("Data berhasil disimpan")</script>';
        header("Location: halaman_login.php");
    }else{
        echo '<script>alert("Data gagal disimpan")</script>';
    }
}
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <div class="card" style="margin:80px 220px 20px 220px;">
    <div class="card-body">
    <form method=post>
        <h1 class="text-center h3 mb-3 fw-normal">Daftar</h1>
        <div style="margin-top: 30px;">
        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" id="inputName" placeholder="">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputAddress" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" name="alamat" class="form-control" id="inputAddress" placeholder="">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Nomor HP</label>
            <div class="col-sm-10">
              <input type="text" name="nomor" class="form-control" id="inputNumber" placeholder="">
            </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="inputEmail3">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword3">
          </div>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <p class="mb-3 fw-normal" style="margin-top:10px;">Sudah punya akun? <a href="halaman_login.php">Login</a></p>
      </div>
      </form>
      </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>