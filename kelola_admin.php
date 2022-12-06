<?php
require_once("auth_admin.php");
require "konek.php";
$find= mysqli_select_db($mysqli, $database);
$query="SELECT * FROM admin";
$execute = mysqli_query($mysqli, $query);

if(isset($_POST['tambah'])){
    $nama_admin = @$_POST["nama"];
    $email = @$_POST["email"];
    $ubah=$_POST['password'];
    $password=md5($ubah);
    
    $eemail = "SELECT email FROM admin WHERE email='$email'";
    $execute2 = mysqli_query($mysqli, $eemail);
    $cek_email=mysqli_num_rows($execute2);
    
    if($cek_email ){
      echo '<script>alert("Email sudah terdaftar")</script>';
    }else{
        $query="INSERT INTO admin (nama_admin, email, password) VALUES('$nama_admin','$email','$password')";
        $simpan= mysqli_query($mysqli, $query);
        if($simpan){
            echo '<script>alert("Data berhasil disimpan")</script>';
            header("Location: kelola_admin.php");
        }else{
            echo '<script>alert("Data gagal disimpan")</script>';
        }
    }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Admin</title>
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
            <?php echo  $_SESSION["admin"]["nama_admin"] ?>
          </button>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="kelola_admin.php">Kelola Admin</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout_admin.php">Logout</a></li>
          </ul>
        </div>
    </header>
      
      <div class="container-fluid">
        <div class="row">
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home_admin.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="kelola_user.php">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Kelola User
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="kelola_film.php">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Kelola Film
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="kelola_jadwal.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Kelola Jadwal Tayang
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="kelola_transaksi_tiket.php">
                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                    Kelola Transaksi Tiket
                  </a>
                </li>
              </ul>
      
            </div>
          </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h3 class="h5">Kelola Admin</h3>
            </div>

            
              <h6 class="h6">List Admin</h6>

      <table class="table table-bordered">
				<thead class="table-primary">
                 <td align=center>Id Admin</td>
				 <td align=center>Nama Admin</td>
				 <td align=center>Email</td>
                 <td align=center>Pilihan Menu</td>
				</thead>
				<?php while($result = mysqli_fetch_assoc($execute)){ ?>
				<tr>
				 <td><?= $result['id_admin']?></td>
				 <td><?= $result['nama_admin']?></td>
				 <td><?= $result['email']?></td>
         <td align=center>
            <a href="deleteAdmin.php?IdAdmin=<?= $result['id_admin']?>"><button type="button" class="btn btn-primary">Hapus</button></a>
				 </td>
				</tr>
				<?php }?>
			</table>

            <div class="border-top" style="margin-top:40px;">
      <h6 class="h6" style="margin-top:15px;">Tambah Admin</h6>
      </div>

            <form method=post>
        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Nama Admin</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" id="inputName">
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
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      </form>
    </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>