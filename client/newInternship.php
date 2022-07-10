<?php

    include_once '../server/db.php';

    session_start();
    $db = DB::getConnection();

    if(isset($_POST['submit'])) {

        echo "<script>console.log('PHP: New Internship Submitted')</script>";
    
        echo "<script>console.log('PHP: Internship Name: " . $_POST['title'] . "')</script>";
        echo "<script>console.log('PHP: Internship Description: " . $_POST['description'] . "')</script>";
        echo "<script>console.log('PHP: Internship qual: " . $_POST['qualifications'] . "')</script>";
        echo "<script>console.log('PHP: Internship capacity: " . $_POST['capacity'] . "')</script>";
        echo "<script>console.log('PHP: Internship salary: " . $_POST['salary'] . "')</script>";


        if(isset($_SESSION['ime_tvrtke'])) {
            $companyName = $_SESSION['ime_tvrtke'];
        }

        // $internshipId = $_POST['internshipId'];
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $qualifications = $_POST['qualifications'];
        $salary = $_POST['salary'];
        $capacity = $_POST['capacity'];
        $location = $_POST['location'];
    
        $additionalInfo = $_POST['additionalInfo'];

        $sql = "INSERT INTO oglas (id_oglasa, naslov, kapacitet, broj_prijavljenih, placa_kn, opis_posla, kvalifikacije, datum_pocetka, dodatne_informacije)
                VALUES (DEFAULT, '$title', '$capacity', 0,  '$salary',  '$description', '$qualifications', '$startDate', '$additionalInfo')";

        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "<script> console.log('Error:'" . $sql . "'<br>' ". $db->error . "')</script>";
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
        <link rel="shortcut icon" href="./assets/favicon.ico" />
        <link rel="stylesheet" href="client/style.css">
        <link rel="stylesheet" href="client/internships.css">
        <link rel="stylesheet" href="newInternship.css">
        <script src="./script.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </head>
<body>


    <nav class="navbar navbar-expand-lg px-5 mb-5 py-3 fixed-top" style="color: white; background-color: black;">
      <span class="navbar-brand mb-0 h1" style="color: white; font-weight: bold;">STUDENTSKI PORTAL</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">O nama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Zakonik</a>
          </li>
        </ul> -->
      </div>
    </nav>

    <div id='free' class="px-5 py-4" style="color:white; margin-top: 2%;">
        <h3 style="font-weight: bold;">Ispunite podatke za oglas i pronađite studente!</h3>
        <p>Naši oglasi su odmah dostupni tisućama studenata diljem Hrvatske, u prosjeku se na svaki oglas prijavi barem 15 studenata</p>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="container" class="mb-5" style="margin-top: 200px; !important">

        <span class="input">
            <input type="text" class="input__field" id="input-1" name="title" />
            <label for="input-1" class="input__label">
            <span class="input__label-content">Naslov prakse</span>
        </label>
        </span>

        <span class="input">
            <input type="text" class="input__field" id="input-2" name="position" />
            <label for="input-2" class="input__label">
            <span class="input__label-content">Pozicija</span>
            </label>
        </span>

        <span class="input">
            <input type="text" class="input__field" id="input-3" name="capacity" />
            <label for="input-3" class="input__label">
            <span class="input__label-content">Kapacitet</span>
            </label>
        </span>

        <span class="input">
            <input type="text" class="input__field" id="input-4" name="salary" />
            <label for="input-4" class="input__label">
            <span class="input__label-content">Plaća</span>
            </label>
        </span>

        <span class="input">
            <input type="text" class="input__field" id="input-5" name="location" />
            <label for="input-5" class="input__label">
            <span class="input__label-content">Lokacija</span>
            </label>
        </span>

        <span class="input">
            <input type="text" class="input__field" id="input-6" name="startDate" />
            <label for="input-6" class="input__label">
            <span class="input__label-content">Datum početka</span>
            </label>
        </span>

        <span class="input message">
            <textarea class="input__field" id="input-7" name="description"></textarea>
            <label for="input-7" class="input__label">
            <span class="input__label-content">Opis prakse</span>
            </label>
        </span>

        <span class="input message">
            <textarea class="input__field" id="input-8" name="qualifications"></textarea>
            <label for="input-8" class="input__label">
            <span class="input__label-content">Potrebne kvalifikacije</span>
            </label>
        </span>

        <span class="input message">
            <textarea class="input__field" id="input-9" name="additionalInfo"></textarea>
            <label for="input-9" class="input__label">
            <span class="input__label-content">Dodatne informacije</span>
            </label>
        </span>

        <button id="send-button" name="submit" type="submit">Objavi oglas</button>

    </form>
<!-- 
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
    </form> -->

    <script>

        var $input;

        function onInputFocus(event) {
        var $target = $(event.target);
        var $parent = $target.parent();
        $parent.addClass('input--filled');
        };

        function onInputBlur(event) {
        var $target = $(event.target);
        var $parent = $target.parent();

        if (event.target.value.trim() === '') {
                $parent.removeClass('input--filled');
            }
        };

        $(document).ready(function() {
        $input = $('.input__field');
        
        // in case there is any value already
        $input.each(function(){
            if ($input.val().trim() !== '') {
            var $parent = $input.parent();
            $parent.addClass('input--filled');
            }
        });
        
        $input.on('focus', onInputFocus);
        $input.on('blur', onInputBlur);
        });
    </script>






</body>

</html>