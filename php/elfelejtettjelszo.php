<?php
session_start();
function generatePassword() {
    $length = 8;
    $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $retVal = "";
    $n = strlen($charset);
    for ($i = 0; $i < $length; $i++) {
        $retVal= $retVal.substr($charset, rand(0, $n), 1);
    }
    return $retVal;
}

$conn = mysqli_connect('mysql.omega:3306', 'programozz', 'Uqr1MERcE7') or die("Hibás csatlakozás: " . mysqli_error($conn));
mysqli_select_db($conn, 'programozz') or die("Adatbázishiba: " . mysqli_error($conn));
if (isset($_POST["kuld"])){
    $email=$_POST["email"];
    $ujjelszo=generatePassword();
    $res = mysqli_query($conn, "SELECT COUNT(*) as eredmeny FROM felhasznalok WHERE Email='$email';");
    if(mysqli_fetch_assoc($res)["eredmeny"]!=0){
        $to=$email;
        $subject = "Elfelejtett jelszó";
        $message = "Ideiglenes jelszó: $ujjelszo\r\n\r\nwww.programozz.nhely.hu\r\n\r\nEz egy automatikusan küldött üzenet, ha kérdésed van írj ide: manpatrik@outlook.hu";
        $headers = "From: manpatrik@programozz.nhely.hu";
        mail(utf8_decode($to), utf8_decode($subject), utf8_decode($message), utf8_decode($headers)."\nContent-Type: text/plain; charset=iso-8859-1\nContent-Transfer-Encoding: 8bit\n");
        $ujjelszo = hash_hmac('ripemd160', $ujjelszo, 'secret');
        $res=mysqli_query($conn, "UPDATE felhasznalok SET Jelszo='$ujjelszo' WHERE Email='$email';");
        header("Location: ../index.php?err=Az új jelszó elküldve az email címedre!");
    }else
        header("Location: ../index.php?err=Nem létező email!");
}
?>

<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Elfelejtett jelszó</title>
    <link rel="icon" href="kepek/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/stilus.css">
    <link rel="stylesheet" type="text/css" href="../css/belepes.css">
    <link href='https://fonts.googleapis.com/css?family=Bilbo' rel='stylesheet'>
</head>
<body>
<?php
    include "../php/header_kilepve2.php";
?>

<div id="oldal">
    <?php
        echo
            '<form method="post" action="elfelejtettjelszo.php" id="belepes">
							<fieldset>
								<legend>Elfelejtett jelszó</legend>
								<label for="email">Email cím:</label><br/>
								<input type="text" id="email" name="email"><br/>
								<input type="submit" value="Küld" id="kuld" class="gomb" name="kuld">
							</fieldset>
						</form>';

    ?>


</div>
</body>
</html>