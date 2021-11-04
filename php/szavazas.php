<?php
session_start();
?>

<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Szavazás</title>
    <link rel="stylesheet" type="text/css" href="../css/stilus.css">
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
        .gomb {
            margin-top: 10px;
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
    <script>
        function valt(mi, mire){
            document.getElementById(mi).src="../kepek/"+mire;
        }
    </script>
</head>
<body>
<?php
if(!isset($_SESSION['nev']))
    header("Location: ../index.php");
else
    include "../php/header_belepve2.php";
?>

<div id="oldal">
<?php
$conn = mysqli_connect('mysql.omega:3306', 'programozz', 'Uqr1MERcE7') or die("Hibás csatlakozás: " . mysqli_error($conn));
mysqli_select_db($conn, 'programozz') or die("Adatbázishiba: " . mysqli_error($conn));

if(isset($_GET["szavazat"])){
    mysqli_query($conn, "UPDATE szavaz SET Szavazat='".$_GET['szavazat']."' WHERE Felhasznalo_azonosito=".$_SESSION["azonosito"]." AND Szavazas_azonosito=".$_GET["szavazas"].";");
    header("Location: ../szavazas.php?mes=Sikeres szavazás!");
}
if($_SESSION["nev"]!="Manhalter Patrik"){
    $res=mysqli_query($conn, "SELECT Tipus FROM szavazas WHERE Azonosito=".$_GET["szavazas"].";");
    $tipus=mysqli_fetch_assoc($res)["Tipus"];
    switch ($tipus){
        case "emoji":
            echo "
            <h1 id='cim'>Szavazz</h1>
            <div id='emojik'>
                <img src='../kepek/1.png' id='1' onmouseover='valt(1,\"1k.png\")' onmouseleave='valt(1,\"1.png\")' onclick='location.href=\"\szavazas.php?szavazas=".$_GET["szavazas"]."&szavazat=1\"'>
                <img src='../kepek/2.png' id='2' onmouseover='valt(2,\"2k.png\")' onmouseleave='valt(2,\"2.png\")' onclick='location.href=\"\szavazas.php?szavazas=".$_GET["szavazas"]."&szavazat=2\"'>
                <img src='../kepek/3.png' id='3' onmouseover='valt(3,\"3k.png\")' onmouseleave='valt(3,\"3.png\")' onclick='location.href=\"\szavazas.php?szavazas=".$_GET["szavazas"]."&szavazat=3\"'>
                <img src='../kepek/4.png' id='4' onmouseover='valt(4,\"4k.png\")' onmouseleave='valt(4,\"4.png\")' onclick='location.href=\"\szavazas.php?szavazas=".$_GET["szavazas"]."&szavazat=4\"'>
                <img src='../kepek/5.png' id='5' onmouseover='valt(5,\"5k.png\")' onmouseleave='valt(5,\"5.png\")' onclick='location.href=\"\szavazas.php?szavazas=".$_GET["szavazas"]."&szavazat=5\"'>
            </div>";
            echo "<style>#cim{
            text-align: center;
            color: white;
            font-size: 50px;
        }
        #emojik{
            width: 480px;
            display: block;
            margin: auto auto;
        }
        img:hover{
            cursor:pointer;
        }</style>";
            break;
    }
}else{
    $res=mysqli_query($conn,"SELECT Szavazat,COUNT(*) as db FROM szavaz WHERE Szavazas_azonosito=".$_GET["szavazas"]." AND Szavazat!='' GROUP BY Szavazat ORDER BY Szavazat ASC");
    $ertekek=[0,0,0,0,0,0];
    $sum=0;
    while($sor=mysqli_fetch_assoc($res)){
        $ertekek[$sor["Szavazat"]]=$sor["db"];
    }
    for ($i=1;$i<6;$i++){
        $sum+=$ertekek[$i]*$i;
    }
    $dataPoints = array(
        array("label"=> "1", "y"=> $ertekek[1]),
        array("label"=> "2", "y"=> $ertekek[2]),
        array("label"=> "3", "y"=> $ertekek[3]),
        array("label"=> "4", "y"=> $ertekek[4]),
        array("label"=> "5", "y"=> $ertekek[5])
    );
    echo'
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script>
        function alma() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Eredmény"
                },
                axisY: {
                    title: "db"
                },
                data: [{
                    type: "column",
                    dataPoints: '.json_encode($dataPoints, JSON_NUMERIC_CHECK).'
                }]
            });
            chart.render();
        }
        alma();
        </script><br>
        <h3>Átlag: </h3>'.($sum/array_sum($ertekek)).'
    ';
}

?>
</div>
<?php
include "../php/footer.php";
?>
</body>
</html>