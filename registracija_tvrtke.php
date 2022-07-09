<?php		
include 'db.php'; 


crtaj_Forma("");

if(isset( $_POST["gumb"] ) && $_POST["gumb"] === "Pošalji" ){
    dodaj_tvrtku();
}

function crtaj_Forma($mess){
?>

<!DOCTYPE html>
<head>
<title>Registracija tvrtke</title>
</head>

<body>  
    <h2>Unesite podatke</h2>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <dt><label for="imetvrtke">Ime tvrtke</label></dt>
	<dd><input type="text" id="imetvrtke" name="imetvrtke" value="" /></dd>
    <dt><label for="adresa">Adresa</label></dt>
	<dd><input type="text" id="adresa" name="adresa" value="" /></dd>
    <dt><label for="telefon">Telefon</label></dt>
    <dd><input type="text" id="telefon" name="telefon" value="" /></dd>
    <dt><label for="godina_osnutka">Godina osnutka</label></dt>
    <dd><input type="number" id="godina_osnutka" name="godina_osnutka" value="" /></dd>
    <dt><label for="mail">E-mail adresa</label></dt>
	<dd><input type="text" id="mail" name="mail" value="" /></dd> 
    <dt><label for="sifra_tvrtke">Šifra</label></dt>
	<dd><input type="password" id="sifra_tvrtke" name="sifra_tvrtke" value="" /></dd>
    <dt><label for="ppass">Ponovite šifru</label></dt>
    <dd><input type="password" id="ppass" name="ppass" value="" /></dd>
    <dt><label for="opis">Opis</label></dt>
	<dd><textarea name="opis" id="opis" rows="11" cols="75">Opis tko ste Vi i čime se bavite... </textarea></dd>
    <dt class="full" id="lastrow">
    <input type="submit"  id="gumb" name="gumb" value="Pošalji" />
    </dt>
    </form>
    <?php
       
    }
   
    function dodaj_tvrtku(){

        $imetvrtke = ""; 
        $adresa = ""; 
        $telefon = ""; 
        $godina_osnutka = 0; 
        $mail = ""; 
        $sifra_tvrtke=""; 
        $ppass = ""; 
        $opis = ""; 
        if(isset($_POST['imetvrtke']) && $_POST['imetvrtke']!=""){
            $ime_tvrtke = $_POST['imetvrtke'];
        }
        else{
            $mess = "Niste unijeli ime tvrtke!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['adresa']) && $_POST['adresa']!=""){
            $adresa = $_POST['adresa'];
            
        }
        else{
            $mess = "Niste unijeli adresu!\n"; 
            echo $mess;
            return;  
        }
        if(isset($_POST['telefon']) && $_POST['telefon']!=""){
            $telefon = $_POST['telefon'];
        }
        else{
            $mess = "Niste unijeli telefonski broj!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['godina_osnutka']) && $_POST['godina_osnutka']!=""){
            $godina_osnutka = $_POST['godina_osnutka'];
        }
        else{
            $mess = "Niste unijeli godinu osnutka!\n";
            echo $mess; 
            return;        
        }
        if(isset($_POST['mail']) && $_POST['mail']!=""){
            $mail = $_POST['mail'];
        }
        else{
            $mess = "Niste unijeli ime e-mail adresu!\n"; 
            echo $mess;
            return; 
        }
        if(isset($_POST['sifra_tvrtke']) && $_POST['sifra_tvrtke']!=""){
            $sifra_tvrtke = $_POST['sifra_tvrtke'];
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
        if(isset($_POST['opis']) && $_POST['opis']!=""){
            $opis = $_POST['opis'];
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
                $db->exec("INSERT INTO tvrtke (ime_tvrtke,adresa,telefon,mail_adresa,sifra_tvrtke,opis,godina_osnutka)" . " VALUES('$ime_tvrtke','$adresa','$telefon','$mail','$sifra_tvrtke','$opis','$godina_osnutka')");
                echo "Vaša tvrtka je uspješno registrirana!\n"; 
            }
            
    }

    ?>
    

    
</body>


</html>