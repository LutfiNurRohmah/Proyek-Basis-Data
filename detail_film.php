<?php
include('konek.php');
$id_film=$_GET['IdFilm'];
$query = mysqli_query($mysqli,"SELECT * FROM film WHERE id_film='$id_film'");
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
              <h3 class="h5">Kelola Film - Detail Film</h3>
            </div>

            <table class="table table-bordered" style="margin-bottom:40px;">
				<thead class="table-primary">
				 <td align=center>Id Film</td>
                 <td align=center>Gambar</td>
				 <td align=center>Judul</td>
				 <td align=center>Genre</td>
				 <td align=center>Durasi</td>
                 <td align=center>Sinopsis</td>
                 <td align=center>Tanggal Rilis</td>
                 <td align=center>Produser</td>
                 <td align=center>Penulis</td>
                 <td align=center>Sutradara</td>
                 <td align=center>Produksi</td>
                 <td align=center>Pilihan Menu</td>
				</thead>
				<?php while($result = mysqli_fetch_assoc($query)){ ?>
				<tr>
				 <td><?= $result['id_film']?></td>
                 <td><img src="image_film.php?IdFilm=<?php echo $result['id_film']; ?>" width="100"/></td>
				 <td><?= $result['judul']?></td>
				 <td><?= $result['genre']?></td>
				 <td><?= $result['durasi']?></td>
                 <td><?= $result['sinopsis']?></td>
				 <td><?= $result['tanggal_rilis']?></td>
                 <td><?= $result['produser']?></td>
                 <td><?= $result['penulis']?></td>
                 <td><?= $result['sutradara']?></td>
                 <td><?= $result['produksi']?></td>
         <td align=center>
            <a href="update.php?Nama=<?= $result[0]?>"><button type="button" class="btn btn-primary">Edit</button></a>
            <a href="deleteFilm.php?IdFilm=<?= $result['id_film']?>"><button type="button" class="btn btn-primary">Hapus</button></a>
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