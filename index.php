<?php 
require "konek.php";
$find= mysqli_select_db($mysqli, $database);

$query="SELECT * FROM film WHERE id_film NOT IN (SELECT id_film FROM jadwal)";
$execute = mysqli_query($mysqli, $query);

$bulanini = date('m');
$query2="SELECT * FROM film WHERE id_film IN (SELECT id_film FROM jadwal WHERE MONTH(tanggal_tayang) LIKE '$bulanini')";
$execute2 = mysqli_query($mysqli, $query2);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OurCinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
  <body>
    <header class="p-3 text-bg-primary">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><h1 class="h4 fw-normal">OurCinema</h1></li>
            </ul>
    
            <div class="text-end">
              <a href="halaman_login.php"><button type="button" class="btn btn-primary">Login</button></a>
              <a href="daftar.php"><button type="button" class="btn btn-outline-light me-2">Daftar</button></a>
            </div>
          </div>
        </div>
      </header>
      <main>
        <div style="margin:30px 50px;">
      <div class="card" style="margin-top:20px;">
              <div class="card-body">
                <h1 class="text-primary" align="center">Welcome to OurCinema</h1>
              </div>
            </div>
            <div class="card" style="margin-top:20px;">
              <div class="card-body">
                <h5 class="card-title">Tayang Segera</h5>
                <div class="container px-4 text-center">
                  <div class="row gy-5">
                    <?php while($result = mysqli_fetch_assoc($execute)){ ?>
                      <div class="col-2">
                        <div class="p-3">
                          <img src="image_film.php?IdFilm=<?php echo $result['id_film']; ?>" class="img-fluid rounded-start" alt="...">
                          <p class="card-text"><small class="text-muted"><?php echo $result['judul']?></small></p>
                        </div>
                      </div>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card" style="margin-top:20px;">
              <div class="card-body">
                <h5 class="card-title">Tayang Bulan Ini</h5>
                <div class="container px-4 text-center">
                  <div class="row gy-5">
                    <?php while($result2 = mysqli_fetch_assoc($execute2)){ ?>
                      <div class="col-2">
                        <div class="p-3">
                          <img src="image_film.php?IdFilm=<?php echo $result2['id_film']; ?>" class="img-fluid rounded-start" alt="...">
                          <p class="card-text"><small class="text-muted"><?php echo $result2['judul']?></small></p>
                        </div>
                      </div>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
    
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
  </body>
</html>