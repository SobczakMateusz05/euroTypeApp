<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("location:index.php");
    }
    require_once("php/connect.php");
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
    <link rel="stylesheet" href="css/style.css">
    <script src="js/url.js"></script>
</head>
<body>
    <header>
        <button onclick="hyper('typing.php')" class="active">Ekran typowania</button>
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
                echo '<button onclick="hyper('."'password.php'".')">Zmień hasło</button>';
            }
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')" >Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
    <section class="main">
    <h1>Ekran Typowania</h1>
    <h2>Witaj <?php echo $_SESSION["user"] ?></h2>
    <h3 style="text-decoration:underline;">Obstawiać możesz dzień przed meczem do godziny 24!</h3>
    <?php
        if(isset($_GET["false"])&&$_GET["false"]==1){
            echo '<h3 style="color:red;">Wystąpił błąd przy obstawianiu spróbuj ponownie</h3>';
        }
    ?>
    <form  action="php/type.php" method="POST">
            <?php
            $user_id = $_SESSION['id'] ;
            if($user_id!=1){
                $sql = "SELECT * FROM zaglosowane as z WHERE z.id_osoby=$user_id AND z.data = CURRENT_DATE";

                $result = $conn -> query($sql);

                $num_row = mysqli_num_rows($result);

                if($num_row>0){
                    echo '<h2 style="margin:20px"> Już dziś głosowałeś </h2>'; 
                }
                else{
                    $sql = "SELECT m.id_meczu, d.kraj as kraj1, t.kraj as kraj2, m.data FROM mecze as m join druzyny as d on m.id_druzyna_1=d.id join druzyny as t on t.id=id_druzyna_2 where data = DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY)";

                     $result = $conn -> query($sql);

                    $num_row = mysqli_num_rows($result);

                    if($num_row>0){
                        echo '<table><tr>
                        <th>Mecz</th>
                        <th>Druzyna 1</th>
                        <th>Remis</th>
                        <th>Druzyna 2</th>
                        </tr>';
                        while($row=$result->fetch_assoc()){
                            echo '<tr><td>'. $row["kraj1"] . " - ". $row["kraj2"] .  "</td>";
                            echo '<td><input type="radio" name="type-'.$row["id_meczu"].'" value="1" required></td>
                            <td><input type="radio" name="type-'.$row["id_meczu"].'" value="0" required></td>
                            <td><input type="radio" name="type-'.$row["id_meczu"].'" value="2" required></td></tr>';
                        }
                        echo '</table>
                        <input type="submit" value="Obstaw">';
                    }
                    else{
                        echo '<h2 style="margin:20px"> Jutro nie ma żadnych meczów </h2>';
                    }
                }
            }
            else{
                echo '<h2 style="margin:20px"> Jako użytkownik sa nie możesz głosować </h2>';
            }


                
                
            ?>
    </form>
    </section>
</main>
</body>
</html>