<?php
require_once("auth.php");
require "konek.php";
$find= mysqli_select_db($mysqli, $database);

if(isset($_POST['search'])){
  if($_POST['kolom'] != "kosong"){
		$kolom=$_POST['kolom'];
		$cari=$_POST['cari'];

    if($_POST['kolom'] == "hari"){
      $day = strtolower($_POST['cari']);
      $dayList = array(
          'minggu' => 'Sunday',
          'senin' => 'Monday',
          'selasa' => 'Tuesday',
          'rabu' => 'Wednesday',
          'kamis' => 'Thursday',
          'jumat' => 'Friday',
          'sabtu' => 'Saturday'
        );
      $query = "SELECT * FROM jadwal INNER JOIN film USING (id_film) 
                WHERE DAYNAME(tanggal_tayang) LIKE '%$dayList[$day]%' 
                ORDER BY tanggal_tayang";
      $execute=mysqli_query($mysqli, $query);

    }else{
      $query = "SELECT * FROM jadwal INNER JOIN film USING (id_film) 
                WHERE $kolom LIKE '%$cari%' 
                ORDER BY tanggal_tayang";
      $execute=mysqli_query($mysqli, $query);

    }  
  }else{
    echo '<script>alert("Masukkan Pilihan Dulu")</script>';
    $query="SELECT * FROM jadwal INNER JOIN film USING (id_film) 
            ORDER BY tanggal_tayang";
    $execute = mysqli_query($mysqli, $query);
  }

}else{
  $query="SELECT * FROM jadwal INNER JOIN film USING (id_film) 
          ORDER BY tanggal_tayang";
  $execute = mysqli_query($mysqli, $query);
}

function hari($date){
  $day = date('D', strtotime($date));
  $dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
  );
 return $dayList[$day];
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Jadwal Tayang</title>
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
                  <a class="nav-link bg-primary text-light" href="lihat_jadwal.php">
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
              <h3 class="h5">Lihat Jadwal</h3>
            </div>

            <div>
              <h6 class="h6" style="margin-top:15px;">List Jadwal Tayang</h6>
            </div>

            <form method="post">
              <div class="row">
              <div class="col-md-3">
              <select type="text" name="kolom" class="form-select form-control" aria-label="Default select example">
                <option selected value="kosong">Cari Berdasarkan</option>
                <option value="judul">Judul</option>
                <option value="genre">Genre</option>
                <option value="hari">Hari Tayang</option>
              </select>
              </div>
              <div class="col-md-8">
              Masukkan Kata yang Anda Cari
              <input type ="text" type ="text" name="cari">
              <button type="submit" name="search" class="btn btn-primary" value="Cari">Cari</button>
              </div>
              </div>
            </form>


        <?php while($result = mysqli_fetch_assoc($execute)){ ?>

          <div class="card" style="max-width: 880px; margin-top:10px;">
          <div class="row g-0">
              <div class="col-md-4">
              <img src="image_film.php?IdFilm=<?php echo $result['id_film']; ?>" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
              <div class="card-body" style="margin-left:15px;">
                  <h3 class="card-title"><?= $result['judul']?></h3>
                  <div style="margin-right:20px;">
                  <table class="table">
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Hari, Tanggal Tayang</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= hari($result['tanggal_tayang'])?>, <?= date('d-m-Y', strtotime($result['tanggal_tayang'])) ?></p></td>
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
                          <td><p class="card-text"><small class="text-muted">Sisa Kursi</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result['sisa_kursi']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Harga</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result['harga']?></p></td>
                          <td></td>
                      </tr>
                  </table>
                  </div>
                  <a href="lihat_jadwal_detail.php?IdJadwal=<?= $result['id_jadwal']?>"><button type="button" class="btn btn-primary">Lihat Detail</button></a>
                  <a href="pesan_tiket.php?IdJadwal=<?= $result['id_jadwal']?>""><button type="button" class="btn btn-primary">Pesan</button></a>
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