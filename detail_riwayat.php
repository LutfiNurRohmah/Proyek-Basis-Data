<?php
require "konek.php";
require_once("auth.php");
$find= mysqli_select_db($mysqli, $database);
$id_user = $_SESSION["user"]['id_user'];

$kode_tiket=$_GET['KodeTiket'];
$query = "SELECT * FROM user INNER JOIN transaksi_tiket USING (id_user) INNER JOIN jadwal USING (id_jadwal) INNER JOIN film USING (id_film) WHERE kode_tiket='$kode_tiket'";
$execute = mysqli_query($mysqli, $query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Transaksi</title>
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
                  <a class="nav-link bg-primary text-light" href="riwayat_transaksi.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Riwayat Transaksi
                  </a>
                </li>
                
              </ul>
      
            </div>
          </nav>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h3 class="h5">Riwayat Transaksi - Detail Transaksi</h3>
            </div>

            <?php while($result = mysqli_fetch_assoc($execute)){ ?>

            <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="image_film.php?IdFilm=<?php echo $result['id_film']; ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body" style="margin-left:15px;">
                    <h5 class="card-title"><?= $result['judul']?></h5>
                    <div style="margin-right:20px;">
                    <table class="table">
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Kode Tiket</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['kode_tiket']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Id - Nama User</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['id_user']?> - <?= $result['nama_lengkap']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Id Film</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['id_film']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Tanggal Tayang</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['tanggal_tayang']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Jam Tayang</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['jam_tayang']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Durasi</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['durasi']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Studio</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['studio']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Harga</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['harga']?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p class="card-text"><small class="text-muted">Waktu Transaksi</small></p></td>
                            <td><p class="card-text"><small class="text-muted">:</small></p></td>
                            <td><p class="card-text"><?= $result['waktu_transaksi']?></p></td>
                            <td></td>
                        </tr>
                    </table>
                    </div>
                </div>
                </div>

            </div>
            </div>

            <?php }?>


          </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>