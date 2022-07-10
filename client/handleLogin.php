<?php

require_once '../server/db.php';
require_once 'loginForm.php';

session_start();


function processLogin(){

    //   if(!isset($_POST["username"]) || preg_match('/[a-zA-Z]{1, 20}/', $_POST["username"])){
    // 		drawLoginForm();
    //   }

    //   if(!isset($_POST["password"])){
    // 		drawLoginForm();
    //   }

    $db = DB::getConnection();

    $user_type = $_POST['loginSelect'];
    echo $user_type;

    if($user_type == 'student') {

        try{
            // $st = $db->prepare('SELECT sifra_studenta FROM student WHERE jmbag=:jmbag');
            $st = $db->prepare('SELECT sifra_studenta FROM student WHERE jmbag=:jmbag');
            $st->execute(array('jmbag' => $_POST["jmbag"]));
        } catch (PDOException $e){
            drawLoginForm('Greška:' . $e->getMessage());
            return;
        }
    } else if($user_type == 'company') {
        try{
            // $st = $db->prepare('SELECT sifra_studenta FROM student WHERE jmbag=:jmbag');
            $st = $db->prepare('SELECT sifra_tvrtke FROM tvrtke WHERE ime_tvrtke=:ime_tvrtke');
            $st->execute(array('ime_tvrtke' => $_POST["company"]));
        } catch (PDOException $e){
            drawLoginForm('Greška:' . $e->getMessage());
            return;
        }
    }


  $row = $st->fetch();

  if($row === false){
    echo '<script>console.log("nema")</script>';
    drawLoginForm('Korisnik ne postoji!');
    return;
  }

    if($user_type == 'student') {
       
        if(!password_verify($_POST["pass"], $row["sifra_studenta"])){
            drawLoginForm('Pogrešna lozinka!');
            return;
        }
        $_SESSION["username"] = $_POST["company"];
        $_SESSION['user_type'] = 'student';

    } else if($user_type == 'company') {
        if(!password_verify($_POST["pass"], $row["sifra_tvrtke"])){
            drawLoginForm('Pogrešna lozinka!');
            return;
        }
        $_SESSION["username"] = $_POST["jmbag"];
        $_SESSION['user_type'] = 'company';
    }

//   if(!password_verify($_POST["pass"], $row["sifra_studenta"])){
//     drawLoginForm('Pogrešna lozinka!');
//     return;
//   }

//   $_SESSION['user_type'] = $user_type;

  header('Location: /client');
  exit;

}


function processSignup(){
	if(!isset($_POST["username"]) || preg_match('/[a-zA-Z]{1, 20}/', $_POST["username"]))
		drawLoginForm();

	if(!isset($_POST["password"]))
		drawLoginForm();

	$db = DB::getConnection();

	try{
		$st = $db->prepare('SELECT password_hash FROM dz2_users WHERE username=:username');
		$st->execute(array('username' => $_POST["username"]));
	}	
	catch(PDOException $e){ drawLoginForm('Greška:' . $e->getMessage()); return; }

	if($st->rowCount() > 0){
		drawLoginForm('Taj korisnik već postoji.');
		return;
	}
	else{
		try{
            $registration_sequence = 'abc';
            $has_registered = 1;

                    $st = $db->prepare('INSERT INTO dz2_users (username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :hash, :email, :registration_sequence, :has_registered)');
                    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $st->execute(array('username' => $_POST["username"], 'hash' => $hash, 'email' => $_POST["email"], 'registration_sequence' => $registration_sequence, 'has_registered' => $has_registered));
                }
                catch(PDOException $e){ drawLoginForm('Greška:' . $e->getMessage()); return; }

                drawLoginForm('Novi korisnik je uspješno dodan!');
	}
}


if(isset($_POST["submit"]) && $_POST["submit"] === "login") {
    echo '<script>console.log("posalji");</script>';
	processLogin();
}
else if(isset($_POST["submit"]) && $_POST["submit"] === "novi")
  drawSignupForm();
else if(isset($_POST["submit"]) && $_POST["submit"] === "signup")
  processSignup();
else
	drawLoginForm();

?>