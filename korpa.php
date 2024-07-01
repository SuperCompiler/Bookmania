<?php include 'session_checker.php' ?>
<?php include 'conn.php' ?>

<?php
$idKorisnik = $_SESSION['idKorisnik'];
$sql = "SELECT korpa.id,
               korpa.kolicina,
               knjiga.naslov,
               knjiga.cena,
               s_zanr.zanr,
               s_pisac.pisac


FROM korpa
LEFT JOIN knjiga on korpa.idKnjiga = knjiga.idKnjiga
LEFT JOIN s_zanr on knjiga.idZanr = s_zanr.id
LEFT JOIN s_pisac on knjiga.idPisac = s_pisac.id
WHERE idKorisnik = :idKorisnik";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->execute();
$stavkeIzKorpe = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja Korpa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body{
        background-image: url("kupovina1.jpg");
    }
</style>
<body class="bg-dark">
    <div class="container">
        <a href="korisnik1.php" class="btn btn-sm btn-info mt-5">Nazad</a>
        <table border="1" class="table table-hover table-dark">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Zanr</th>
                    <th>Pisac</th>
                    <th>Kolicina</th>
                    <th>Cena</th>
                    <th>Racun</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $suma = 0;
                foreach ($stavkeIzKorpe as $stavka) { ?>
                    <?php $racun = $stavka['kolicina'] * $stavka['cena'] ?>
                    <?php $suma += $racun ?>

                    <tr>
                        <form action="upd_korpa.php" method="POST">  <!--upd_korpa.php-->
                            <input type="text" hidden name="id" value="<?php echo $stavka['id'] ?>">
                            <td><?php echo $stavka['naslov'] ?></td>
                            <td><?php echo $stavka['zanr'] ?></td>
                            <td><?php echo $stavka['pisac'] ?></td>
                            <td><input type="number" name="kolicina" value="<?php echo $stavka['kolicina'] ?>" min="1" max="299"></td>
                            <td><?php echo $stavka['cena'] ?> RSD</td>
                            <td><?php echo $racun ?> RSD</td>
                            <td><input type="submit" value="Izmeni kolicinu"></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="obrisi_iz_korpe.php?id=<?php echo $stavka['id'] ?>">Obriši</a> <!--obrisi_iz_korpe.php-->
                            </td>
                        </form>

                    </tr>
                <?php } ?>
                <tr class="table-active">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $suma ?> RSD</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>