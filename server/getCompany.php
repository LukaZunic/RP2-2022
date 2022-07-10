<?php

    include_once 'db.php';

    $conn = DB::getConnection();

    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $id = $_GET['id'];


    $sql = "SELECT * FROM tvrtke WHERE ime_tvrtke = '$id'";
    $result = $conn->query($sql);

    $cmp = array();
    while($row = $result->fetch()) {
        $cmp[] = $row;
    }

    
    echo json_encode($cmp);

?>