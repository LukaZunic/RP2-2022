<?php

    require_once '../server/db.php';

    session_start();
    $db = DB::getConnection();

    if (!$db) {
        die('Could not connect: ' . mysqli_error($db));
    }

    $userID = $_GET['id'];
    // echo $userID;
    $st = $db->prepare('SELECT * FROM student WHERE jmbag=:jmbag');
    $st->execute(array('jmbag' => $userID));
    $user = $st->fetch();

    echo json_encode($user);
?>
