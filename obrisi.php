<?php
include 'conn.php';

$idKnjiga = $_GET['idKnjiga'];


$sql = "DELETE FROM `knjiga` WHERE `idKnjiga` = :idKnjiga";

$stmt = $pdo->prepare($sql);

// Povezivanje parametara
$stmt->bindParam(':idKnjiga', $idKnjiga);

// Izvršavanje naredbe
$stmt->execute();


header("Location:administrator.php");
