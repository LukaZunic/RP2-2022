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
                                <p>Nemate račun? <button id="signup" value="signup"><a href="#!" class="link-info">Registrirajte se ovdje</a></button></p>

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
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf8" />
		<title>Login</title>
	</head>
	<body>
		<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
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
	</html>
	<?php
}


?>