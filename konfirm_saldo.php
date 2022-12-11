<?php
require_once("auth_admin.php");
require "konek.php";
$find= mysqli_select_db($mysqli, $database);
$id_isisaldo=$_GET['IdSaldo'];

$query2 = "SELECT * FROM user INNER JOIN pengisian_saldo USING (id_user) 
           WHERE id_isisaldo='$id_isisaldo'";
$execute2 = mysqli_query($mysqli, $query2);

$query = "SELECT * FROM pengisian_saldo WHERE id_isisaldo='$id_isisaldo'";
$execute = mysqli_query($mysqli, $query);

$result = mysqli_fetch_assoc($execute2);

if(isset($_POST['terima']) and $result['status']=='Pending'){
    $jumlah_saldo = $result['saldo'] + $result['jumlah_isi'];
    $status = "Success";
    $id_user = $result['id_user'];
    $id_isisaldo = $result['id_isisaldo'];

    $sql = "UPDATE user SET saldo='$jumlah_saldo' 
            WHERE id_user='$id_user'";
    $tambahSaldo = mysqli_query($mysqli, $sql);

    $sql2 = "UPDATE pengisian_saldo SET status='$status' 
             WHERE id_isisaldo='$id_isisaldo'";
    $ubahStatus = mysqli_query($mysqli, $sql2);

    if($tambahSaldo and $ubahStatus){
    header('Location:kelola_user.php');
    }else{
      echo '<script>alert("Gagal Update Data")</script>';
    }
}
if(isset($_POST['tolak']) and $result['status']=='Pending'){
    $status = "Gagal";
    $id_isisaldo = $result['id_isisaldo'];

    $sql2 = "UPDATE pengisian_saldo SET status='$status' WHERE id_isisaldo='$id_isisaldo'";
    $ubahStatus = mysqli_query($mysqli, $sql2);

    if($ubahStatus){
    header('Location:kelola_user.php');
    }else{
      echo '<script>alert("Gagal Update Data")</script>';
    }
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Saldo</title>
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
                  <a class="nav-link bg-primary text-light" href="kelola_user.php">
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
              <h3 class="h5">Kelola User - Konfirmasi Pengisian Saldo</h3>
            </div>

            <div class="card" style="max-width: 700px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="image_bukti.php?IdSaldo=<?php echo $result['id_isisaldo']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body" style="margin-left:15px;">
                        <h3 class="card-title"><small class="text-muted">Jumlah Isi</small></h3>
                        <h3 class="card-title"><?= $result['jumlah_isi']?></h3>
                        <p class="card-text"><small class="text-muted">Id Isi Saldo&emsp;&emsp;&nbsp;&nbsp;: </small><?= $result['id_isisaldo']?></p>
                        <p class="card-text"><small class="text-muted">Id User&emsp;&emsp;&emsp;&emsp;&nbsp;: </small><?= $result['id_user']?></p>
                        <p class="card-text"><small class="text-muted">Nama&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;: </small><?= $result['nama_lengkap']?></p>
                        <p class="card-text"><small class="text-muted">Waktu Transaksi : </small><?= $result['waktu_transaksi']?></p>
                        <p class="card-text"><small class="text-muted">Status&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: </small><?= $result['status']?></p>
                        <form method=post>
                        <button type="submit" class="btn btn-primary" name="terima">Terima</button>
                        <button type="submit" class="btn btn-primary" name="tolak">Tolak</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

    </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>