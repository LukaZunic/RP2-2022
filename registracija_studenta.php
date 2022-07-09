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
            <option selected="selected" disabled="disabled">Fakultet...</option>
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
	<dd><input type="number" id="prosjek" name="prosjek" value="" /></dd> 
    <dt><label for="broj_mobitela">Broj mobitela</label></dt>
	<dd><input type="number" id="broj_mobitela" name="broj_mobitela" value="" /></dd> 
    <dt class="full" id="lastrow">
    <input type="submit" id="btnSubmit" name="btnSubmit" value="Pošalji" />
    </dt>
    <?php
        require_once 'db.php'; 
        $db = DB::getConnection();
        $ime,$prezime,$jmbag,$fakultet,$godina_studija,$studij="matematika", $sifra_studenta,$ponovljena_sifra,$sifra_studenta
        if(isset($_POST['ime'])){
            $ime = $_POST['ime'];
        }
        else{
        }
        if(isset($_POST['prezime'])){
            $prezime = $_POST['prezime'];
        }
        else{
        }
        if(isset($_POST['jmbag'])){
            $jmbag = $_POST['jmbag'];
        }
        else{
        }
        if(isset($_POST['sifra_studenta'])){
            $ponovljena_sifra = $_POST['sifra_studenta'];
        }
        else{
        }
        if(isset($_POST['ppass'])){
            $sifra_studenta = $_POST['ppass'];
        }
        else{
        }
        if($sifra_studenta !== $ponovljena_sifra){
        }
        if(isset($_POST['studij'])){
            $studij = $_POST['studij'];    
        }
        else{
        }
        if(isset($_POST['fakultet'])){
            $fakultet = $_POST['fakultet'];
        }
        else{
        }
        if(isset($_POST['godina'])){
            $godina = $_POST['godina'];
        }
        else{
        }
        echo '$jmbag,$ime,$prezime,$sifra_studenta,$fakultet,$studij,$godina_studija,$prosjek,$broj_mobitela'; 
        $db->exec("INSERT INTO student (jmbag,ime,prezime,sifra_studenta,fakultet,studij,smjer,godina_studija,prosjek,broj_mobitela" . "VALUES ($jmbag,$ime,$prezime,$sifra_studenta,$fakultet,$studij,$godina_studija,$prosjek,$broj_mobitela)");
    ?>
    </form> 


</body>

</html>