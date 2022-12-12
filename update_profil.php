<?php
require "konek.php";
require_once("auth.php");
$find= mysqli_select_db($mysqli, $database);
$id_user = $_GET['IdUser'];

$query = "SELECT * FROM user WHERE id_user='$id_user'";
$execute = mysqli_query($mysqli, $query);
$result = mysqli_fetch_assoc($execute);

if(isset($_POST['update'])){
            $nama_lengkap = @$_POST["nama"];
            $alamat = @$_POST["alamat"];
            $nomorhp = @$_POST["nomor"];
            $email = @$_POST["email"];

            $eemail = "SELECT email FROM user WHERE email='$email'";
            $execute2 = mysqli_query($mysqli, $eemail);
            $cek_email=mysqli_num_rows($execute2);

    if(!(in_array($email, $result))){  
        if($cek_email > 0){
            echo '<script>alert("Email sudah terdaftar")</script>';
        }else{ 
            $sql = "UPDATE user SET nama_lengkap='$nama_lengkap', 
                                    alamat='$alamat', 
                                    nomor_hp='$nomorhp', 
                                    email='$email'
                    WHERE id_user='$id_user'";
            $execute = mysqli_query($mysqli, $sql);
            
            if($execute){
                header('Location:profil.php');
            }else{
                echo "GAGAL UPDATE DATA";
            }
        } 
    }else if((in_array($email, $result))){
            $sql = "UPDATE user SET nama_lengkap='$nama_lengkap', alamat='$alamat', nomor_hp='$nomorhp' WHERE id_user='$id_user'";
            $execute = mysqli_query($mysqli, $sql);
            
            if($execute){
                header('Location:profil.php');
            }else{
                echo "GAGAL UPDATE DATA";
            }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
  <body>
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">OurCinema</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="btn-group dropstart">
          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo  $_SESSION["user"]["nama_lengkap"] ?>
          </button>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="profil.php">Profil</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </header>
      
      <div class="container-fluid">
        <div class="row">
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home_user.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="lihat_jadwal.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Lihat Jadwal
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pengisian_saldo.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Isi Saldo
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="riwayat_transaksi.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Riwayat Transaksi
                  </a>
                </li>
                
              </ul>
      
            </div>
          </nav>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h3 class="h5">Profil - Update Profil</h3>
            </div>

            <form method=post>
        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" id="inputName" value="<?=$result['nama_lengkap']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputAddress" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" name="alamat" class="form-control" id="inputAddress" value="<?=$result['alamat']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Nomor HP</label>
            <div class="col-sm-10">
              <input type="text" name="nomor" class="form-control" id="inputNumber" value="<?=$result['nomor_hp']?>">
            </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="inputEmail3" value="<?=$result['email']?>">
          </div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="profil.php"><button type="button" class="btn btn-primary">Batal</button>
      </form>

          </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>