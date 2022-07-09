<?php
    include_once 'db.php';

    session_start();


    // $userID = $_SESSION['userID'];


    $db = DB::getConnection();

    if (!$db) {
        die('Could not connect: ' . mysqli_error($db));
    }

    $internshipId = $_GET['internshipId'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $message = $_GET['message'];


    $sql = "INSERT INTO prijavljen (jmbag, id_oglasa) VALUES ('$name', '$internshipId')";

    // $sql = "INSERT INTO prijavljen (jmbag, id_oglasa) VALUES ('$userID', '$internshipId')";
    $result = $db->query($sql);

       
    // $db->exec("INSERT INTO prijavljen (ime_tvrtke,adresa,telefon,mail_adresa,sifra_tvrtke,opis,godina_osnutka)"
    //             . " VALUES('$ime_tvrtke','$adresa','$telefon','$mail','$sifra_tvrtke','$opis','$godina_osnutka')");


    // echo json_encode($id);
?>
