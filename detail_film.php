<?php
include('konek.php');
require_once("auth_admin.php");
$id_film=$_GET['IdFilm'];
$query = "SELECT * FROM film WHERE id_film='$id_film'";
$execute = mysqli_query($mysqli, $query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Film</title>
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
                  <a class="nav-link bg-primary text-light" href="kelola_film.php">
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
              <h3 class="h5">Kelola Film - Detail Film</h3>
            </div>

				<?php while($result = mysqli_fetch_assoc($execute)){ ?>

        <div class="card" style="max-width: 600px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="image_film.php?IdFilm=<?php echo $result['id_film']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title"><?= $result['judul']?></h3>
                <p class="card-text"><?= $result['sinopsis']?></p>
                <p class="card-text"><small class="text-muted">Genre : </small><?= $result['genre']?></p>
                <p class="card-text"><small class="text-muted">Durasi: </small><?= $result['durasi']?></p>
                <a href="update_film.php?IdFilm=<?= $result['id_film']?>"><button type="button" class="btn btn-primary">Edit</button></a>
                <a href="deleteFilm.php?IdFilm=<?= $result['id_film']?>"><button type="button" class="btn btn-primary">Hapus</button></a>
              </div>
            </div>
          </div>
        </div>

        <div class="card" style="margin-top:20px; margin-bottom:20px;">
            <div class="card-body">
              <p class="card-text"><small class="text-muted">Rilis</small></p>
              <p class="card-text"><?= $result['tanggal_rilis']?></p>
              <p class="card-text"><small class="text-muted">Produser</small></p>
              <p class="card-text"><?= $result['produser']?></p>
              <p class="card-text"><small class="text-muted">Penulis</small></p>
              <p class="card-text"><?= $result['penulis']?></p>
              <p class="card-text"><small class="text-muted">Sutradara</small></p>
              <p class="card-text"><?= $result['sutradara']?></p>
              <p class="card-text"><small class="text-muted">Produksi</small></p>
              <p class="card-text"><?= $result['produksi']?></p>   
            </div>
          </div>
				<?php }?>
          </main>
        </div>
    </div>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>