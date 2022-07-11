<?php


function drawLoginForm($msg = '') {
    ?>
	<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Portal za praksu</title>
        <link rel="stylesheet" href="client/style.css">
        <link rel="stylesheet" href="client/internships.css">
        <script src="./script.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </head>
	<!-- <body>
		<form method="post" action="<?php // echo htmlentities($_SERVER['PHP_SELF']); ?>">
			Korisničko ime: 
			<input type="text" name="username" />
			<br />
			Password:
			<input type="password" name="password" />
			<br />
			<button type="submit" name="gumb" value="login">Ulogiraj se!</button>
			<button type="submit" name="gumb" value="novi">Prijavi novog korisnika!</button>
		</form>

		<?php 
			// if($msg !== '')
			// 	echo '<p>' . $msg . '</p>';
		?>
	</body>
	</html> -->

    <body>
            <section class="vh-100">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-sm-6 text-black mt-5">

                        <div class="row">
                            <div class="px-5 ms-xl-4 col-8">
                                <i class="fa fa-code-fork fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                                <span class="h1 fw-bold mb-0 mt-5">Studentski portal</span>
                            </div>
                        </div>            

                        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                            <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  style="width: 23rem;">

                                <div class="row">
                                    <h3 class="fw-normal mb-3 col-6" style="letter-spacing: 1px;">Ulogiraj se!</h3>
                                    
                                </div>
                                <div class="col-6">
                                    <label for="loginSelect" class="">Ja sam:</label>
                                    <select class="form-select form-select-sm mb-3" id="loginSelect" name="loginSelect" aria-label=".form-select-lg example">
                                        <option value="student" selected>Student</option>
                                        <option value="company">Firma</option>
                                    </select>
                                </div>

                                <div class="form-outline mb-4" id="jmbagInput">
                                    <label class="form-label" for="jmbag">JMBAG</label>
                                    <input id="jmbag" name="jmbag" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4" id="companyInput">
                                    <label class="form-label" for="company">Ime Firme</label>
                                    <input id="company" name="company" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="pass">Šifra</label>
                                    <input type="password" id="pass" name="pass" class="form-control form-control-lg" />
                                </div>

                                <div class="pt-1 mb-4">
                                    <button class="btn btn-lg btn-block btn-primary" type="submit" name="submit" id="submit" value="login">Pošalji</button>
                                </div>

                                <!-- <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p> -->
                                <p>Nemate račun? <button class="btn" id="signup" name="signup" type="submit" value="signup">Registrirajte se ovdje</button></p>

                            </form>

                            <?php if($msg != '') echo $msg?>
                        </div>
                    </div>
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                    </div>
                    </div>
                </div>
            </section>
        </body>
        </html>


        <script>
            $(document).ready(function(){
                $('#companyInput').hide();
            });

            $('#loginSelect').on('change',function() {
            console.log($(this).val());

                if($(this).val() == 'student') {
                    $('#jmbagInput').show();
                    $('#companyInput').hide();
                } else {
                    $('#jmbagInput').hide();
                    $('#companyInput').show();
                }
            });
        </script>

	<?php
}



