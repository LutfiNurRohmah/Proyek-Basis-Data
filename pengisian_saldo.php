<?php
require "konek.php";
require_once("auth.php");
$find= mysqli_select_db($mysqli, $database);
$id_user = $_SESSION["user"]['id_user'];
$query = "SELECT saldo FROM user WHERE id_user='$id_user'";
$saldo = mysqli_fetch_assoc(mysqli_query($mysqli, $query));
$query2="SELECT * FROM pengisian_saldo WHERE id_user='$id_user'";
$execute2 = mysqli_query($mysqli, $query2);

if(isset($_POST['tombol']))
{
    if(!isset($_FILES['bukti_transaksi']['tmp_name'])){
      echo '<script>alert("Pilih File Gambar")</script>';
    }
    else
    {
        $file_name = $_FILES['bukti_transaksi']['name'];
        $file_size = $_FILES['bukti_transaksi']['size'];
        $file_type = $_FILES['bukti_transaksi']['type'];
        if ($file_size < 4096000 and ($file_type =='image/jpeg' or $file_type == 'image/png'))
        {
            $image   = addslashes(file_get_contents($_FILES['bukti_transaksi']['tmp_name']));
            $jumlah_isi = @$_POST["jumlah_isi"];

            $query="INSERT INTO pengisian_saldo (id_user, jumlah_isi, bukti_transaksi) VALUES('$id_user','$jumlah_isi','$image')";
            $simpan= mysqli_query($mysqli, $query);

            if($simpan){
              header("Location:pengisian_saldo.php");
            }else{
              echo '<script>alert("Data gagal disimpan")</script>';}
        }
        else
        {
          echo '<script>alert("Ukuran atau tipe file tidak sesuai")</script>';
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengisian Saldo</title>
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
                  <a class="nav-link bg-primary text-light" href="pengisian_saldo.php">
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
              <h3 class="h5">Pengisian Saldo</h3>
            </div>
      
        <div class="col-sm-6">
          <div class="card w-75">
            <div class="card-body">
              <h5 class="card-title">Total Saldo</h5>
              <h2><?php echo $saldo['saldo'] ?></h2>
            </div>
          </div>
        </div>
        
        <form method=post action="" enctype="multipart/form-data">
          <div class="card" style="margin-top:40px;">
            <div class="card-body">
              <h5 align=center class="card-title">Isi Saldo</h5>
              <h6>Transfer saldo ke rekening berikut ini:</h6>
              <p>0057756745276 - BRI</p>
                  <div class="row mb-3">
                      <label for="inputDurasi" class="col-sm-2 col-form-label">Jumlah</label>
                      <div class="col-sm-10">
                        <input type="text" name="jumlah_isi" class="form-control" id="inputDurasi" placeholder="">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <label for="inputGroupFile" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                      <div class="col-sm-10">
                        <input type="file" name="bukti_transaksi" class="form-control" id="inputGroupFile02">
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="tombol">Kirim</button>
            </div>
          </div>
              </form>
            


      <div class="border-top" style="margin-top:40px;">
      <h6 class="h6" style="margin-top:15px;">List Pengisian Saldo</h6>
      </div>

      <table class="table table-bordered">
        <thead class="table-primary">
				 <td align=center>Id Isi Saldo</td>
				 <td align=center>Id User</td>
				 <td align=center>Jumlah Isi</td>
				 <td align=center>Waktu Transaksi</td>
         <td align=center>Status</td>
         <td align=center>Pilihan Menu</td>
				</thead>
				<?php while($result = mysqli_fetch_assoc($execute2)){ ?>
				<tr border=1>
				 <td><?= $result['id_isisaldo']?></td>
				 <td><?= $result['id_user']?></td>
				 <td><?= $result['jumlah_isi']?></td>
				 <td><?= $result['waktu_transaksi']?></td>
				 <td><?= $result['status']?></td>
         <td  align=center>
          <a href="deleteIsiSaldo.php?IdIsiSaldo=<?= $result['id_isisaldo']?>"><button type="button" class="btn btn-primary">Hapus</button></a>
				 </td>
				</tr>
				<?php }?>
        </table>
          </main>
        </div>
    </div>

      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>