<?php

require_once '../server/db.php';
require_once 'loginForm.php';

session_start();


function processLogin(){

    $db = DB::getConnection();
    $user_type = $_POST['loginSelect'];

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
        // echo '<script>console.log("nema")</script>';
        drawLoginForm('Korisnik ne postoji!');
        return;
    }

    if($user_type == 'student') {
       
        if(!password_verify($_POST["pass"], $row["sifra_studenta"])){
            drawLoginForm('Pogrešna lozinka!');
            return;
        }
        $_SESSION["username"] = $_POST["jmbag"];
        echo '<script>console.log('.$_SESSION['username'] .'</script>';
        $_SESSION['user_type'] = 'student';

    } else if($user_type == 'company') {
        if(!password_verify($_POST["pass"], $row["sifra_tvrtke"])){
            drawLoginForm('Pogrešna lozinka!');
            return;
        }
        $_SESSION["username"] = $_POST["company"];
        $_SESSION['user_type'] = 'company';
    }

  header('Location: /client');
  exit;

}


function processSignup(){

    $db = DB::getConnection();

    $user_type = $_POST['loginSelect'];
    echo '<script>console.log("'.$user_type .'")</script>';

    if($user_type === 'student') {
        echo '<script>console.log("tu sam")</script>';


        $jmbag;
        $ime;
        $prezime;
        $sifra_studenta="a";
        $ponovljena_sifra="b";
        $fakultet;
        $studij;
        $smjer;
        $godina_studija;
        $prosjek=0;
        $broj_mobitela=0;
        $def_prosjek=0;
        $def_broj_mobitela=0;
        $mail="";
        $def_mail=0; 

        if(isset( $_POST["submit"]) && $_POST["submit"] === "signup"){

            if(isset($_POST['name']) && $_POST['name']!=""){
                $ime = $_POST['name'];
            }
            else{
                $mess = "Niste unijeli ime!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['surname']) && $_POST['surname']!=""){
                $prezime = $_POST['surname'];
            }
            else{
                $mess = "Niste unijeli prezime!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['jmbag']) && $_POST['jmbag']!=""){
                $jmbag = $_POST['jmbag'];
            }
            else{
                $mess = "Niste unijeli JMBAG!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['pass']) && $_POST['pass']!=""){
                $sifra_studenta = $_POST['pass'];
            }
            else{
                $mess = "Niste unijeli šifru!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['ppass']) && $_POST['ppass']!=""){
                $ponovljena_sifra = $_POST['ppass'];
            }
            else{
                $mess = "Niste ponovili šifru!\n"; 
                echo $mess;
                return; 
            }

            if($sifra_studenta !== $ponovljena_sifra){
                $mess = "Šifre se ne poklapaju!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['studij']) && $_POST['studij']!=""){
                $studij = $_POST['studij'];    
            }
            else{
                $mess = "Niste odabrali studij!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['fakultet']) && $_POST['fakultet']!=""){
                $fakultet = $_POST['fakultet'];
            }
            else{
                $mess = "Niste odabrali fakultet!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['godina']) && $_POST['godina']!=""){
                $godina_studija = $_POST['godina'];
            }
            else{
                $mess = "Niste odabrali godinu studija!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['smjer']) && $_POST['smjer']!=""){
                $smjer = $_POST['smjer'];
            }
            else{
                $mess = "Niste odabrali smjer!\n"; 
                echo $mess;
                return; 
            }

            if(isset($_POST['e-mail']) && $_POST['e-mail']!=""){
                $mail = $_POST['e-mail'];
                $def_mail=1; 
            }

            if(isset($_POST['phone']) && $_POST['phone']!=""){
                $broj_mobitela = $_POST['phone'];
                $def_broj_mobitela=1; 
            }

            if(isset($_POST['gpa']) && $_POST['gpa']!=""){
                $prosjek = $_POST['gpa'];
                $def_prosjek=1; 
            }
            
    
            $db = DB::getConnection();
            $st = $db->query("SELECT jmbag FROM student");
            $postojeci = 0; 
            while ($row = $st->fetch()){
                if($jmbag === $row['jmbag']){
                    echo "JMBAG " . $jmbag . " je već registriran!";
                    $postojeci = 1;
                    break;
                }
            }

            if(!($postojeci)){
                if($def_broj_mobitela && $def_mail && $def_prosjek){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,prosjek,mail,broj_mobitela)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$prosjek','$mail','$broj_mobitela')");
                }
                else if($def_broj_mobitela && $def_mail){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,mail,broj_mobitela)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$mail','$broj_mobitela')");
                }
                else if($def_broj_mobitela && $def_prosjek){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,prosjek,broj_mobitela)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$prosjek','$broj_mobitela')");
                }
                else if($def_prosjek && $def_mail){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,prosjek,mail)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$prosjek','$mail')");
                }
                else if($def_broj_mobitela){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,broj_mobitela)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$broj_mobitela')");
                }
                else if($def_mail){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,mail)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$mail')");
                }
                else if($prosjek){
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,prosjek)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija','$prosjek')");
                }
                else{
                    $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija)" . " VALUES($jmbag,'$ime','$prezime','$sifra_studenta','$fakultet','$studij','$smjer','$godina_studija')");
                }
                echo "Uspješno ste se registrirali!\n"; 
            }
            header("Location: handleLogin.php");
            
            
    } else if($user_type === 'company') {

        $imetvrtke = ""; 
        $adresa = ""; 
        $telefon = ""; 
        $godina_osnutka = 0; 
        $mail = ""; 
        $sifra_tvrtke=""; 
        $ppass = ""; 
        $opis = ""; 
        if(isset($_POST['company']) && $_POST['company']!=""){
            $ime_tvrtke = $_POST['company'];
        }
        else{
            $mess = "Niste unijeli ime tvrtke!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['adress']) && $_POST['adress']!=""){
            $adresa = $_POST['adress'];
            
        }
        else{
            $mess = "Niste unijeli adresu!\n"; 
            echo $mess;
            return;  
        }
        if(isset($_POST['contact']) && $_POST['contact']!=""){
            $telefon = $_POST['contact'];
        }
        else{
            $mess = "Niste unijeli telefonski broj!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['year']) && $_POST['year']!=""){
            $godina_osnutka = $_POST['year'];
        }
        else{
            $mess = "Niste unijeli godinu osnutka!\n";
            echo $mess; 
            return;        
        }
        if(isset($_POST['email']) && $_POST['email']!=""){
            $mail = $_POST['email'];
        }
        else{
            $mess = "Niste unijeli ime e-mail adresu!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['pass']) && $_POST['pass']!=""){
            $sifra_tvrtke = $_POST['pass'];
        }
        else{
            $mess = "Niste unijeli šifru tvrtke!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['ppass']) && $_POST['ppass']!=""){
            $ppass = $_POST['ppass'];
        }
        else{
            $mess = "Niste unijeli ponovljenu lozinku!\n"; 
            echo $mess;
            return; 
        }
        if($ppass !== $sifra_tvrtke){
            $mess = "Lozinke koje ste unijeli nisu jednake!\n";
            echo $mess; 
            return; 
        }
        if(isset($_POST['desc']) && $_POST['desc']!=""){
            $opis = $_POST['desc'];
        }
        else{
            $mess = "Morate ostaviti opis vaše tvrtke!\n"; 
            echo $mess;
            return;
        }
    
        $db = DB::getConnection();
        $st = $db->query("SELECT ime_tvrtke FROM tvrtke");
           
            $postojeci = 0; 
            while ($row = $st->fetch()){
                if($ime_tvrtke === $row['ime_tvrtke']){
                    echo "Tvrtka pod imenom " . $ime_tvrtke . " je već registrirana!";
                    $postojeci = 1;
                    return;
                }
            }
            if(!($postojeci)){
                $hash = password_hash($_POST["pass"], PASSWORD_DEFAULT);
                $db->exec("INSERT INTO tvrtke (ime_tvrtke,adresa,telefon,mail_adresa,sifra_tvrtke,opis,godina_osnutka)" . " VALUES('$ime_tvrtke','$adresa','$telefon','$mail','$hash','$opis','$godina_osnutka')");
                echo "Vaša tvrtka je uspješno registrirana!\n"; 
            }
    }

	

}


}
if(isset($_POST["submit"]) && $_POST["submit"] === "login") {
	processLogin();
}
else if(isset($_POST["signup"]) && $_POST["signup"] === "signup")
    drawSignupForm();
else if(isset($_POST["submit"]) && $_POST["submit"] === "signup")
    processSignup();
else
    drawLoginForm();

?>