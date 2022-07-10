<?php		
    include '../server/db.php'; 
    crtaj_Forma("");
    if(isset($_POST["submit"]) && $_POST["submit"] === "Pošalji!" ){
        echo "<script>alert('Uspješno ste poslali prijavu')</script>";
        ulogiraj();
    }
    function crtaj_Forma(){
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
<body>
    <!-- <form name="form1" method="post" action="<?php // echo $_SERVER['PHP_SELF']; ?>" >
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
    </form> -->
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6 text-black mt-5">

                <div class="row">
                    <div class="px-5 ms-xl-4 col-8">
                        <i class="fa fa-code-fork fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0 mt-5">Studentski portal</span>
                    </div>
                    <div class="px-5 mt-xl-4 col">
                        <label for="loginSelect" class="mb-1 mt-3">Ja sam:</label>
                        <select class="form-select form-select-sm mb-3" id="loginSelect" aria-label=".form-select-lg example">
                            <option value="student" selected>Student</option>
                            <option value="company">Firma</option>
                        </select>
                    </div>
                </div>
                

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  style="width: 23rem;">

                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Ulogiraj se!</h3>

                        <div class="form-outline mb-4" id="jmbagInput">
                            <label class="form-label" for="jmbag">JMBAG</label>
                            <input id="jmbag" name="jmbag" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4" id="companyInput">
                            <label class="form-label" for="company">Ime Firme</label>
                            <input type="email" id="company" name="company" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="pass">Šifra</label>
                            <input type="password" id="pass" name="pass" class="form-control form-control-lg" />
                        </div>

                        <div class="pt-1 mb-4">
                            <button class="btn btn-lg btn-block btn-primary" type="submit" name="submit" id="submit">Pošalji</button>
                        </div>

                        <!-- <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p> -->
                        <p>Nemate račun? <a href="#!" class="link-info">Registrirajte se ovdje</a></p>

                    </form>
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
                $_SESSION['tip_korisnika'] = 'student';
                header("Location: ../index.php");
                return; 
            }     
        } else{
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
    $st = $db->query("SELECT ime_tvrtke, sifra_tvrtke FROM tvrtke WHERE ime_tvrtke = '$ime'");
    $postojeci = 0; 
    while ($row = $st->fetch()){
        if($ime === $row['ime_tvrtke']){
            if($sifra_tvrtke === $row['sifra_tvrtke']){
                echo "Uspješno ste se ulogirali!\n";
                //Ovdje login daljnji kod!
                $_SESSION["ime_tvrtke"] = $ime; 
                header("Location: /");

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