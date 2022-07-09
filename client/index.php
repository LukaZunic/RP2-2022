
<?php
  session_start();
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

    <nav class="navbar fixed-top px-5 mb-5" style="background-color: transparent;">
        <span class="navbar-brand mb-0 h1" style="color: white;">STUDENTSKI PORTAL</span>
        <span class="navbar-action">
          <button type="button" class="btn btn-light">
            <a href="./client/newInternship.php" style="color: white;">Dodaj Oglas</a>
          </button>
        </span>
    </nav>

    <div id='free' class="px-5 py-4 mt-5" style="color:white;">
      <h3>Slobodne prakse</h3>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
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
                <input type="text" class="form-control" id="applicant-msg">
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
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
      modal.find('.modal int-id').val(recipient)
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

              document.getElementById('free').innerHTML = '';

              internships = internships;
              var html = " <button type='button'  onclick = 'showInternships_nat()')><a >\Natrag</a></button>";

              html += ""

              html += "<div class='container' style='margin-left: 50px; line-height:20px;'>";
              html += '<div class="details_title" style="line-height: 3px; !important font-weight: bold;" style="color: white ">';
                html += "<h1 style='color: white; font-weight: bold;'> " + internships[0].company + "</h1>";
                html += '<h3 style="color: white; font-weight: bold;">' + internships[0].title + '</h3>';
                html += "<p class='font-weight-bold'>IT park Osijek 1, Osijek, Osječko-baranjska županija, Croatia</p>";
                html += "<p>Zaposlenici mogu raditi na daljinu</p>";
              html += '</div>';

              // html += "<button onclick='applicationProcedure(" + internships[0].ID + ")'>Prijavi se</button>";

              html += "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal' data-int-id='"+ internships[0].ID +"'>Prijavi se</button>";
              html += '<div class="details_body w-50">';

                html += "<h4 class='mt-5' style='color: white; font-weight: bold;'>Opis firme</h4>";
                html += "<p>" + 'Mi smo Mono, full-service software development tvrtka iz Osijeka. Proslavili smo 19. rođendan. Uselili u osječki IT park! Proglašeni smo najuspješnijim poduzećem u Hrvatskoj za vrijeme pandemije te najboljom ICT tvrtkom - i to u globalno najizazovnijoj godini ikada. \
                            Tražimo nove kolege koji će s nama jednako entuzijastično nastaviti postojeće klijentske i interne projekte te donijeti dašak nove energije i originalnih ideja u procesima i projektima koje tek jedva čekamo započeti. U potrazi smo za ljudima svih levela: junior, middle, senior s naglaskom na mid/senior' + "</p>";

                html += "<h4 style='color: white; font-weight: bold;'>Opis prakse</h4>";
                html += "<p>" + 'Kao DevOps engineer u Monu ćeš se baviti izgradnjom (planiranjem), održavanjem i povezivanjem continuous integration, continuous delivery/deployment servisa i operacija, a ponekad i automatiziranih testova, backupa i slično.\
                                U suradnji s kolegom sistemcem ili samostalno ćeš raditi na planiranju i izgradnji nove infrastrukture - u smislu podizanja i konfiguriranja novih servera i servisa na njima.\
                                Upravljat ćeš nadzorom (monitoring) i održavanjem (poboljšanjem) postojećih sustava (i infrastrukture), ponajviše u smjeru sigurnosti i performansi (optimizacije servera, skaliranje, npr. rekonfiguriranje i migracije baza podataka).' + "</p>";
                
                html += "<h4 style='color: white; font-weight: bold;'>Kvalifikacije</h4>";
                html += "<p>" + 'iskustvo u radu s Microsoft Azure i/ili Amazon AWS okruženjima i alatima (EC2, RDS,  ElastiCache) te sa serverskim OS-ovima (primarno Windows, Linux - Centos i rjeđe Ubuntu) \ ' + "</p>";
                  
                html += "<h4 style='color: white; font-weight: bold;'>Dodatne informacije</h4>";
                html += '<p> Zauzvrat nudimo: </p>';
                html += '<p> fleksibilno radno vrijeme \
                            povremeni remote rad/hybrid </p>';

                html += "<h4 style='color: white; font-weight: bold;'>Datum početka: " + '2022' + "</h4>";
            
                html += "<button type='button' onclick = 'showInternships()><a >\Natrag</a></button>\ ";
                  
                html += '</div>';
                html += "</div>";

              $("#internships").html(html);
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
                            <h3>" + internships[i].company + ' - ' + internships[i].title + " </h3>\
                          </div>\
                          <div class='solu_description'>\
                            <p>\ "
                            html += internships[i].description;
                            html += '<br>';
                            html += 'Prijave do 30.12.12';
                            html += " </p>\
                            <button type='button' class='read_more_btn' onclick = 'showInternship_nat(" + internships[i].ID + ")')><a >\Detalji</a></button>\
                          </div>\
                        </div>\
                      </div>\
                      </div>";
                console.log([internships[i]]);
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
      <div id="internships" class="col-sm" style="width: 50%;">

      </div>
      <div class="col-sm">
        <h2 style="color: white;">Naši ciljevi</h2>
          <p style="width:600px; color: white;">
            Osnovni ciljevi stručne prakse su stjecanje novih spoznaja, vještina i kompetencija studenata,
            prilagodba studenata specifičnim zahtjevima tržišta rada, nadopuna, praktična provjera i primjena stručnih znanja usvojenih tijekom studija, stjecanje stručnog iskustva, razvijanje odgovornosti prema uspješnom izvršavanju zadataka, razvoj komunikacijskih vještina u radu s korisnicima i promocija suradnje Odjela s AKM i drugim ustanovama.
            Stručna praksa obvezni je dio nastavnog procesa. Obavljaju je studenti preddiplomskog i diplomskog (redovnog i izvanrednog) studija informacijskih znanosti Sveučilišta u Zadru koji nakon završetka školovanja stječu naziv prvostupnik/prvostupnica informacijskih znanosti i magistar/magistra informacijskih znanosti. Studenti stručnu praksu mogu obavljati u zemlji i inozemstvu.
            Studenti prve godine preddiplomskog studija nemaju stručnu praksu
          </p>
        
      </div>

    </div>

   
    

  </body>
</html>