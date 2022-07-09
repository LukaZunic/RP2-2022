<?php
    include_once 'db.php';

    $conn = DB::getConnection();

    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $sql="SELECT * FROM internship";
    $result = $conn->query($sql);
    $internships = array();
    while($row = $result->fetch()) {
        $internships[] = $row;
    }
    echo json_encode($internships);

?>
