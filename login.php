<?php		
    include 'db.php'; 
    crtaj_Forma("");
    session_start();
    if(isset( $_POST["gumb"] ) && $_POST["gumb"] === "Ulogiraj me!" ){
        ulogiraj();
    }
    function crtaj_Forma($mess){
?>
<!DOCTYPE html>
<head>
<title>Prijava</title>
</head>
<body>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <dd>
    <label for="tvrtka"><input type="radio" name="tip" id="tip_tvrtka" value="tvrtka" />Tvrtka</label>
	<label for="student"><input type="radio" name="tip" id="tip_student" value="student" checked />Student</label>
	</dd>
    <dt><label for="imetvrtke">Ime tvrtke</label></dt>
	<dd><input type="text" id="imetvrtke" name="imetvrtke" value="" /></dd>
    <dt><label for="jmbag">JMBAG</label></dt>
    <dd><input type="number" id="jmbag" name="jmbag" value="" /></dd>
    <dt><label for="pass">Šifra</label></dt>
	<dd><input type="password" id="pass" name="pass" value="" /></dd>
    <dt class="full" id="lastrow">
    <input type="submit"  id="gumb" name="gumb" value="Ulogiraj me!" />
    </dt>
</form>
</body>
</html>
<?php
}
function ulogiraj(){

    if (isset($_POST['tip']) && $_POST['tip'] == 'tvrtka'){
        spoji_tvrtku(); 
    }
    if (isset($_POST['tip']) && $_POST['tip'] == 'student'){
        spoji_studenta();
    }

}
function spoji_studenta(){
    $jmbag = 0; 
    $sifra_studenta = ""; 
    if(isset($_POST['pass']) && $_POST['pass']!=""){
        $sifra_studenta = $_POST['pass'];
    }
    else{
        echo "Unesite lozinku!\n";
        return; 
    }
    if(isset($_POST['jmbag']) && $_POST['jmbag']!=""){
        $jmbag = $_POST['jmbag'];
    }
    $db = DB::getConnection();
    $st = $db->query("SELECT jmbag,sifra_studenta FROM student WHERE jmbag = '$jmbag'");
    $postojeci = 0; 
    while ($row = $st->fetch()){
        if($jmbag == $row['jmbag']){
            if($sifra_studenta === $row['sifra_studenta']){
                echo "Uspješno ste se ulogirali!\n";
                //Ovdje login daljnji kod!
                $_SESSION["jmbag"] = $jmbag; 
                return; 
            }
            
        }
        else{
            echo "Krivi JMBAG ili šifra!\n"; 
            return; 
        }
        
    }

}
function spoji_tvrtku(){
    $ime = ""; 
    $sifra_tvrtke = ""; 
    if(isset($_POST['pass']) && $_POST['pass']!=""){
        $sifra_tvrtke = $_POST['pass'];
    }
    else{
        echo "Unesite lozinku!\n";
        return; 
    }
    if(isset($_POST['imetvrtke']) && $_POST['imetvrtke']!=""){
        $ime = $_POST['imetvrtke'];
    }
    $db = DB::getConnection();
    $st = $db->query("SELECT ime_tvrtke,sifra_tvrtke FROM tvrtke WHERE ime_tvrtke = '$ime'");
    $postojeci = 0; 
    while ($row = $st->fetch()){
        if($ime === $row['ime_tvrtke']){
            if($sifra_tvrtke === $row['sifra_tvrtke']){
                echo "Uspješno ste se ulogirali!\n";
                //Ovdje login daljnji kod!
                $_SESSION["ime_tvrtke"] = $ime; 
                return; 
            }
            
        }
        else{
            echo "Krivo ime tvrtke ili šifra!\n"; 
            return; 
        }
        
    }

}
?>