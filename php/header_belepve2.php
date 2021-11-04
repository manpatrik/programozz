<header>
    <div id="nev">Programozz.nhely.hu</div>
</header>
<style>
    #menu li:nth-child(5) a{
        width:100px;
    }
    #menu li:nth-last-child(1) a{
        width:100px;
    }
</style>

<div id="menu">
    <ul>
        <li><a href="../fajlkezelo.php?dir=<?php echo $_SESSION["nev"]?>">Fájlok</a></li>
        <li><a href="../szavazas.php">Szavazás</a></li>
        <li><a href="../index.php">Kilépés</a></li>
    </ul>
</div>