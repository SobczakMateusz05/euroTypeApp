<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Mateusz Sobczak" />
    <meta property="og:type" content="aplication" />
    <meta property="og:description" content="Aplikacja do obstawiania meczy w zamkniętej grupie" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro2024 Moje Typy</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="mask-icon" href="img/favicon.svg" color="#000000">
    <link rel="manifest" href="img/site.webmanifest">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="css/game.css">
    <script src="js/url.js"></script>
</head>
<body>
    <?php
        require_once("php/connect.php");
    ?>
    <header>
        <button onclick="hyper('typing.php')">Ekran typowania</button>
        <button onclick="hyper('gamescore.php')">Wyniki meczów</button>
        <button onclick="hyper('typescore.php')">Wyniki typowania</button>
        <?php
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')">Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
    <section class="main">
        <?php
            $sql2= "SELECT o.id_osoby, o.login FROM osoby as o WHERE id_osoby!=1";
            $result2 = $conn -> query($sql2);
            while($row2=$result2->fetch_assoc()){
                $id=$row2["id_osoby"];
                echo "<h1>Typy ". $row2["login"] . "</h1> <table> <tr> <th> Mecz </th> <th> Głos </th><th>Trafiony</th></tr>";
                $sql = "SELECT m.data, d.kraj as kraj1, dd.kraj as kraj2, if(t.typ=0, 'Remis', if(t.typ=1, d.kraj, if(t.typ=2, dd.kraj, 'zepsute')))t.typ, if(w.wynik is not NULL, if(w.wynik=t.typ, 'Tak', 'Nie'), '') as trafienie FROM mecze as m join druzyny as d on d.id=m.id_druzyna_1 join druzyny as dd on dd.id=m.id_druzyna_2 join typy as t on t.id_meczu=m.id_meczu left join wyniki as w on w.id_meczu=m.id_meczu WHERE t.id_osoby=$id ORDER BY data";
                $result = $conn -> query($sql);
                while($row=$result->fetch_assoc()){
                   echo "<tr> <td>" . $row["kraj1"]. "-". $row["kraj2"] . " (" . $row["data"]. ")" . "</td>";
                   echo "<td>". $row["typ"]. "</td>";
                   echo '<td>'. $row["trafienie"] . "</td></tr>";
                }
                echo "</table>";
            }
        
        ?>
    </section>
    </main>
</body>
</html>