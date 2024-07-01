<?php include 'session_checker.php'; ?>
<?php include 'conn.php'; ?>
<?php


// prvo uzimamo podatke iz baze koji se ticu sifarnickih tabela
$upit = $pdo->prepare("SELECT * FROM s_zanr");
// Vezivanje parametara
$upit->execute();
$zanrovi = $upit->fetchAll(PDO::FETCH_ASSOC);


$upit = $pdo->prepare("SELECT * FROM s_pisac");
// Vezivanje parametara
$upit->execute();
$pisci = $upit->fetchAll(PDO::FETCH_ASSOC);

// $upit = $pdo->prepare("SELECT * FROM slike");     OVO MI NE TREBA ZATO STO TEK TREBA DA UPISEM U BIBLIOTEKU A NE DA CITAM!
// //Vezivanje parametara slike
// $upit->execute();
// $slike = $upit->fetchAll(PDO::FETCH_ASSOC);


// kasnije ih izlistavamo u formi u okviru select polja (kao opcione :} )

?>



<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodavanje knjige</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        background-image: url("azuriraj.jpg");
    }
</style>
<body class="bg-dark ">

    <nav class="navbar navbar-expand-lg text-white"> 
        <div class="container-fluid">
            <a class="navbar-brand text-info" href="#">Bookmania</a>
           
            <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="btn btn-sm btn-warning text-dark mt-2">
                    <a class="nav-link active" aria-current="page" href="administrator.php">Nazad</a>
                </li>
            </ul>
            <ul>
                <li>
                    <p class="text-warning">Unos nove knjige</p>
                </li>
            </ul>
            </div>
        </div>
    </nav><br>

    <div class="container">
        <h1 class="text-center text-white">Dodaj Knjigu</h1>
        <form action="ins_knjiga.php" method="POST" class="form-line text-center">
            <div class="text-white">
                <label for="naslov" class="form-label mt-5">Naslov</label>
                <input id="naslov" type="text" name="naslov" class="form-control" placeholder="Upisite naslov knjige">
            </div>
            <div class="text-white">
                <label for="zanr" class="form-label">Zanr</label>
                <select name="zanr" id="zanr" class="form-select">
                    <?php foreach ($zanrovi as $row) { ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['zanr'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="text-white">
                <label for="pisac" class="form-label">Pisac</label>
                <select name="pisac" id="pisac" class="form-select">
                    <!-- uzimamo prvi red, i u foreach petlji ga nazivamo $row (ili bilo kako drugacije), i tretiramo ga kao red iz niza -->
                    <?php foreach ($pisci as $row) { ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['pisac'] ?></option>
                    <?php } ?>
                </select>
            </div>
<!--     ------------------------DODAVANJE SLIKE_____________--------___________-----__________------_______----___ -->
            <div class="text-white">
                <label for="slika" class="form-label">Slika</label>
                <input id="slika" type="text" name="slika" class="form-control" placeholder="Upisite adresu slike (putanja unutar fajla slike)">
            </div>
<!--     ------------------------DODAVANJE SLIKE_____________--------___________-----__________------_______----___ -->
            <div class="text-white">
                <label for="cena" class="form-label">Cena</label>
                <input id="cena" type="text" name="cena" class="form-control" placeholder="Upisite cenu">
            </div>
            <div class="text-white">
                <input type="submit" value="Dodaj" class="text-white btn btn-primary btn-lg mt-5">
            </div>
        </form>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>