<?php
require "konek.php";
require_once("auth_admin.php");
$find= mysqli_select_db($mysqli, $database);

$id_film = $_GET['IdFilm'];
$sql_read = "SELECT * FROM film WHERE id_film='$id_film'";
$execute_read = mysqli_query($mysqli, $sql_read);
$result_read = mysqli_fetch_assoc($execute_read);

if(isset($_POST['update'])){
	        $judul = @$_POST["judul"];
            $genre = @$_POST["genre"];
            $durasi = @$_POST["durasi"];
            $sinopsis = @$_POST["sinopsis"];
            $tanggal_rilis = @$_POST["tanggal_rilis"];
            $produser = @$_POST["produser"];
            $sutradara = @$_POST["sutradara"];
            $penulis = @$_POST["penulis"];
            $produksi = @$_POST["produksi"];
	
	$sql = "UPDATE film SET judul='$judul', genre='$genre', durasi='$durasi', sinopsis='$sinopsis', tanggal_rilis='$tanggal_rilis', produser='$produser', sutradara='$sutradara', penulis='$penulis', produksi='$produksi' WHERE id_film='$id_film'";
	$execute = mysqli_query($mysqli, $sql);
	
	if($execute){
		header('Location:kelola_film.php');
	}else{
		echo "GAGAL UPDATE DATA";
	}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Film</title>
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
              <h3 class="h5">Kelola Film</h3>
            </div>

        <form method=post action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <h6 class="h6">Update Film</h6>
            <div class="row mb-3">
            <label for="inputJudul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
              <input type="text" name="judul" class="form-control" id="inputJudul" value="<?=$result_read['judul']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputGenre" class="col-sm-2 col-form-label">Genre</label>
            <div class="col-sm-10">
              <input type="text" name="genre" class="form-control" id="inputGenre" value="<?=$result_read['genre']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputDurasi" class="col-sm-2 col-form-label">Durasi</label>
            <div class="col-sm-10">
              <input type="text" name="durasi" class="form-control" id="inputDurasi" value="<?=$result_read['durasi']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputGenre" class="col-sm-2 col-form-label">Sinopsis</label>
            <div class="col-sm-10">
              <input type="text" name="sinopsis" class="form-control" id="inputGenre" value="<?=$result_read['sinopsis']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputDurasi" class="col-sm-2 col-form-label">Tanggal Rilis</label>
            <div class="col-sm-10">
              <input type="date" name="tanggal_rilis" class="form-control" id="inputDurasi" value="<?=$result_read['tanggal_rilis']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputGenre" class="col-sm-2 col-form-label">Produser</label>
            <div class="col-sm-10">
              <input type="text" name="produser" class="form-control" id="inputGenre" value="<?=$result_read['produser']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputDurasi" class="col-sm-2 col-form-label">Sutradara</label>
            <div class="col-sm-10">
              <input type="text" name="sutradara" class="form-control" id="inputDurasi" value="<?=$result_read['sutradara']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputGenre" class="col-sm-2 col-form-label">Penulis</label>
            <div class="col-sm-10">
              <input type="text" name="penulis" class="form-control" id="inputGenre" value="<?=$result_read['penulis']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputDurasi" class="col-sm-2 col-form-label">Produksi</label>
            <div class="col-sm-10">
              <input type="text" name="produksi" class="form-control" id="inputDurasi" value="<?=$result_read['produksi']?>">
            </div>
        </div>
        <!-- <div class="row mb-3">
            <label for="inputGroupFile" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
              <input type="file" name="gambar" class="form-control" id="inputGroupFile02">
            </div>
        </div> -->
        <button type="submit" class="btn btn-primary" name="update">Simpan</button>
    </form>

    
          </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>