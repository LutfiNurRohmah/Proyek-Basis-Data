<?php
require "konek.php";
require_once("auth_admin.php");
$find= mysqli_select_db($mysqli, $database);
$query="SELECT * FROM jadwal";
$execute = mysqli_query($mysqli, $query);
$query2="SELECT id_film, judul FROM film";
$execute2= mysqli_query($mysqli, $query2);

$id_jadwal = $_GET['IdJadwal'];
$sql_read = "SELECT * FROM jadwal WHERE id_jadwal='$id_jadwal'";
$execute_read = mysqli_query($mysqli, $sql_read);
$result_read = mysqli_fetch_assoc($execute_read);

if(isset($_POST['update'])){
    $id_film = @$_POST["id_film"];
    $tanggal_tayang = @$_POST["tanggal_tayang"];
    $jam_tayang = @$_POST["jam_tayang"];
    $studio = @$_POST["studio"];
    $total_kursi= @$_POST["total_kursi"];
    $harga = @$_POST["harga"];
	
	$sql = "UPDATE jadwal SET id_film='$id_film', tanggal_tayang='$tanggal_tayang', jam_tayang='$jam_tayang', studio='$studio', total_kursi='$total_kursi', sisa_kursi='$total_kursi', harga='$harga' WHERE id_jadwal='$id_jadwal'";
	$execute = mysqli_query($mysqli, $sql);
	
	if($execute){
		header('Location:kelola_jadwal.php');
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
    <title>Kelola Jadwal Tayang</title>
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
                  <a class="nav-link bg-primary text-light" href="kelola_jadwal.php">
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
              <h3 class="h5">Kelola Jadwal Tayang</h3>
            </div>

            <!-- input film -->
    <form method=post action="<?php $_SERVER['PHP_SELF']?>">
      <h6 class="h6">Update Jadwal</h6>
        <div class="row mb-3">
          <label for="inputIDFilm" class="col-sm-2 col-form-label">Film</label>
          <div class="col-sm-10">
            <select type="text" name="id_film" class="form-select form-control" aria-label="Default select example">
              <option selected><?=$result_read['id_film']?></option>
              <?php while($pilihID = mysqli_fetch_assoc($execute2)){ ?>
                <option value="<?= $pilihID['id_film']?>"><?= $pilihID['id_film']?>-<?= $pilihID['judul']?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputTGLTY" class="col-sm-2 col-form-label">Tanggal Tayang</label>
            <div class="col-sm-10">
              <input type="date" name="tanggal_tayang" class="form-control" id="inputTGLTY" value="<?=$result_read['tanggal_tayang']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputJTY" class="col-sm-2 col-form-label">Jam Tayang</label>
            <div class="col-sm-10">
              <input type="time" name="jam_tayang" class="form-control" id="inputJTY" value="<?=$result_read['jam_tayang']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputStudio" class="col-sm-2 col-form-label">Studio</label>
            <div class="col-sm-10">
              <input type="text" name="studio" class="form-control" id="inputStudio" value="<?=$result_read['studio']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputStudio" class="col-sm-2 col-form-label">Jumlah Kursi</label>
            <div class="col-sm-10">
              <input type="text" name="total_kursi" class="form-control" id="inputStudio" value="<?=$result_read['total_kursi']?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputHarga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
              <input type="text" name="harga" class="form-control" id="inputharga" value="<?=$result_read['harga']?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Simpan</button>
</form>

          </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>