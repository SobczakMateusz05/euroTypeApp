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
    <title>Euro2024 Wyniki Meczów</title>
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
        <button onclick="hyper('typescore.php')">Wyniki typowania</button>
        <?php
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')">Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
        <h1>Wyniki meczów</h1>
        <table>
            <tr>
                <th>Mecz</th>
                <th>Data</th>
                <th>Wynik</th>
            </tr>
            <?php
                $sql = "SELECT d.kraj as kraj1, t.kraj as kraj2, m.data, w.wynik FROM wyniki as w join mecze as m on w.id_meczu = m.id_meczu JOIN druzyny as d ON d.id=m.id_druzyna_1 JOIN druzyny as t on t.id=m.id_druzyna_2 ORDER BY m.data";
                $result = $conn -> query($sql);
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>" . $row["kraj1"] . " - " . $row["kraj2"] . "</td><td>". $row["data"]. "</td><td>". $row["wynik"] . "</td></tr>";
                }
            ?>
        </table>
    </main>
</body>
</html>