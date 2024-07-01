<?php
include 'conn.php';
$id = $_POST['id'];
$kolicina = $_POST['kolicina'];
// Priprema SQL upita za ažuriranje
$sql = "UPDATE korpa SET kolicina = :kolicina WHERE id = :id";

// Pripremanje upita za izvršavanje
$stmt = $pdo->prepare($sql);

// Bindovanje parametara
$stmt->bindParam(':kolicina', $kolicina);
$stmt->bindParam(':id', $id);


// Izvršavanje upita
$stmt->execute();

header("Location:korpa.php");
