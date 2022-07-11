<?php
    include_once 'db.php';

    $conn = DB::getConnection();

    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $id = $_GET['id'];


    if($id != -1) {
        $sql="SELECT * FROM oglas WHERE ime_tvrtke = '$id'";
        // $sql="SELECT * FROM oglas";
        $result = $conn->query($sql);

        $internships = array();
        while($row = $result->fetch()) {
            $internships[] = $row;
        }
    } else {
        $sql="SELECT * FROM oglas";
        $result = $conn->query($sql);

        $internships = array();
        while($row = $result->fetch()) {
            $internships[] = $row;
        }
    }

    echo json_encode($internships);

?>
