<?php
session_start();
?>

<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Szavazás</title>
    <link rel="icon" href="kepek/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/stilus.css">
    <link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
    <style>
        #oldal{
            border:2px solid white;
            box-shadow:10px 10px black;
            border-radius:10px;
            background-color: rgba(255,255,255,0.6);
            margin: 25px auto;
            width: 80%;
            font-size: 20px;
            padding: 10px;
        }
        .mappa{
            height: 30px;
            margin-top: 10px;
        }
        .gomb:hover{
            background-color:#888888;
            transition: all 0.5s;
            cursor: pointer;
        }
        .gomb{
            margin-top:10px;
            text-align: center;
            padding: 5px;
            background-color: white;
            border: solid 1px black;
            border-radius: 4px;
            display: block;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
<?php
if(!isset($_SESSION['nev']))
    header("Location: ../index.php");
else
    include "php/header_belepve.php";
?>

<div id="oldal">
<?php
$conn = mysqli_connect('mysql.omega:3306', 'programozz', 'Uqr1MERcE7') or die("Hibás csatlakozás: " . mysqli_error($conn));
mysqli_select_db($conn, 'programozz') or die("Adatbázishiba: " . mysqli_error($conn));
if (isset($_POST["letrehoz"])){
    $res=mysqli_query($conn, "SELECT Azonosito FROM szavazas ORDER BY Azonosito DESC LIMIT 1;");
    $res=mysqli_fetch_assoc($res);
    $azonosito=$res["Azonosito"]+1;
    $kerdes=$_POST["kerdes"];
    $tipus=$_POST["tipus"];
    $values="";
    if (mysqli_query($conn, "INSERT INTO szavazas VALUES ($azonosito, '$kerdes', '$tipus','')")){
        foreach ($_POST["kik"] as $ki){
            $values=$values."($ki, $azonosito,''),";
        }
        $values=substr($values,0,strlen($values)-1);
        mysqli_query($conn, "INSERT INTO szavaz VALUES ".$values.";");
        header("Location: szavazas.php?mes=Kérdés mentve!");
    }
}elseif(isset($_GET["torol"])){
    if (mysqli_query($conn, "DELETE FROM szavazas WHERE azonosito=".$_GET["torol"].";")){
        header("Location: szavazas.php?mes=Kérdés törölve!");
    }
}elseif (isset($_POST["modosit"])){
    $azonosito=$_GET["mod"];
    $kerdes=$_POST["kerdes"];
    $tipus=$_POST["tipus"];
    if(mysqli_query($conn, "UPDATE szavazas SET kerdes='$kerdes', tipus='$tipus'WHERE azonosito=$azonosito")){
        mysqli_query($conn,"DELETE FROM szavaz WHERE Szavazas_azonosito=$azonosito");
        foreach ($_POST["kik"] as $ki){
            $values=$values."($ki, $azonosito,''),";
        }
        $values=substr($values,0,strlen($values)-1);
        mysqli_query($conn, "INSERT INTO szavaz VALUES ".$values.";");
        header("Location: szavazas.php?mes=Kérdés módosítva!");
    }
}

if (!isset($_SESSION["nev"])){
    header("Location: index.php");
}elseif($_SESSION["nev"]=="Manhalter Patrik"){
    $res=mysqli_query($conn, 'SELECT * FROM szavazas');
    while($szavazas=mysqli_fetch_assoc($res)){
        echo '<a href="szavazas.php?torol='.$szavazas["Azonosito"].'"><img src="kepek/torles.png" class="mappa"></a>&nbsp;';
        echo '<a href="szavazas.php?mod='.$szavazas["Azonosito"].'"><img src="kepek/modosit.png" class="mappa"></a>&nbsp;';
        echo '<a href="php/szavazas.php?szavazas='.$szavazas["Azonosito"].'">'.$szavazas["Kerdes"].'</a><br><br>';
    }
    if(isset($_GET["mod"])){
        $res=mysqli_query($conn, "SELECT * FROM szavazas WHERE azonosito=".$_GET["mod"].";");
        $res=mysqli_fetch_assoc($res);
        echo "<br><h3>Szavazás módosítása</h3>";
        echo "<form action='szavazas.php?mod=" .$_GET["mod"]. "' method='post'>
        <label for='kerdes'>Kérdés: </label>
        <input type='text' id='kerdes' name='kerdes' value='".$res["Kerdes"]."'><br>
        <label for='tipus'>Szavazás típusa</label>
        <select id='tipus' name='tipus' size='1'>
            <option value='emoji' ".($res[$tipus]=="emoji"?"selected":" ").">Emoji</option>
            <option value='igazhamis' ".($res[$tipus]=="igazhamis"?"selected":" ").">Igaz / Hamis</option>
            <option value='szoveg' ".($res[$tipus]=="szoveg"?"selected":" ").">Szöveges válasz</option>
        </select><br>";
        $res=mysqli_query($conn, "SELECT Felhasznalo_azonosito as azon FROM szavaz WHERE Szavazas_azonosito=".$_GET["mod"].";");
        $kivalasztottak=[];
        while($kiv = mysqli_fetch_assoc($res)){
            array_push($kivalasztottak, $kiv["azon"]);
        }
        echo "<label for='kik'>kitöltők: </label>
        <select id='kik' name='kik[]' size='4' multiple='multiple'>";
        $res = mysqli_query($conn, "SELECT Nev, Azonosito FROM felhasznalok");
        while ($felhasznalo = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $felhasznalo["Azonosito"] . "' ".(in_array($felhasznalo["Azonosito"],$kivalasztottak)?'Selected':' ').">" . $felhasznalo["Nev"] . "</option>";
        }
        echo "
        </select><br>
        <input type='submit' class='gomb' name='modosit' value='Módosít'>
        </form>";

    }else{
        echo "<br><h3>Új szavazás létrehozása</h3>";
        echo "<form action='szavazas.php' method='post'>
            <label for='kerdes'>Kérdés: </label>
            <input type='text' id='kerdes' name='kerdes'><br>
            <label for='tipus'>Szavazás típusa</label>
            <select id='tipus' name='tipus' size='1'>
                <option value='emoji'>Emoji</option>
                <option value='igazhamis'>Igaz / Hamis</option>
                <option value='szoveg'>Szöveges válasz</option>
            </select><br>
            <label for='kik'>kitöltők: </label>
            <select id='kik' name='kik[]' size='4' multiple='multiple'>";
        $res = mysqli_query($conn, "SELECT nev, azonosito FROM felhasznalok");
        while ($felhasznalo = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $felhasznalo["azonosito"] . "'>" . $felhasznalo["nev"] . "</option>";
        }
        echo "</select><br>
            <input type='submit' class='gomb' name='letrehoz' value='Létrehoz'>
            </form>";
    }
    if (isset($_GET["mes"])){
        echo "<h3>".$_GET["mes"]."</h3>";
    }
}else{
    $res=mysqli_query($conn, 'SELECT * FROM szavazas, szavaz WHERE szavaz.Felhasznalo_azonosito='.$_SESSION["azonosito"].' AND szavaz.Szavazas_azonosito=szavazas.Azonosito;');
    while($szavazas=mysqli_fetch_assoc($res)){
        if($szavazas["Szavazat"]=="")
            echo '<a href="php/szavazas.php?szavazas='.$szavazas["Azonosito"].'">'.$szavazas["Kerdes"].'</a><br><br>';
        else
            echo $szavazas["Kerdes"].'<br><br>';
    }
    if (isset($_GET["mes"])){
        echo "<h3>".$_GET["mes"]."</h3>";
    }
}
?>
</div>
<?php
include "php/footer.php";
?>
</body>
</html>