<?php
session_start();
if (!isset($_SESSION["nev"])){
    header("Location: index.php");
}
$conn = mysqli_connect('mysql.omega:3306', 'programozz', 'Uqr1MERcE7') or die("Hibás csatlakozás: " . mysqli_error($conn));
mysqli_select_db($conn, 'programozz') or die("Adatbázishiba: " . mysqli_error($conn));
?>

<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Fájlok</title>
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
        #gombid:hover{
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
        label#feladatmegoldasom{
            text-decoration: underline;
            color: blue;
        }
        label#feladatmegoldasom:hover{
            cursor: pointer;
        }
    </style>
    <script>
    </script>
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
    function vissza($dir){
        if(array_search("Manhalter Patrik",$dir)>=0 && $_SESSION["nev"]!="Manhalter Patrik" && substr_count($dir,"/")==1){
            return $_SESSION["nev"];
        }
        $i = strlen($dir) - 1;
        while ($i >= 0 && $dir[$i] != "/") {
            $i--;
        }
        $dir = substr($dir, 0, $i);
        return $dir;
    }

    function megnyit(){
        $dir=$_GET["dir"];
        if($_SESSION["nev"]=="Manhalter Patrik"){
            $modosithat=True;
        }elseif(substr_count($dir,"Manhalter Patrik")>0){
            $modosithat=False;
        }else{
            $modosithat=True;
        }
        $mappa="./fajlok/".$dir."/";
        $fajlok=scandir($mappa);
        if(substr_count($dir, '/')==0){
            echo $dir."/<br>";
            echo '<form action="fajlkezelo.php?uj=megoldas&dir='.$dir.'" method="post" enctype="multipart/form-data">
                <img class="mappa" src="kepek/megosztottmappa.png">
                <label id="feladatmegoldasom" for="filemegoldas">
                    Feladatmegoldásom
                </label>
                <input type="file" name="file" id="filemegoldas" onchange="this.form.submit()" style="display: none;">
              </form>';
            echo "                           
                  <img class='mappa' src='kepek/megosztottmappa.png'>\t<a href='fajlkezelo.php?dir=Manhalter Patrik/Megosztott fájlok'>Megosztott fájlok</a><br><br>
                  <img class='mappa' src='kepek/megosztottmappa.png'>\t<a href='fajlkezelo.php?dir=Manhalter Patrik/Házi feladatok'>Házi feladatok</a><br><br>";
        }else{
            echo "<a href='fajlkezelo.php?dir=".vissza($_GET["dir"])."'><img class='mappa' src='kepek/vissza.png'></a>".$dir."/<br>";
        }

        foreach ($fajlok as $fajl){
            if (!in_array($fajl,array(".",".."))){ // kiveszi a . és .. ot az elejéről
                if (is_dir($mappa."/".$fajl)){
                    echo "<form action='fajlkezelo.php?dir=$dir' method='post'>
                          <input type='text' name='fajl' value='$fajl' style='display: none;'>";
                    echo $modosithat?"<label for='$fajl'><img class='mappa' src='kepek/torles.png'>&nbsp;</label>
                          <input type='submit' id='$fajl' name='torol' style='display: none;float: right;'>":"";
                    echo"<img class='mappa' src='kepek/mappa.png'>\t<a href='fajlkezelo.php?dir=$dir/$fajl'>$fajl</a><br></form>";
                }else{
                    echo "<form action='fajlkezelo.php?dir=$dir' method='post'>
                            <input type='text' name='fajl' value='$fajl' style='display: none;'>";
                    echo $modosithat?"<label for='$fajl'><img class='mappa' src='kepek/torles.png' style='float: left;'>&nbsp;</label>
                            <input type='submit' id='$fajl' name='torol' style='display: none;'>  ":"";
                    echo "<img class='mappa' src='kepek/file.png'> \t<a href='$mappa$fajl' download> $fajl</a><br></form>";
                }
            }
        }
        echo $modosithat?'<form action="fajlkezelo.php?uj=fajl&dir='.$dir.'" method="post" enctype="multipart/form-data">
                <label for="file">
                    <img class="mappa" src="kepek/ujfajl.png">
                </label>
                <input type="file" name="file[]" id="file" multiple="multiple" onchange="this.form.submit()" style="display: none;"><br>
                <img class="mappa" src="kepek/ujmappa.png" onclick=\'javascript:document.getElementById("ujmappanev").style.display="block";
            document.getElementById("gombid").style.display="block";\' style="float: left;margin-top:25px; "><br>
                <input type="text" id="ujmappanev" name="ujmappanev" placeholder="mappa neve" class="gomb" style="float: left;margin-top: 4px;margin-left: 10px;display: none;">
                <input type="submit" name="ujmappa" value="Létrehoz" class="gomb" id="gombid" style="float: left;margin-top: 4px;margin-left: 10px;display: none;">
                <br>
                </form>':'';
    }

    function rmdir_R($dir){
        $fajlok=scandir($dir);
        foreach ($fajlok as $fajl){
            if (!in_array($fajl,array(".",".."))){ // kiveszi a . és .. ot az elejéről
                if (is_dir($dir."/".$fajl)){
                    rmdir_R("$dir/$fajl");
                    rmdir("$dir/$fajl");
                }else{
                    unlink("$dir/$fajl");
                }
            }
        }
    }

    if (isset($_POST["torol"])){
        $dir=$_GET["dir"];
        $mappa="./fajlok/".$dir."/";
        $link=$mappa.$_POST["fajl"];
        if(substr_count($link,".")==2){
            unlink($link);
            echo "Fájl törölve! <br><br>";
        }else{
            rmdir_R($link);
            rmdir($link);
            echo "Mappa törölve! <br><br>";
        }
    }

    $dir=$_GET["dir"];
    if(!isset($_POST["ujmappa"])){ //ujmappa, fájlfeltöltés
        if(isset($_GET["uj"])){
            if($_GET["uj"]=="fajl") {
                // A fájlok száma
                $countfiles = count($_FILES['file']['name']);
                // Sorra vesszük a fájlokat
                for ($i = 0; $i < $countfiles; $i++) {
                    $filename = $_FILES['file']['name'][$i];
                    //Feltöltött fájl elmentése
                    $FajlNev = $_FILES["file"]["name"][$i];
                    $Forras = $_FILES["file"]["tmp_name"][$i];
                    $Cel = "./fajlok/$dir/" . $_FILES["file"]["name"][$i];
                    if (file_exists($Cel)) {
                        header("Location: fajlkezelo.php?uj=A fájl már létezik! <br><br>&dir=$dir");
                    } else {
                        move_uploaded_file($Forras, $Cel);
                        header("Location: fajlkezelo.php?uj=Feltöltve!<br><br>&dir=$dir");
                    }

                }
                if (substr_count($dir,"Házi feladatok")>0){
                    $res = mysqli_query($conn,"SELECT Email FROM felhasznalok WHERE Ertesites_hazi=1");
                    $to="";
                    while ($email=mysqli_fetch_assoc($res)["Email"]){
                        $to.=$email.",";
                    }
                    $to=substr($to, 0, strlen($to)-1);
                    $subject = "Új házi Pythonból";
                    $message = "Szia!\r\n\r\nÚj házi feladat került fel!\r\nItt megtalálod : www.python.nhely.hu\r\n\r\nEz egy automatikusan küldött üzenet, ha kérdésed van írj ide: manpatrik@outlook.hu";
                    $headers = "From: manpatrik@programozz.nhely.hu";
                    mail(utf8_decode($to), utf8_decode($subject), utf8_decode($message), utf8_decode($headers)."\nContent-Type: text/plain; charset=iso-8859-1\nContent-Transfer-Encoding: 8bit\n");
                }
                }elseif ($_GET["uj"]=="megoldas"){//feladatmegoldás feltöltése
                $Forras = $_FILES["file"]["tmp_name"];
                $Cel = "./fajlok/Manhalter Patrik/Megoldások/" .$_SESSION["nev"]."_". $_FILES["file"]["name"];
                if (file_exists($Cel)) {
                    header("Location: fajlkezelo.php?uj=A fájl már létezik! <br><br>&dir=$dir");
                } else {
                    move_uploaded_file($Forras, $Cel);
                    header("Location: fajlkezelo.php?uj=Feltöltve!<br><br>&dir=$dir");
                }
            }
        }
    }else{
        if(!empty($_POST["ujmappanev"])){
            mkdir("./fajlok/$dir/" . $_POST["ujmappanev"]);
            header("Location: fajlkezelo.php?uj=Mappa létrehozva!<br><br>&dir=$dir");
        }else{
            header("Location: fajlkezelo.php?uj=Nem adtál meg nevet!<br><br>&dir=$dir");
        }
    }
    if(isset($_GET["uj"])){
        echo $_GET["uj"];
    }

    megnyit();
?>

</div>
<?php
    include "php/footer.php";
?>
</body>
</html>