<?php
include 'conn.php';

$naslov = $_POST["naslov"];
$idZanr = $_POST["zanr"];
$idPisac = $_POST["pisac"];
$cena = $_POST["cena"];
$slika = $_POST["slika"];


// Priprema SQL upita sa placeholder-ima
$sql = "INSERT INTO knjiga (idZanr, idPisac, naslov, cena, slika) 
                    VALUES (:idZanr, :idPisac, :naslov, :cena, :slika)";

// Pripremanje upita za izvršavanje
$stmt = $pdo->prepare($sql); //statment

// Vezivanje parametara
$stmt->bindParam(':idZanr', $idZanr);
$stmt->bindParam(':idPisac', $idPisac);
$stmt->bindParam(':naslov', $naslov);
$stmt->bindParam(':cena', $cena);
$stmt->bindParam(':slika', $slika);

// Pokušaj izvršavanja upita

$stmt->execute();

header("Location:administrator.php");
