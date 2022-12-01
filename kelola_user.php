<?php
require "konek.php";
$find= mysqli_select_db($mysqli, $database);
$query="SELECT * FROM user";
$query2="SELECT * FROM pengisian_saldo";
$execute = mysqli_query($mysqli, $query);
$execute2 = mysqli_query($mysqli, $query2);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
  <body>
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">OurCinema</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">Admin</a>
          </div>
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
                <li class="nav-item">
                  <a class="nav-link" href="index.php">
                    <span data-feather="layers" class="align-text-bottom"></span>
                    Logout
                  </a>
                </li>
              </ul>
      
            </div>
          </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h3 class="h5">Kelola User</h3>
            </div>

            
              <h6 class="h6">List User</h6>

      <table class="table table-bordered">
				<thead class="table-primary">
				 <td align=center>Id User</td>
				 <td align=center>Nama Lengkap</td>
				 <td align=center>Email</td>
				 <td align=center>Nomor HP</td>
         <td align=center>Saldo</td>
         <td align=center>Pilihan Menu</td>
				</thead>
				<?php while($result = mysqli_fetch_assoc($execute)){ ?>
				<tr>
				 <td><?= $result['id_user']?></td>
				 <td><?= $result['nama_lengkap']?></td>
				 <td><?= $result['email']?></td>
				 <td><?= $result['nomor_hp']?></td>
				 <td><?= $result['saldo']?></td>
         <td align=center>
            <a href="detail_user.php?Nama=<?= $result[0]?>""><button type="button" class="btn btn-primary">Lihat Detail</button></a>
            <a href="deleteUser.php?IdUser=<?= $result['id_user']?>"><button type="button" class="btn btn-primary">Hapus</button></a>
				 </td>
				</tr>
				<?php }?>
			</table>

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
          <a href="konfim_saldo.php?Nama=<?= $result[0]?>""><button type="button" class="btn btn-primary">Konfirmasi</button></a>
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