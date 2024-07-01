<?php 
    $poruka = "";
    if(isset($_GET['registracija'])){
        if($_GET['registracija'] == 1){
             $poruka = "Vas nalog je registrovan, čeka se potvrda administratora!";
        }
    }

    $greska = "";
    if (isset($_GET['error'])){
        if ($_GET['error'] == 1){
            $greska = "Niste uneli parametre";
        }
        if ($_GET['error'] == 2){
            $greska = "Pogresna sifra ili nepostojeci korisnik";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
</head>

<style>
    body {
        background-image: url("bg3.jpg");
    }
</style>


<body>
    <nav class="navbar navbar-expand-lg text-white"> 
        <div class="container-fluid">
            <a class="navbar-brand text-info" href="#">Bookmania</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="oNama.php">O nama</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> <br>   

    <div class="container-fluid">

        <h1 class="text-center text-white"><b>Bookmanija je Prozor u svet</b></h1><br>
        
        <form class="mx-auto mt-0 text-white" action="check_user.php" method="POST" style=" background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
                                                                                            backdrop-filter:  blur(7px);
                                                                                            -webkit-backdrop-filter: blur(10px);
                                                                                            border-radius: 20px;
                                                                                            border: 1px solid rgba(255, 255, 255, 0.18);

                                                                                            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;" >
            <span><?php echo "<font color=\"green\"> ", $poruka ," </font><br>" ?></span>  <!--poruka-->
            
            <h4 class="text-center">Login</h4>
            
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label" >Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" id="username">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Sifra</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" id="password"> 
            </div>

            <p><?php echo "<font color=\"red\"> ", $greska ," </font><br>" ?></p>  <!--greska-->
            
            <button type="submit" class="btn btn-primary mt-4" value="ok">Login</button>
            <a href="registracija.php" class="link-opacity-50 mt-4">Register</a>
          </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

