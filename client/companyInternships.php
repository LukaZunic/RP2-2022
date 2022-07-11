<?php
    session_start();

    if(!isset($_SESSION['user_type'])) {
      header('login.php');
    }

    if(isset($_SESSION['user_type'])) {
      $user_type = $_SESSION['user_type'];
    }

    if(isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="internships.css">
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
      <?php
          if($user_type === 'company') {
            echo '<span class="navbar-action" style="margin-right: 20px;">';
            echo "<button type='button' class='btn btn-light' id='showCmp'>";
            echo '<a href="/client/companyInternships.php" style="color: white;">Moji oglasi</a>';
            // echo '<a href="" style="color: white;">Izlogiraj se</a>';
            echo '</button>';
            echo '</span>';
            echo '<span class="navbar-action ml-4">';
            echo '<button type="button" class="btn btn-light">';
            echo '<a href="./newInternship.php" style="color: white;">Dodaj novi oglas</a>';
            // echo '<a href="" style="color: white;">Izlogiraj se</a>';
            echo '</button>';
            echo '</span>';
          }
        ?>
      </nav>

    <div id='free' class="px-5 py-4" style="color:white; font-weight: bold; margin-top: 6%;">
        <h3 style="font-weight: bold;">Vaše objavljene prakse</h3>
    </div>
    

    <script>
        $(document).ready(() => {
            var cmpId = '<?php echo $_SESSION['username']; ?>'
            console.log(cmpId);
            showInternships_cmp(cmpId);
        });

        showInternships_cmp = (cmpId) => {
            console.log(cmpId);
            $.ajax({
                url: '../server/getCompanyInternships.php',
                type: 'GET',
                data: {
                  id: cmpId
                },
                success: (data) => {
                    console.log(data);
                    var internships = JSON.parse(data);

                    var html = "";
                    for (var i = 0; i < internships.length; i++) {

                        html += "<div class='section_our_solution my-3'>\
                            <div class='row'>\
                            <div class='col-lg-12 col-md-12 col-sm-12'>\
                                <div class='our_solution_category'>\
                                <div class='solution_cards_box'>\
                                    <div class='solution_card'>\
                                    <div class='hover_color_bubble'>\</div>\
                                    <!--\
                                    <div class='so_top_icon'>\
                                        <img src='client/assets/headhunting.png' alt=''>\
                                    </div>\
                                    -->\
                                    <div class='solu_title'>\
                                        <h3>" + internships[i].ime_tvrtke + ' - ' + internships[i].naslov + " </h3>\
                                    </div>\
                                    <div class='solu_description'>\
                                        <p>\ "
                                        html += internships[i].opis_posla.substr(0, 250);
                                        html += '<br>';
                                        html += internships[i].datum_pocetka;
                                        html += " </p>\
                                        <button type='button' class='read_more_btn' onclick = 'seeApplications(" + internships[i].id_oglasa + ")')><a >\Prijavljeni studenti</a></button>\
                                    </div>\
                                    </div>\
                                </div>\
                                </div>";
                    }

                    $("#internships").html(html);
                }
            });
        }

        seeApplications = (intId) => {
          $.ajax({
            url: '../server/getApplications.php',
            type: 'GET',
            data: {
              id: intId
            },
            success: (data) => {
                    console.log(data);
                    var applicants = JSON.parse(data);

                    var html = "";
                    for (var i = 0; i < applicants.length; i++) {

                        html += "<div class='section_our_solution my-3'>\
                            <div class='row'>\
                            <div class='col-lg-12 col-md-12 col-sm-12'>\
                                <div class='our_solution_category'>\
                                <div class='solution_cards_box'>\
                                    <div class='solution_card'>\
                                    <!--\
                                    <div class='so_top_icon'>\
                                        <img src='client/assets/headhunting.png' alt=''>\
                                    </div>\
                                    -->\
                                    <div class='solu_title'>\
                                        <h3 style='font-weight: bold;'>" + applicants[i].ime + ' ' + applicants[i].prezime + " </h3>\
                                    </div>\
                                    <div class='solu_description'>\
                                        <p>\ "
                                        html += '<p>Godina studija: ' + applicants[i].godina_studija + '</p>';
                                        html += applicants[i].fakultet;
                                        html += '<br>';
                                        html += applicants[i].studij;
                                        html += '<br>';
                                        html += applicants[i].smjer;
                                        html += '<br>';
                                        html += applicants[i].mail;
                                        html += '<br>';
                                        html += " </p>\
                                    </div>\
                                    </div>\
                                </div>\
                                </div>";
                    }

                    $("#internships").html(html);
                }
          })
        }


    </script>


    <div id="internships">
        
    </div>



  </body>

</html>