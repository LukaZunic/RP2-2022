<?php
    include_once 'db.php';

    $conn = DB::getConnection();

    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $intId = $_GET['id'];


    $sql = "SELECT * FROM prijavljen WHERE id_oglasa = '$intId'";
    $result = $conn->query($sql);
    $applicants = array();
    while($row = $result->fetch()) {
        $applicants[] = $row;
    }

    $studentData = array();


    for($i = 0; $i < count($applicants); $i++) {
 
        $st = $conn->prepare('SELECT * FROM student WHERE jmbag=:jmbag');
        $st->execute(array('jmbag' => $applicants[$i]['jmbag']));

        $studentData[$i] = $st->fetch();
    }


    echo json_encode($studentData);

?>
