<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro2024 Wyniki Typów</title>
    <link rel="stylesheet" href="css/game.css">
    <script src="js/url.js"></script>
</head>
<body>
    <header>
        <button onclick="hyper('typing.php')">Ekran typowania</button>
        <button onclick="hyper('gamescore.php')">Wyniki meczów</button>
        <?php
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')">Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
        <h1>Wyniki typowania</h1>
        <table>
            <tr>
                <th>Osoba</th>
                <th>Trafione</th>
                <th>oddane głosy</th>
            </tr>
            <?php
                require_once("php/connect.php");

                $sql = "SELECT o.login, count(t.id_osoby) as liczba_typow, (SELECT Count(*) FROM wyniki as w join typy as t on t.id_meczu=w.id_meczu WHERE t.typ = w.wynik AND t.id_osoby=o.id_osoby)  as liczba_trafiona from osoby as o left join typy as t on o.id_osoby=t.id_osoby WHERE o.id_osoby !=1  GROUP BY o.login order by liczba_trafiona DESC";
                $result = $conn -> query($sql);
                while($row=$result->fetch_assoc()){
                   echo "<tr> <td>" . $row["login"] . "</td>";
                   echo "<td>". $row["liczba_trafiona"]. "</td>";
                   echo "<td>". $row["liczba_typow"] . "</td></tr>";
                }
            ?>
        </table>
    </main>
</body>
</html>