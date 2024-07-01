<?php
// echo "<pre>";
// // var_dump($_post) ISPIS VARIJABLE SA TIPOM PODATKA I DUZINOM
// echo "</pre>";



if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {


    // var_dump($_POST);
    include 'conn.php';
    // bindovanje se koristi kako bi se sprecio sql injection
    // prednost PDO u odnosu na mySQLi
    $username = $_POST['username']; #ovde je vrednost za username koje je uneo korisnik
    $password = $_POST['password'];
    $aktivan = 1;

    $upit = $pdo->prepare("SELECT * FROM korisnik WHERE username = :username AND password = :password AND aktivan =:aktivan");
    // Vezivanje parametara
    $upit->bindParam(':username', $username);
    $upit->bindParam(':password', $password);
    $upit->bindParam(':aktivan', $aktivan);

    $upit->execute();

    // Fetch rezultata = fetch vraca samo 1 red
    // fetchAll = fetchAll vraca sve redove za koje se poklopio uslov
    $rezultat = $upit->fetch(PDO::FETCH_ASSOC); // fetch_ASSOC vraca asocijativni niz.


    if (!$rezultat) {
        header("Location:index.php?error=2");
        exit();
    } else {
        session_start();
        $_SESSION['idKorisnik'] = $rezultat['idKorisnik'];
        $_SESSION['imePrezime'] = $rezultat['imePrezime'];
        $_SESSION['idUloge'] = $rezultat['idUloge'];


        if ($_SESSION['idUloge'] == 1) {
            header("Location:administrator.php"); #sakldjklsjdkljaskldjklasjdkljaskldjklsajdklsajdklsadkjsakldjsakldjklasjdkljsakldjklassjdkljaskldjaklsj
            exit();
        }
        if ($_SESSION['idUloge'] == 2) {
            header("Location:korisnik1.php");  #sakldjklsjdkljaskldjklasjdkljaskldjklsajdklsajdklsadkjsakldjsakldjklasjdkljsakldjklassjdkljaskldjaklsj
            exit();
        }

        // USPESNO
    }
} else {
    header("Location:index.php?error=1");
    exit();
    // header redirektuje korisnika na stranu upisanu nakon location:
    // error 1  znaci da nisu uneti parametri
}
