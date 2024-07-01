<?php include 'session_checker.php'; ?>
<?php include 'conn.php'; ?>
<?php

$idKnjiga = $_GET['idKnjiga'];

$sql = "SELECT *
        FROM knjiga
        WHERE idKnjiga = :idKnjiga";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKnjiga', $idKnjiga);
$stmt->execute();

$knjigaZaAzuriranje = $stmt->fetch(PDO::FETCH_ASSOC);
// izvlacimo podatke iz tabele knjiga za prosledjeni idKnjigaa

$upit = $pdo->prepare("SELECT * FROM s_zanr");
// Vezivanje parametara
$upit->execute();
$zanrovi = $upit->fetchAll(PDO::FETCH_ASSOC);


$upit = $pdo->prepare("SELECT * FROM s_pisac");
// Vezivanje parametara
$upit->execute();
$pisci = $upit->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        background-image: url("azuriraj.jpg");
    }
</style>
<body class="bg-dark">
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
                    <p class="text-warning">Azuriranje</p>
                </li>
            </ul>
            </div>
        </div>
    </nav><br>  
    <div class="container">
        <h1 class="text-center text-white mb-5">Azuriraj knjigu</h1>
        <form action="updt_knjiga.php" method="POST"  class="form-line text-center">
            <div class="text-white">
                <label for="naslov" class="form-label">Naslov</label>
                <!-- kreiramo skriveno polje u koje smestamo idKnjigaa koje treba azurirati -->
                <!-- treba nam kako bismo znali koji knjiga updatujemo u bazi podataka -->
                <input type="text" name="idKnjiga" hidden value="<?php echo $idKnjiga ?>">
                <input id="naslov" type="text" name="naslov" value="<?php echo $knjigaZaAzuriranje['naslov'] ?>" class="form-control">
            </div>
            <div class="text-white">
                <label for="zanr" class="form-label">zanr</label>
                <select name="zanr" id="zanr" class="form-select">
                    <?php foreach ($zanrovi as $row) {
                        $selected = "";
                        if ($row['id'] == $knjigaZaAzuriranje['idZanr']) {
                            $selected = "selected";
                        }

                    ?>
                        <option <?php echo $selected ?> value="<?php echo $row['id'] ?>"><?php echo $row['zanr'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="text-white">
                <label for="pisac" class="form-label">Pisac</label>
                <select name="pisac" id="pisac" class="form-select">
                    <!-- uzimamo prvi red, i u foreach petlji ga nazivamo $row (ili bilo kako drugacije), i tretiramo ga kao red iz niza -->
                    <?php foreach ($pisci as $row) {
                        $selected = "";
                        if ($row['id'] == $knjigaZaAzuriranje['idPisac']) {
                            $selected = "selected";
                        }
                    ?>
                        <option <?php echo $selected ?> value="<?php echo $row['id'] ?>"><?php echo $row['pisac'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="text-white">
                <label for="cena" class="form-label">Cena</label>
                <input id="cena" type="text" name="cena" value="<?php echo $knjigaZaAzuriranje['cena'] ?>" class="form-control">
            </div>
            <div class="text-white">
                <label for="slika" class="form-label">Slika</label>
                <input id="slika" type="text" name="slika" value="<?php echo $knjigaZaAzuriranje['slika'] ?>" class="form-control">
            </div class="text-white">
            <div class="text-white">
                <input type="submit" value="Snimi"  class="text-white btn btn-primary btn-lg mt-5">
            </div>
        </form>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>                   
</body>

</html>