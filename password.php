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
    <link rel="stylesheet" href="css/login.css">
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
                echo '<button onclick="hyper('."'password.php'".')" class="active">Zmień hasło</button>';
            }
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')" >Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
    <section class="main">
        <h1>Zmień hasło</h1>
        <?php
            if(isset($_GET["add"])&&$_GET["add"]==1){
                echo '<h2 style="color:green;"> Zmieniono hasło </h2>';
                echo '<script> url("add")</script>';
            }
            else if(isset($_GET["add"])&&$_GET["add"]==2){
                echo '<h2 style="color:red;"> Błąd zmiany hasła </h2>';
                echo '<script> url("add")</script>';
            }
        ?>
        <form action="php/user/editpassword.php" method="POST">
            <a>Wprowadź hasło:</a>
            <input type="password" name="pass1" placeholder="Hasło" id="pass1" required>
            <div>
            <a>Potwierdź hasło:</a> <a id="passconf" style="color:red;"></a>
            </div>
            <input type="password" name="pass2" placeholder="Ponów Hasło" id="pass2" required>
            <div id="submit">
                <input type="submit" value="Zmień hasło">
            </div>
        </form>
    </section>
    </main>
<script src="js/editpass.js"></script>
</body>
</html>