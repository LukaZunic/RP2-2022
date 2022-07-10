<?php
include 'db.php'; 
session_start();
function validate( $user, $pass,$user_type ) {
	// Popis svih korisnika koji smiju i njihovih šifri. (Ovo se inače dohvaća iz baze podataka.)
    $db = DB::getConnection();
    echo "u validate sam\n";
    if($user_type === "tvrtka"){
        $st = $db->query("SELECT ime_tvrtke,sifra_tvrtke FROM tvrtke WHERE ime_tvrtke = '$ime'");
        while ($row = $st->fetch()){
            $users = array(
                $row["ime_tvrtke"] => $row["sifra_tvrtke"]
            );
        }
    }
    else{
        $st = $db->query("SELECT jmbag,sifra_studenta FROM tvrtke WHERE ime_tvrtke = '$ime'");
        while ($row = $st->fetch()){
            $users = array(
                $row["jmbag"] => $row["sifra_studenta"]
            );
        }
        echo $users;
    }
	if( isset( $users[$user] ) && ( $users[$user] === $pass ) )
		return true;
	else
	    return false;
}

$secret_word = 'Projekt';
if( isset( $_POST['username'] ) 
	&& isset( $_POST['pass'] ) 
	&& isset($_POST['gumb']) && $_POST['gumb'] === 'Ulogiraj se!' && validate( $_POST['username'], $_POST['pass'],$_POST['tip'])){
	$_SESSION['login'] = $_POST['username'] . ',' . md5( $_POST['username'] . $secret_word );
}

unset( $username );
if( isset( $_SESSION['login'] ) ) 
{
	list( $c_username, $cookie_hash ) = explode( ',' , $_SESSION['login'] );

	if( md5( $c_username . $secret_word ) === $cookie_hash )
		$username = $c_username;
	else
		echo "Poslan je pokvareni kolačić" ;
}
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
    <br>
    <dt><label for="imetvrtke">Ime tvrtke</label></dt>
	<dd><input type="text" id="imetvrtke" name="imetvrtke" value="" /></dd>
    <br>
    <dt><label for="jmbag">JMBAG</label></dt>
    <dd><input type="number" id="jmbag" name="jmbag" value="" /></dd>
    <br>
    <dt><label for="pass">Šifra</label></dt>
	<dd><input type="password" id="pass" name="pass" value="" /></dd>
    <dt class="full" id="lastrow">
    <br>
    <input type="submit"  id="gumb" name="gumb" value="Ulogiraj se!" />
    </dt>
</form>
</body>
</html>