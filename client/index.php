<?php
  session_start();

  if(!isset($_SESSION['user_type'])) {
    header('login.php');
  }

  if(isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
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
            echo '<a href="./client/newInternship.php" style="color: white;">Dodaj novi oglas</a>';
            // echo '<a href="" style="color: white;">Izlogiraj se</a>';
            echo '</button>';
            echo '</span>';
          }
          echo '<a class="nav-link" style="margin-left: 20px;" href="./client/logout.php">Odjava</a>'; 
        ?>
      </nav>

      <script>

        document.getElementById('showCmp').addEventListener('click', function() {
          showCompanyInternships();
        });

        showCompanyInternships = () => {
          $.ajax({
            url: './server/getCompanyInternships.php',
            type: 'GET',
            data: {
              id: '<?php echo $_SESSION['id_tvrtke']; ?>'
            },
            success: function(data) {
              $('#internships').html(data);
            }
          });
        }

      </script>
 

    <div id='free' class="px-5 py-4" style="color:white; font-weight: bold; margin-top: 6%;">

      <?php
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'student') {
          echo '<h3 style="font-weight: bold;">Prolistaj oglase i <br> <span style="color: #AA14F0;"> nađi praksu za sebe!</span></h3>';
        } else {
          echo '<h3 style="font-weight: bold;">Dobrodošli natrag<br><span style="color: #AA14F0;">na najveći studentski portal u RH!</span></h3>';
        }
      ?>

      <!-- <h3 style="font-weight: bold;">Prolistaj oglase i <br> nađi praksu za sebe!</h3> -->
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Prijava</h5>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="applicant-name" class="col-form-label">Ime:</label>
                <input type="text" class="form-control" id="applicant-name">
              </div>
              <div class="form-group">
                <label for="applicant-surname" class="col-form-label">Prezime:</label>
                <input type="text" class="form-control" id="applicant-surname">
              </div>
              <div class="form-group">
                <label for="applicant-msg" class="col-form-label">Poruka:</label>
                <textarea name="" id="applicant-msg" class="form-control"  cols="30" rows="10"></textarea>
                <!-- <input type="text" class="form-control" id="applicant-msg"> -->
              </div>
              <div class="form-group">
                <label for="applicant-msg" class="col-form-label">E-mail:</label>
                <input type="text" class="form-control" id="applicant-email">
              </div>
              <div class="form-group">
                <label for="int-id" class="col-form-label">ID PRAKSE:</label>
                <input type="text" class="form-control" id="int-id" disabled>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
            <button type="button" class="btn btn-primary" onclick='handleApplication();'>Pošalji prijavu!</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('int-id') // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Prijava na oglas ')
      })
    </script>


    <script>
      $(document).ready(() => {
        showInternships_nat();
      });

      handleApplication = function() {
        
        var name = $('#applicant-name').val();
        var surname = $('#applicant-surname').val();
        var email = $('#applicant-email').val();
        var message = $('#applicant-msg').val();
        var internshipId = $('#int-id').val();
        console.log(name, surname, email, message, internshipId);
        
        $.ajax({
            url: "../server/sendApplication.php",
            data: {
              internshipId: internshipId,
              name: name,
              surname: surname,
              message: message,
              email: email
            },
            success: function(data) {
              console.log(data);
            },
            error: function(xhr, status) {
                console.log("handleApplication :: error :: status = " + status);
                if(status === "timeout")
                    showInternships();
            }
        })  
      }

      showInternship_nat = function(id) {
      
        $.ajax({
            url: "../server/getInternships.php",
            data: {
                id: id
            },
            success: function(data) {
              console.log(data);
              var internships = JSON.parse(data);

              $.ajax({
                url: "../server/getCompany.php",
                method: "GET",
                data: {
                  id: internships[0].ime_tvrtke
                },
                success: function(cmp) {
                  console.log(cmp);

                  var company = JSON.parse(cmp);

                  console.log(company[0]['ime_tvrtke']);

                  var html = "";
                  html += "<div class='container mb-5' style='margin-left: 50px; line-height:20px;'>";
                  html += " <button type='button' class='btn btn-light mb-5'  onclick = 'showInternships_nat()')><a >\ <i class='fa fa-chevron-left' aria-hidden='true'></i> Natrag na sve oglase</a></button>";
                  html += '<div class="details_title" style="line-height: 3px; !important font-weight: bold;" style="color: white ">';
                  html += "<h1 style='color: white; font-weight: bold;'> " + internships[0].ime_tvrtke + ", est. " + company[0]['godina_osnutka'] +  "</h1>";
                  html += '<h3 style="color: white; font-weight: bold;">' + internships[0].naslov + '</h3>';
                  html += "<p class='font-weight-bold'>" + company[0]['adresa'] + "</p>";
                  html += '</div>';
                  html += "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal' data-int-id='"+ internships[0].ID +"'>Prijavi se</button>";
                  html += '<div class="details_body w-50">';

                    html += "<h4 class='mt-5' style='color: white; font-weight: bold;'>Opis firme</h4>";
                    html += "<p>" + company[0]['opis'] + "</p>";

                    html += "<h4 style='color: white; font-weight: bold;'>Opis prakse</h4>";
                    html += "<p>" + internships[0].opis_posla + "...</p>";
                    
                    html += "<h4 style='color: white; font-weight: bold;'>Kvalifikacije</h4>";
                    html += "<p>" + internships[0].kvalifikacije + "</p>";
                      
                    html += "<h4 style='color: white; font-weight: bold;'>Dodatne informacije</h4>";
                    html += "<p>" + internships[0].dodatne_informacije + "</p>";

                    html += "<h4 style='color: white; font-weight: bold;'>Datum početka: " + internships[0].datum_pocetka + "</h4>";
                    html += '</div>';
                    html += "</div>";

                    $("#internships").html(html);
                }
              })
            
            },
            error: function(xhr, status) {
                console.log("showInternships :: error :: status = " + status);
                if(status === "timeout")
                    showInternships();
            }
        })
      }

      showInternships_nat = function() {
        $.ajax({
            url: "../server/getInternships.php",
            data: {
              id: -1
            },
            success: function(data) {

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
                                <h3>" + "<span style='font-weight:bold'>" + internships[i].ime_tvrtke + '</span> - ' + internships[i].naslov + " </h3>\
                              </div>\
                              <div class='solu_description'>\
                                <p>\ "
                                html += internships[i].opis_posla.substr(0, 250) ;
                                html += '<br>';
                                html += internships[i].datum_pocetka;
                                html += " </p>\
                                <button type='button' class='read_more_btn' onclick = 'showInternship_nat(" + internships[i].id_oglasa + ")')><a >\Detalji</a></button>\
                              </div>\
                            </div>\
                          </div>\
                          </div>";
              }

              $("#internships").html(html);
            },
            error: function(xhr, status) {
                console.log("showInternships :: error :: status = " + status);
                if(status === "timeout")
                    showInternships();
            }
        })
      }

    </script>

    <div id="main" class="row">
      
      <div class="col-3 mx-5">
        <h2 style="color: white;">Naši ciljevi</h2>
          <p style="width:400px; color: white; font-size: 14px;">
            Naš cilj je omogućiti lak pristup studentskoj praksi svakom studentu i studentici na području RH.
            Kroz ovaj portal su praksa i iskustvo nadohvat ruke.
          </p>    
      </div>
        
      <div class="col-3" style="margin-left: 5%;">
        <h2 style="color: white;">Cilj prakse je</h2>
          <p style="width:400px; color: white;  font-size: 14px;">    
            stjecanje stručnog iskustva, razvijanje odgovornosti prema uspješnom izvršavanju zadataka, razvoj komunikacijskih vještina u radu s korisnicima
            i promocija suradnje Odjela s AKM i drugim ustanovama.
          </p>
        
      </div>

      <div class="col-3" style="margin-left: 5%;">
        <h2 style="color: white;">2015. i 2016. godine</h2>
          <p style="width:400px; color: white;  font-size: 14px;">    
          je Ministarstvo znanosti i obrazovanja provelo anketu koja je pokazala da je u Hrvatskoj 947 programa koji provode stručnu praksu, a to uključuje više od 165.000 studenata koji ju obavljaju
          </p>
        
      </div>

    </div>

    <hr class="solid ml-4 mr-5" style="color: white; width: 80%;">

    <div id="main" class="row">
        <div id="internships" class="col-sm" style="width: 50%;">
        <div></div>
    </div>
    </div>


  </body>
</html>