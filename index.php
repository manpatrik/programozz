<?php
session_start();
$conn = mysqli_connect('mysql.omega:3306', 'programozz', 'Uqr1MERcE7') or die("Hibás csatlakozás: " . mysqli_error($conn));
mysqli_select_db($conn, 'programozz') or die("Adatbázishiba: " . mysqli_error($conn));
$azon=$_SESSION["azonosito"];
if(isset($_POST["bejelentkezes"])){
    $felhasznalonev = $_POST["felhasznalonev"];
    $jelszo = $_POST["jelszo"];
    echo $jelszo;
    $jelszo = hash_hmac('ripemd160', $jelszo, 'secret');
    if(!empty($felhasznalonev) && !empty($jelszo)){
        $res = mysqli_query($conn, "SELECT COUNT(*) as a, Azonosito FROM felhasznalok WHERE Nev='$felhasznalonev' AND Jelszo='$jelszo';");
        $felh=mysqli_fetch_assoc($res);
        if ($felh["a"] != 0) {
            $_SESSION['nev'] = $felhasznalonev;
            $_SESSION['azonosito'] = $felh["Azonosito"];
            $_SESSION['profkep'] = "prof.jpg";
            header("Location: index.php");
        } else {
            header("Location: index.php?err=Rossz felhasználónév vagy jelszó!");
        }
    }
}elseif(!empty($_SESSION['nev']) && isset($_POST["kijelentkezes"])){
    unset($_SESSION['nev']);
    unset($_SESSION['profkep']);
    unset($_SESSION['azonosito']);
    header("Location: index.php");
}elseif (isset($_POST["emailvalt"])){
    $email=$_POST["email"];
    $hazi=$_POST["ujhazi"]==1?1:0;
    $jelszo=$_POST["regijelszo"];
    $ujjelszo=$_POST["ujjelszo"];
    $ujjelszo2=$_POST["ujjelszo2"];
    $res=mysqli_query($conn, "UPDATE felhasznalok SET Email='$email', Ertesites_hazi=$hazi WHERE Azonosito=$azon;");
    if(!empty($jelszo) && !empty($ujjelszo) && !empty($ujjelszo2)){
        if ($ujjelszo2==$ujjelszo){
            $res=mysqli_query($conn, "SELECT Jelszo FROM felhasznalok WHERE Azonosito=$azon;");
            $regijelszo=mysqli_fetch_assoc($res)["Jelszo"];
            if (hash_hmac('ripemd160', $jelszo, 'secret')==$regijelszo){
                $ujjelszo=hash_hmac('ripemd160', $ujjelszo, 'secret');
                $res=mysqli_query($conn, "UPDATE felhasznalok SET Jelszo='$ujjelszo' WHERE Azonosito=$azon;");
                header("Location: index.php?err=Változtatások mentve!");
            }else{
                header("Location: index.php?err=Hibás régi jelszó!");
            }
        }else{
            header("Location: index.php?err=A két jelszó nem egyezik!");
        }
    }else{
        if (!empty($jelszo) || !empty($ujjelszo) || !empty($ujjelszo2)){
            header("Location: index.php?err=Nem adtál meg minden adatot!");
        }else{
            header("Location: index.php?err=Változtatások mentve!");
        }
    }
}
?>

<html lang="hu">
<head>
    <meta charset="utf-8">
    <title><?php
        if(!isset($_SESSION['azonosito']))
            echo "Belépés";
        else
            echo "Kilépés";
        ?></title>
    <link rel="icon" href="kepek/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/stilus.css">
    <link rel="stylesheet" type="text/css" href="css/belepes.css">
    <link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
</head>
<body>
<?php
if(!isset($_SESSION['nev']))
    include "php/header_kilepve.php";
else
    include "php/header_belepve.php";
?>

<div id="oldal">
    <?php
    if(!isset($_SESSION['nev'])){
        echo
        '<form method="post" action="index.php" id="belepes">
							<fieldset>
								<legend>Belépés</legend>
								<img id="profilkep" src="kepek/prof.jpg"/>
								<label for="felhasznalonev">Felhasználónév:</label><br/>
								<input type="text" id="felhasznalonev" name="felhasznalonev"><br/>
								<label for="jelszo">Jelszó:</label><br/>
								<input type="password" id="jelszo" name="jelszo"><br/>
								<input type="submit" value="Belépés" id="belepesgomb" class="gomb" name="bejelentkezes">
								' .(isset($_GET["err"])?"<br><h3>".$_GET["err"]."</h3>":"").'
								<a style="color: white" href="php/elfelejtettjelszo.php">Elfelejtett jelszó</a>
							</fieldset>
						</form>';
    }else{
        $res= mysqli_query($conn, "SELECT Ertesites_hazi as hazi, Email FROM felhasznalok WHERE Azonosito=$azon");
        $adatok=mysqli_fetch_assoc($res);
        echo
            '<form method="post" action="index.php" id="formm">
							<fieldset><legend>kilépés</legend>
								<img id="profilkep" src="kepek/' .$_SESSION['profkep'].'"/><br/>
								<p id="befelhnev">Üdv '.$_SESSION['nev'].'!</p>
								<input style="margin-bottom: 20px;" type="submit" value="Kilépés" id="belepesgomb" class="gomb" name="kijelentkezes">
								<label  for="email">Email: </label>
                                <input type="email" id="email" name="email" value="'.$adatok["Email"].'" placeholder="Email"><br>
                                <input type="checkbox" id="ertesites" style="margin-bottom: 15px" name="ujhazi" value="1" '.($adatok["hazi"]==1?"checked":"").'>
                                <label for="ertesites"> Értesítés új háziról</label><br>
                                <label for="regijelszo" >Régi jelszó: </label>
                                <input type="password" id="regijelszo" name="regijelszo" ><br>
                                <label for="ujjelszo">Új jelszó: </label>
                                <input type="password" id="ujjelszo" name="ujjelszo"><br>
                                <label for="ujjelszo2">Új jelszó: </label>
                                <input type="password" id="ujjelszo2" name="ujjelszo2"><br>
                                <input type="submit" id="emailvalt" name="emailvalt" class="gomb" value="Ment">
                                '.(isset($_GET["err"])?"<br><h3>".$_GET["err"]."</h3>":"").'
							</fieldset>
						</form>';
    }
    ?>


</div>
</body>
</html>