<?php
    include_once 'db.php';

    $db = DB::getConnection();

    if (!$db) {
        die('Could not connect: ' . mysqli_error($db));
    }

    $internshipId = $_GET['internshipId'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $message = $_GET['message'];





       
    // $db->exec("INSERT INTO prijavljen (ime_tvrtke,adresa,telefon,mail_adresa,sifra_tvrtke,opis,godina_osnutka)"
    //             . " VALUES('$ime_tvrtke','$adresa','$telefon','$mail','$sifra_tvrtke','$opis','$godina_osnutka')");


    echo json_encode($id);
?>
