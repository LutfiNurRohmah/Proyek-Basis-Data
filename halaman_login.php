<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body class="text-center">
    
    <main class="form-signin w-100 m-auto">
        <form style="margin-top: 100px;" method="post" action="login.php">
          <!--<img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
          <h1 class="h3 mb-3 fw-normal">Login</h1>
          <div style="margin-top: 30px; margin-left: 450px; margin-right: 450px;">
          <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <hr>
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Masuk</button>
          <p class="mb-3 fw-normal">Belum punya akun? <a href="daftar.php">Daftar</a></p>
          </div>
        </form>
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>