<?php
    include_once 'db.php';

    $conn = DB::getConnection();

    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $id = $_GET['id'];

    if($id != -1) {
        $sql="SELECT * FROM internship WHERE ID = $id";
        $result = $conn->query($sql);

        $internships = array();
        while($row = $result->fetch()) {
            $internships[] = $row;
        }
    } else {
        $sql="SELECT * FROM internship";
        $result = $conn->query($sql);

        $internships = array();
        while($row = $result->fetch()) {
            $internships[] = $row;
        }
    }

    // $sql="SELECT * FROM internship";
    // $result = $conn->query($sql);

    // $internships = array();
    // while($row = $result->fetch()) {
    //     $internships[] = $row;
    // }

    echo json_encode($internships);

?>
