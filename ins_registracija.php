<?php
include 'conn.php';

$imePrezime = $_POST['imePrezime'];
$username = $_POST['username'];
$password = $_POST['password'];

$idUloge = 2;
$aktivan = 0;
// Priprema SQL upita sa placeholder-ima
$sql = "INSERT INTO korisnik (imePrezime,idUloge, username, password,aktivan) 
                    VALUES (:imePrezime,:idUloge, :username, :password,:aktivan)";

// Pripremanje upita za izvršavanje
$stmt = $pdo->prepare($sql); //statment

// Vezivanje parametara
$stmt->bindParam(':imePrezime', $imePrezime);
$stmt->bindParam(':idUloge', $idUloge);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':aktivan', $aktivan);

// Pokušaj izvršavanja upita

$stmt->execute();

header("Location:index.php?registracija=1");
