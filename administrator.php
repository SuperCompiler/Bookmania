<?php include 'session_checker.php'; ?>
<?php include 'conn.php'; ?>
<?php
// var_dump($_SESSION);

$user = $_SESSION['imePrezime'];
$idKorisnik = $_SESSION['idKorisnik']; //id ulogovanog korisnika

$sql = "SELECT * FROM korisnik WHERE idKorisnik != :idKorisnik";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->execute();
$korisnici = $stmt->fetchAll(); // uzeli smo rezultat iz baze . on je u obliku asocijativnog niza.

// [0,1,2,3] 0 je knjiga, 1 je s_tip itd...

// nakon kreiranja tabele knjiga i sifarnickih tabela za tip i proizvodjaca,
// vrsimo upit i preuzimamo sve automobile iz baze
// upit vrsimo tako sto radimo spajanje tabela sa left join, i na mesta u tabeli automobili gde su idjevi iz sifarnickih tabela upisujemo polja iz istih
$sql = "SELECT knjiga.naslov, knjiga.cena, knjiga.idKnjiga, knjiga.slika,
                s_pisac.pisac,
                s_zanr.zanr
        FROM knjiga 
        LEFT JOIN s_pisac on knjiga.idPisac = s_pisac.id
        LEFT JOIN s_zanr on knjiga.idZanr = s_zanr.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$knjige = $stmt->fetchAll(); // uzeli smo rezultat iz baze . on je u obliku asocijativnog niza.
// knjige kasnije izlistavamo kroz tabelu pomocu #foreach
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<style>
    body {
        background-image: url("admin.jpg");
    }
</style>
<body class="bg-dark">
    <div style=" margin-bottom: 30px; padding:10px" class="nav">
        <span style="color: #fff;">Dobro dosli nazad admine.</span>
        <span style="position: absolute; top: 10px; right:10px; color:#fff;">
            <span><?php echo $user ?></span>
            <a class="btn btn-sm btn-warning" href="logOut.php">Log out</a>
        </span>
    </div>
    <div class="container">
        <!-- key index u nizu -->

        <?php foreach ($korisnici as $key => $korisnik) {
            $key++;
            // $key pocinje sa 0 da bismo ispisali redni broj od 1 pa nadalje radimo inkrementaciju
        ?>
        <div style="margin-top: 5px; width: 700px;" class="card">
            <div style=" width:590px; height:30px; display: inline-block; color: #fff;" class="card bg-dark">
                <?php echo $key ?>.
                Ime i prezime: <?php echo $korisnik['imePrezime'] ?>
                Username: <?php echo $korisnik['username'] ?>
                
            </div>
            <div style="position: absolute; top:0; right:0;">
                <?php if ($korisnik['aktivan'] == 1) { ?>
                    <!-- Za deaktivaciju, šaljemo status=0 -->
                    <a class="btn btn-primary btn-sm" href="aktivacija.php?status=0&idKorisnik=<?php echo $korisnik['idKorisnik'] ?>">Deaktiviraj</a>
                <?php } ?>
                <?php if ($korisnik['aktivan'] == 0) { ?>
                    <!-- Za aktivaciju, šaljemo status=1 -->
                    <a class="btn btn-primary btn-sm"  href="aktivacija.php?status=1&idKorisnik=<?php echo $korisnik['idKorisnik'] ?>">Aktiviraj</a>
                <?php } ?> &nbsp;
            </div>
        </div>
        <?php } ?>

    </div>
    <div class="container mb-3">
        <div>
            <h1>Knjige</h1>
            <div><a href="dodaj_knjigu.php" class="btn btn-primary">Dodaj knjigu</a></div> 
        <!-- takodje dodajemo link ka strani za dodavanje novih automobila -->
        </div>
    </div>
    <div class="container">
        <table border="1" class="table table-hover table-sm table-dark">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Zanr</th>
                    <th>Pisac</th>
                    <th>Cena</th>
                    <th>Slika - url</th>
                    <th>Opcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($knjige as $knjiga) { ?>
                    <tr>
                        <td><?php echo $knjiga['naslov'] ?></td>
                        <td><?php echo $knjiga['zanr'] ?></td>
                        <td><?php echo $knjiga['pisac'] ?></td>
                        <td><?php echo $knjiga['cena'] ?> RSD</td>
                        <td><?php echo $knjiga['slika']?></td>
                        <td>
                            <div>
                                <a style="padding  : .25rem .4rem; font-size  : .875rem; line-height  : .7; border-radius : .2rem;" class="btn btn-sm btn-light" href="azuriraj.php?idKnjiga=<?php echo $knjiga['idKnjiga'] ?>">Azuriraj </a>
                            </div>
                            <div>
                                <a style="padding  : .25rem .4rem; font-size  : .875rem; line-height  : .7; border-radius : .2rem;" class="btn btn-sm btn-danger" href="obrisi.php?idKnjiga=<?php echo $knjiga['idKnjiga'] ?>">Obriši </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="container"> <br>
        <div>
            <span style="color:#fff" >Da biste pregledali trenutno korisnicko iskustvo kliknite na dugme &nbsp </span>
            <a href="korisnik1.php" type="button" class="btn btn-primary">Korisnicko iskustvo</a>
        </div>
    </div> <br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>