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
    <title>Aplikacja Do Obstawiania</title>
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
        <button onclick="hyper('typescore.php')" class="active">Wyniki typowania</button>
        <?php
            $id = $_SESSION["id"];
            $sql = "SELECT * FROM mecze as m WHERE m.data=DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY)";
            $result=$conn->query($sql);
            $num_row=mysqli_num_rows($result);
            $sql = "SELECT * FROM zaglosowane WHERE data = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY);";
            $result = $conn -> query($sql);
            $num_row2=mysqli_num_rows($result);
            if($num_row==0||$num_row2>0){
                echo '<button onclick="hyper('."'usertype.php'".')">Typy użytkowników</button>';
            }
            if($id!=1){
                echo '<button onclick="hyper('."'mytype.php'".')">Moje typy</button>';
                echo '<button onclick="hyper('."'password.php'".')">Zmień hasło</button>';
            }
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')" >Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
    <section class="main">
        <h1>Wyniki typowania</h1>
        <table>
            <tr>
                <th>Osoba</th>
                <th>Trafione</th>
                <th>Oddane głosy</th>
            </tr>
            <?php
                $sql = "SELECT o.login, count(t.id_osoby) as liczba_typow, (SELECT Count(*) FROM wyniki as w join typy as t on t.id_meczu=w.id_meczu WHERE t.typ = w.wynik AND t.id_osoby=o.id_osoby)  as liczba_trafiona from osoby as o left join typy as t on o.id_osoby=t.id_osoby WHERE o.id_osoby !=1 AND o.id_osoby!=18 GROUP BY o.login order by liczba_trafiona DESC, liczba_typow DESC";
                $result = $conn -> query($sql);
                while($row=$result->fetch_assoc()){
                   echo "<tr> <td>" . $row["login"] . "</td>";
                   echo "<td>". $row["liczba_trafiona"]. "</td>";
                   echo "<td>". $row["liczba_typow"] . "</td></tr>";
                }
            ?>
        </table>
    </section>
    </main>
</body>
</html>