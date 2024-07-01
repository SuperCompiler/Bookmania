<?php
$server = "localhost"; // Server na kojem se nalazi baza podataka
$dbname = "userPROJEKAT"; // Ime baze podataka
$username = "root"; // Korisničko ime za pristup bazi podataka
$password = ""; // Lozinka za pristup bazi podataka

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
// Postavljanje PDO error mode na exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Konekcija uspešno uspostavljena";
