<?php
include 'conn.php';

$idKnjiga = $_POST["idKnjiga"];
$naslov = $_POST["naslov"];
$idZanr = $_POST["zanr"];
$idPisac = $_POST["pisac"];
$cena = $_POST["cena"];
$slika = $_POST["slika"];


// Priprema SQL upita sa placeholder-ima
$sql = "UPDATE `knjiga` SET `idZanr` = :idZanr, `idPisac` = :idPisac, `naslov` = :naslov,  `slika` = :slika, `cena` = :cena 
        WHERE `idKnjiga` = :idKnjiga";

$stmt = $pdo->prepare($sql);

// Povezivanje parametara
$stmt->bindParam(':idZanr', $idZanr);
$stmt->bindParam(':idPisac', $idPisac);
$stmt->bindParam(':naslov', $naslov);
$stmt->bindParam(':cena', $cena);
$stmt->bindParam(':idKnjiga', $idKnjiga);
$stmt->bindParam(':slika', $slika);

// Izvršavanje naredbe
$stmt->execute();

header("Location:administrator.php");