function drawSignupForm() {
    ?>
	<!-- <!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf8" />
		<title>Login</title>
	</head>
	<body>
		<form method="post" action="<?php //echo htmlentities($_SERVER['PHP_SELF']); ?>">
			Korisničko ime: 
			<input type="text" name="username" />
			<br />
			Password:
			<input type="password" name="password" />
			Email:
			<input type="email" name="email" />
			<br />
			<button type="submit" name="gumb" value="signup">Stvori novog korisnika!</button>
		</form>
	
	</body>
	</html> -->
	<?php

    ?>
    
	<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Portal za praksu</title>
        <link rel="stylesheet" href="client/style.css">
        <link rel="stylesheet" href="client/internships.css">
        <script src="./script.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </head>
	<!-- <body>
		<form method="post" action="<?php // echo htmlentities($_SERVER['PHP_SELF']); ?>">
			Korisničko ime: 
			<input type="text" name="username" />
			<br />
			Password:
			<input type="password" name="password" />
			<br />
			<button type="submit" name="gumb" value="login">Ulogiraj se!</button>
			<button type="submit" name="gumb" value="novi">Prijavi novog korisnika!</button>
		</form>

		<?php 
			// if($msg !== '')
			// 	echo '<p>' . $msg . '</p>';
		?>
	</body>
	</html> -->

    <body>
            <section class="vh-100">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-sm-8 text-black mt-5">

                        <div class="row">
                            <div class="px-5 ms-xl-4 col-8">
                                <i class="fa fa-code-fork fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                                <span class="h1 fw-bold mb-0 mt-5">Studentski portal</span>
                            </div>
                        </div>            

                        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                            <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="width: 50rem;">

                                <div class="row">
                                    <h3 class="fw-normal mb-3 col-8" style="letter-spacing: 1px;">Registracija</h3>
                                </div>
                                <div class="col-4">
                                    <label for="loginSelect" class="">Ja sam:</label>
                                    <select class="form-select form-select-sm mb-3" id="loginSelect" name="loginSelect" aria-label=".form-select-lg example">
                                        <option value="student" selected>Student</option>
                                        <option value="company">Firma</option>
                                    </select>
                                </div>


                                <div id="studentSignup">
                                    <div class="form-outline mb-4 col-6" id="jmbagInput">
                                        <label class="form-label" for="jmbag">JMBAG</label>
                                        <input id="jmbag" name="jmbag" class="form-control form-control-lg" />
                                    </div>

                                    <div class="row">
                                        <div class="form-outline mb-4 col-6" id="name">
                                            <label class="form-label" for="name">Ime</label>
                                            <input id="name" name="name" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4 col-6" id="surname">
                                            <label class="form-label" for="surname">Prezime</label>
                                            <input id="surname" name="surname" class="form-control form-control-lg" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <label for="godina" class="">Godina studija:</label>
                                            <select class="form-select form-select-sm mb-3 col-4" id="godina" name="godina" aria-label=".form-select-lg example">
                                                <option value="1">1.</option>
                                                <option value="2">2.</option>
                                                <option value="3">3.</option>
                                                <option value="4">4.</option>
                                                <option value="5">5.</option>
                                                <option value="6">6.</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="fakultet" class="">Fakultet:</label>
                                        <select class="form-select form-select-sm mb-3 col-4" name="fakultet" id="fakultet">
                                            <option value="PMF-MO">PMF-MO</option>
                                            <option value="FER">FER</option>
                                            <option value="EFZG">EFZG</option>
                                            <option value="FSB">FSB</option>      
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="studij" class="">Studij:</label>
                                        <select class="form-select form-select-sm mb-3 col-4" id="studij" name="studij" aria-label=".form-select-lg example">
                                            <option value="1">Prediplomski studij </option>
                                            <option value="2">Diplomski studij</option>
                                            <option value="3">Postdiplomski</option>
                                            <option value="4">Ostalo</option>
                                        </select>
                                    </div>


                                    <div class="col-4">
                                        <label for="smjer" class="">Smjer:</label>
                                        <select class="form-select form-select-sm mb-3 col-4" name="smjer" id="smjer">
                                            <option value="Matematička statistika">Matematička statistika</option>
                                            <option value="Teorijska matematika">Teorijska matematika</option>
                                            <option value="Primjenjena matematika">Primjenjena matematika</option>
                                            <option value="Financijska i poslovna matematika">Financijska i poslovna matematika</option>
                                            <option value="Računarstvo i matematika">Računarstvo i matematika</option>
                                            <option value="Matematika; smjer nastavnički">Matematika; smjer nastavnički</option>
                                            <option value="Matematika i informatika; smjer nastavnički">Matematika i informatika; smjer nastavnički</option>
                                            <option value="Matematika; smjer nastavnički">Matematika; smjer istraživački</option>
                                            <option value="Elektrotehnika i informacijska tehnologija">Elektrotehnika i informacijska tehnologija</option>
                                            <option value="Računarstvo">Računarstvo</option>
                                            <option value="Informacijska i komunikacijska tehnologija">Informacijska i komunikacijska tehnologija</option>
                                            <option value="Strojatstvo">Strojatstvo</option>
                                            <option value="Brodogradnja">Brodogradnja</option>
                                            <option value="Zrakoplovno inženjerstvo i svemirske tehnike">Zrakoplovno inženjerstvo i svemirske tehnike</option>
                                            <option value="Mehatronika i robotika">Mehatronika i robotika</option>
                                            <option value="Poslijediplomski specijalistički studij">Poslijediplomski specijalistički studij</option>
                                            <option value="Poslijediplomski doktorski studij">Poslijediplomski doktorski studij</option>
                                            <option value="Poslovna ekonomija">Poslovna ekonomija</option>
                                            <option value="Marketing">Marketing</option>
                                        </select>
                                    </div>

                                   

                                    <div class="row">
                                        <div class="form-outline mb-4 col-6" id="e-mail">
                                            <label class="form-label" for="e-mail">E-mail</label>
                                            <input id="e-mail" name="e-mail" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4 col-6" id="phone">
                                            <label class="form-label" for="phone">Broj mobitela</label>
                                            <input name="phone" class="form-control form-control-lg" />
                                        </div>
                                    </div>


                                    <div class="form-outline mb-4 col-6" id="gpa">
                                        <label class="form-label" for="gpa">Prosjek zadnje odrađene godine<br>(Ukupni prosjek srednje ako ste 1. godina)</label>
                                        <input type="number" id="gpa" name="gpa" step="0.01" class="form-control form-control-lg" />
                                    </div>

                                </div>


                                <div id="companySignup">

                                    <div class="row">
                                        <div class="form-outline mb-4 col-6" id="companyInput">
                                            <label class="form-label" for="company">Ime Firme</label>
                                            <input id="company" name="company" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4 col-6" id="adress">
                                            <label class="form-label" for="adress">Adresa</label>
                                            <input id="adress" name="adress" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    

                                    <div class="form-outline mb-4 col-8" id="email">
                                        <label class="form-label" for="email">E-mail</label>
                                        <input id="email" name="email" class="form-control form-control-lg" />
                                    </div>

                                    <div class="row">
                                        <div class="form-outline mb-4 col-6" id="year">
                                            <label class="form-label" for="year">Godina osnutka</label>
                                            <input id="year" name="year" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4 col-6" id="contact">
                                            <label class="form-label" for="contact">Kontakt broj</label>
                                            <input id="contact" name="contact" class="form-control form-control-lg" />
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="desc">Opis</label>
                                        <textarea id="desc" name="desc" class="form-control form-control-lg"rows="11" cols="75" placeholder="Opis tko ste i što radite.."> </textarea>
                                    </div>
                                </div>

                                <div class="form-outline mb-4 col-6">
                                    <label class="form-label" for="pass">Šifra</label>
                                    <input type="password" id="pass" name="pass" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4 col-6">
                                    <label class="form-label" for="ppass">Ponovite šifru</label>
                                    <input type="password" id="ppass" name="ppass" class="form-control form-control-lg" />
                                </div>

                                <div class="pt-1 mb-4">
                                    <button class="btn btn-lg btn-block btn-primary" type="submit" name="submit" id="submit" value="signup">Registriraj me!</button>
                                </div>
                            </form>
                    
                        </div>
                    </div>
                    <div class="col-sm-4 px-0 d-none d-sm-block sticky">
                        <img src="https://images.unsplash.com/photo-1587554801471-37976a256db0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                    </div>
                    </div>
                </div>
            </section>
        </body>
        </html>


        <script>
            $(document).ready(function(){
                $('#companySignup').hide();
            });

            $('#loginSelect').on('change',function() {
            console.log($(this).val());

                if($(this).val() == 'student') {
                    $('#studentSignup').show();
                    $('#companySignup').hide();
                } else {
                    $('#studentSignup').hide();
                    $('#companySignup').show();
                }
            });
        </script>

	<?php
}


?>