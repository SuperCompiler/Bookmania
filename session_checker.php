<?php
session_start();

if(!isset($_SESSION['idKorisnik'])) {
    session_destroy();
    header("Location:index.php");
    exit();
}
?>