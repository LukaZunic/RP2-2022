<?php		
include 'db.php'; 
crtaj_Forma("");

if(isset( $_POST["gumb"] ) && $_POST["gumb"] === "Pošalji" ){
    dodaj_studenta();
}

function crtaj_Forma($mess){
?>
<!DOCTYPE html>
<head>
<title>Registracija studenta</title>
</head>
<body>
    <h2>Unesite podatke</h2>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <dt><label for="ime">Ime</label></dt>
	<dd><input type="text" id="ime" name="ime" value="" /></dd>
    <dt><label for="prezime">Prezime</label></dt>
	<dd><input type="text" id="prezime" name="prezime" value="" /></dd>
    <dt><label for="name">JMBAG</label></dt>
    <dd><input type="number" id="jmbag" name="jmbag" value="" /></dd>
    <dt><label for="sifra_studenta">Šifra</label></dt>
	<dd><input type="password" id="sifra_studenta" name="sifra_studenta" value="" /></dd>
    <dt><label for="ppass">Ponovite šifru</label></dt>
    <dd><input type="password" id="ppass" name="ppass" value="" /></dd>
    <dd>
        <select name="studij" id="studij">
            <option selected="selected" disabled="disabled">Studij...</option>
            <option value="1">Prediplomski studij </option>
            <option value="2">Diplomski studij</option>
            <option value="3">Postdiplomski</option>
            <option value="4">Ostalo</option>
        </select>
    </dd>
    <dd>
        <select name="fakultet" id="fakultet">
            <option selected="selected" disabled="disabled">Fakultet...</option>
            <!--ovdje se moraju povuc u odabir svi fakulteti iz baze podataka-->>
            <option value="1">PMF</option>
            <!--vidi još za smjerove-->>
      
        </select>
    </dd>
    <dd>
        <select name="smjer" id="smjer">
            <option selected="selected" disabled="disabled">Smjer...</option>
            <!--ovdje se moraju povuc u odabir svi smjerovi iz fakulteti iz baze podataka-->>
            <option value="1">Računarstvo i matematika</option>
            <!--povuc smjerove iz fakulteta-->> 
      
        </select>
    </dd>
    <dd>
        <select name="godina" id="godina">
            <option selected="selected" disabled="disabled">Godina studija...</option>
            <option value="1">1.</option>
            <option value="2">2.</option>
            <option value="3">3.</option>
            <option value="4">4.</option>
            <option value="5">5.</option>
            <option value="6">6.</option>
        </select>
    </dd>
    <!--opcionalne stvari--> 
    <p><b>Opcionalno</b></p>
    <dt><label for="mail">E-mail adresa</label></dt>
	<dd><input type="text" id="mail" name="mail" value="" /></dd>  
    <dt><label for="prosjek">Prosjek ocjena</label></dt>
	<dd><input type="number" id="prosjek" step="0.01" name="prosjek" value="" /></dd> 
    <dt><label for="broj_mobitela">Broj mobitela</label></dt>
	<dd><input type="number" id="broj_mobitela" name="broj_mobitela" value="" /></dd> 
    <dt class="full" id="lastrow">
    <input type="submit" id="gumb" name="gumb" value="Pošalji" />
    </dt>
    </form> 


</body>

</html>

<?php
        }
    function dodaj_studenta(){        
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
    if(isset( $_POST["gumb" ] ) && $_POST["gumb"] === "Pošalji" ){
        if(isset($_POST['ime']) && $_POST['ime']!=""){
            $ime = $_POST['ime'];
        }
        else{
            $mess = "Niste unijeli ime!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['prezime']) && $_POST['prezime']!=""){
            $prezime = $_POST['prezime'];
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
        if(isset($_POST['sifra_studenta']) && $_POST['sifra_studenta']!=""){
            $sifra_studenta = $_POST['sifra_studenta'];
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
        if(isset($_POST['mail']) && $_POST['mail']!=""){
            $mail = $_POST['mail'];
            $def_mail=1; 
        }
        if(isset($_POST['broj_mobitela']) && $_POST['broj_mobitela']!=""){
            $broj_mobitela = $_POST['broj_mobitela'];
            $def_broj_mobitela=1; 
        }
        if(isset($_POST['prosjek']) && $_POST['prosjek']!=""){
            $prosjek = $_POST['prosjek'];
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
        }
    }
    ?>
    </form> 


</body>

</html>