<?php
require_once("auth.php");
require "konek.php";
$find= mysqli_select_db($mysqli, $database);

$id_user = $_SESSION["user"]['id_user'];
$query = "SELECT nama_lengkap, saldo FROM user WHERE id_user='$id_user'";
$execute = mysqli_query($mysqli, $query);
$result = mysqli_fetch_assoc($execute);

$id_jadwal=$_GET['IdJadwal'];
$query2="SELECT * FROM jadwal INNER JOIN film USING (id_film) WHERE id_jadwal='$id_jadwal'";
$execute2 = mysqli_query($mysqli, $query2);
$result2 = mysqli_fetch_assoc($execute2);

if(isset($_POST['pesan'])){
  if($result2['sisa_kursi'] != 0){
    if($result['saldo'] >= $result2['harga']){
      $sisa_saldo = $result['saldo'] - $result2['harga'];
      $sisa_kursi = $result2['sisa_kursi'] - 1;

      $update_saldo = "UPDATE user SET saldo='$sisa_saldo' WHERE id_user='$id_user'";
      $update_kursi = "UPDATE jadwal SET sisa_kursi='$sisa_kursi' WHERE id_jadwal='$id_jadwal'";
      $tambahtransaksi = "INSERT INTO transaksi_tiket (id_user, id_jadwal) VALUES ('$id_user', '$id_jadwal')";

      $execute3 = mysqli_query($mysqli, $tambahtransaksi);
      $execute4 = mysqli_query($mysqli, $update_saldo);
      $execute5 = mysqli_query($mysqli, $update_kursi);

      if($execute3 AND $execute4 AND $execute5){
        header('Location:riwayat_transaksi.php');
      }else{
        echo '<script>alert("Gagal update data")</script>';
      }
    }else{
      echo '<script>alert("Saldo tidak mencukupi")</script>';
    }
  }else{
    echo '<script>alert("Mohon maaf, tiket habis")</script>';
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesan Tiket Film</title>
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
              <h3 class="h5">Pesan Tiket</h3>
            </div>

          <div class="row">
          <div class="col-sm-6">
          <div class="card g-0">
              <div class="card-body" style="margin-left:15px;">
                  <h5 class="card-title"><?= $result2['judul']?></h5>
                  <div style="margin-right:15px;">
                  <table class="table">
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Id - Nama User</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $id_user?> - <?= $result['nama_lengkap']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Id Film</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result2['id_film']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Tanggal Tayang</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result2['tanggal_tayang']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Jam Tayang</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result2['jam_tayang']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Durasi</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result2['durasi']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Studio</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result2['studio']?></p></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td><p class="card-text"><small class="text-muted">Harga</small></p></td>
                          <td><p class="card-text"><small class="text-muted">:</small></p></td>
                          <td><p class="card-text"><?= $result2['harga']?></p></td>
                          <td></td>
                      </tr>
                  </table>
                  </div>
              </div>
              </div>

          </div>
          <div class="col-sm-4">
          <div class="card g-0">
              <div class="card-body" style="margin-left:15px; margin-right:15px;">
                  <h5 class="card-title">Saldo Saat Ini:</h5>
                  <h2 class="border-bottom"><?php echo $result["saldo"] ?></h2>
                  <div style="margin-top:20px;">
                  <form method="post">
                  <button type="submit" name="pesan" class="btn btn-primary">Pesan</button>
                  <a href="pengisian_saldo.php"><button type="button" class="btn btn-primary">Isi Saldo</button></a>
                  </form>  
                </div>
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