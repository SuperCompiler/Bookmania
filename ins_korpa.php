<?php

include 'conn.php';


$idKorisnik = $_POST["idKorisnik"];
$idKnjiga = $_POST["idKnjiga"];
$kolicina = $_POST["kolicina"];


$sql = "INSERT INTO korpa (idKnjiga, idKorisnik, kolicina) 
                    VALUES (:idKnjiga, :idKorisnik, :kolicina)";

// Pripremanje upita za izvršavanje
$stmt = $pdo->prepare($sql); //statment

// Vezivanje parametara
$stmt->bindParam(':idKnjiga', $idKnjiga);
$stmt->bindParam(':idKorisnik', $idKorisnik);
$stmt->bindParam(':kolicina', $kolicina);

// Pokušaj izvršavanja upita

$stmt->execute();

header("Location:korisnik1.php?msg=uspesno");
