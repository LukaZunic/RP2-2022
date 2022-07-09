<?php

    include_once '../server/db.php';

    session_start();
    $db = DB::getConnection();

    if(isset($_POST['submit'])) {
       
        echo "submit";

        // $companyID = $_SESSION['companyID'];
        // $internshipId = $_POST['internshipId'];
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $qualifications = $_POST['qualifications'];
        $salary = $_POST['salary'];
        $capacity = $_POST['capacity'];
        $location = $_POST['location'];
        $additionalInfo = $_POST['additionalInfo'];

        $sql = "INSERT INTO oglas (id_oglasa, kapacitet, broj_prijavljenih, placa_kn, opis_posla, kvalifikacije, datum_pocetka, dodatne_informacije)
            VALUES (1, '$capacity', 0,  '$salary',  '$description', '$qualifications', '$startDate', '$additionalInfo')";

        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }

    }

?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal za praksu</title>
    <link rel="stylesheet" href="client/style.css">
    <link rel="stylesheet" href="client/internships.css">
    <script src="./script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        Naslov prakse: <input type="text" name="title"><br>
        Opis prakse: <input type="text" name="description"><br>
        Datum početka: <input type="date" name="startDate"><br>
        Kvalifikacije: <input type="text" name="qualifications"><br>
        Kapacitet: <input type="text" name="capacity"><br>
        Plaća: <input type="text" name="salary"><br>
        Mjesto: <input type="text" name="location"><br>
        Dodatne Informacije: <input type="text" name="additionalInfo"><br>
        <input type="submit" name="submit" value="Pošalji">
    </form>




</body>

</html>