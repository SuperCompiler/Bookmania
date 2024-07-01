<?php

include 'conn.php';

$id = $_GET['id'];

$sql = "DELETE FROM korpa WHERE id = :id";

// Pripremanje upita za izvršavanje
$stmt = $pdo->prepare($sql);

// Bindovanje parametara
$stmt->bindParam(':id', $id);

// Izvršavanje upita
$stmt->execute();


header("Location:korpa.php");
