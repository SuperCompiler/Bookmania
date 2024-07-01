<?php include 'session_checker.php'; ?>
<?php include 'conn.php'; ?>
<?php

$idKorisnik = $_SESSION['idKorisnik'];

$sql = "SELECT knjiga.naslov, knjiga.cena, knjiga.idKnjiga,
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

$poruka = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "uspesno") {
        $poruka = "Uspesno ste dodali knjigu u korpu!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Ulogovali ste se kao korisnik sistema.
    <span style="position: absolute; top:0; right:0">
        <a href="logOut.php">Log out</a>
    </span>

    <div>
        <div style="display: flex; justify-content: end;">
            <span><a href="korpa.php">Moja korpa</a> <span style="background-color: blue; color: white;"><?php echo $brojStavkiUMojojKorpi; ?></span></span>
        </div>
        <h2>Dostupne knjige</h2>
        <h2 style="color:green"><?php echo $poruka ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Zanr</th>
                    <th>Pisac</th>
                    <th>Cena/RSD</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
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
                        <tr>
                            <td><?php echo $knjiga['naslov'] ?></td>
                            <td><?php echo $knjiga['zanr'] ?></td>
                            <td><?php echo $knjiga['pisac'] ?></td>
                            <td><?php echo $knjiga['cena'] ?></td>
                            <td>
                                <form action="ins_korpa.php" method="post">
                                    <input type="text" hidden name="idKorisnik" value="<?php echo $idKorisnik ?>">
                                    <input type="text" hidden name="idKnjiga" value="<?php echo $knjiga['idKnjiga'] ?>">
                                    <input type="number" placeholder="Kolicina" name="kolicina">  <!--bio je period a ne kolicina -->
                                    <input type="submit" value="Dodaj">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>