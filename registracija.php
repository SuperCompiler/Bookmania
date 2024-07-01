<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
</head>
<style>
    body{
        background-image: url("bg1.jpg");
    }
</style>
<body>
    <div class="container-fluid">
        <form class="mx-auto text-white" action="ins_registracija.php" method="POST" style=" background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
                                                                                  backdrop-filter:  blur(7px);
                                                                                  -webkit-backdrop-filter: blur(10px);
                                                                                  border-radius: 20px;
                                                                                  border: 1px solid rgba(255, 255, 255, 0.18);

                                                                                  box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
            <h4 class="text-center">Register</h4>
            <div class="mb-3 mt-5">
              <label for="exampleInputEmail1" class="form-label" >Ime i prezime</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="imePrezime" id="imePrezime">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label" >Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" id="username">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Sifra</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" id="password"> <!-- dva id ima ovde! -->
            </div>
            
            <button type="submit" class="btn btn-primary mt-4" value="ok">Register</button>
            <a href="index.php" class="link-opacity-50 mt-4">Login</a>
          </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>