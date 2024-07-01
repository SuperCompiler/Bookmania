<?php include 'session_checker.php'; ?>
<?php include 'conn.php'; ?>
<?php

$idKorisnik = $_SESSION['idKorisnik'];

$sql = "SELECT knjiga.naslov, knjiga.cena, knjiga.idKnjiga, knjiga.slika,
s_zanr.zanr,
s_pisac.pisac
FROM knjiga 
LEFT JOIN s_zanr on knjiga.idZanr = s_zanr.id
LEFT JOIN s_pisac on knjiga.idPisac = s_pisac.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$knjige = $stmt->fetchAll();


$sql = "SELECT idKnjiga
FROM korpa 
WHERE idKorisnik = :idKorisnik";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->execute();
$mojaKorpa = $stmt->fetchAll();

$brojStavkiUMojojKorpi = count($mojaKorpa);

$poruka = "";                                           //---PORUKA!!!
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "uspesno") {
        $poruka = "Uspesno ste dodali knjigu u korpu!"  ;
    }
}

?>

<!-- --------------------------------------------------------------------------------------------- -->
<html>
    <head>
        <title> Zdravo Bookmania KORISNIK!</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="styleKorisnik.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            .material-symbols-outlined {
              font-variation-settings:
              'FILL' 0,
              'wght' 400,
              'GRAD' 0,
              'opsz' 24
            }
        </style>
    </head>
    <style>
    body{
        background-image: url("oNama.jpg");
    }
    </style>
    <body class="bg-dark">

        <div class="container">
            <nav class="navbar navbar-expand-lg text-white"> <!--bg-body-tertiary-->
                <div class="container-fluid">
                    <a class="navbar-brand text-info" href="#">Bookmania</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="oNama.php">O nama</a>
                        </li>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <li class="nav-item mt-2">
                            <a style="padding  : .25rem .4rem; font-size  : .875rem; line-height  : .7; border-radius : .2rem;" href="korpa.php" class="nav-item btn-sm btn btn-secondary text-info">
                                <?php echo $brojStavkiUMojojKorpi; ?>
                                <i class="bi bi-cart"></i>
                                <span class="material-symbols-outlined">
                                    shopping_cart
                                </span>
                            </a>  
                        </li>
                        <li>
                        <span style="position: absolute; top: 10px; right:23px; " class="btn btn-info btn-sm mt-2">
                            <a href="logOut.php" style="text-decoration: none; color: #fff">Log out</a>
                        </span>
                        </li>
                    </ul>
                    
                    </div>
                </div>
            </nav>
<!-- -----------------------------netrebuje  ---------------------------------- -->
 
<!-- -----------------------------netrebuje  ---------------------------------- -->
            <h2 class="text-info text-center mb-5">Dostupne knjige</h2>                   
            <div>
                <span class="text-sm-start text-success"><?php echo $poruka ?></span>      <!--PORUKA POTVRDE---> 
            </div>
            <?php foreach ($knjige as $knjiga) { ?>
                <?php $uKorpi = 0; ?>
                <!-- pretpostavljamo da knjiga nije u korpi -->
                <?php foreach ($mojaKorpa as $stavka) { ?>
                    <?php if ($knjiga['idKnjiga'] == $stavka['idKnjiga']) {
                        $uKorpi = 1;
                        break;
                        // ako se podudara idKnjiga sa idKnjiga u bazi onda varijablu 
                        // za kontrolu setujemo na 1 i u tom slucaju ne ispisujemo knjigu na ekran
                    } ?>
                <?php } ?>
                <!-- ukoliko je uslov ispunjen onda ispisujemo ponudu knjiga dostupnu za bukiranje -->
                <?php if ($uKorpi == 0) {    ?>
                    <div class="card bg-dark" style="width: 200px; display: inline-block; padding-bottom: 1px; margin-bottom: 10px; margin-right: 10px">
                        <div class="card-body">
                        <div class="card-header" style="height: 77px">
                            <p style="text-align: center font-size: 20px; font-weight: bold; color: #fff;"><?php echo $knjiga['naslov'] ?></p>
                        </div>
                        <img src="slike/knjige/<?php echo $knjiga['slika']?>" alt="Neka slika knjige" class="card-img-top"> <!-- - - - PRIZNANJE za proboj fronta - - -->
                        <div class="card-title text-white">
                            <h6><?php echo $knjiga['pisac'] ?></h6>
                        </div>
                        <div class="card-text text-white"><?php echo $knjiga['zanr'] ?></div><br>
                        <div class="card-subtitle" style=" color: #fff;font-size: large;font-weight: bold;"><?php echo $knjiga['cena'] ?> RSD</div>
                    </div>
                    <div class="btn">
                        <form action="ins_korpa.php" method="post">
                            <input type="text" hidden name="idKorisnik" value="<?php echo $idKorisnik ?>">
                            <input type="text" hidden name="idKnjiga" value="<?php echo $knjiga['idKnjiga'] ?>">
                            <input style="width:30px; height:25px;" type="number" placeholder="Kolicina" name="kolicina" min="1" value="1">  <!--bio je period a ne kolicina -->
                            <button  type="submit" class="btn btn-info" value="Dodaj">
                                Dodaj u korpu
                            </button>
                        </form>
                    </div>     
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
