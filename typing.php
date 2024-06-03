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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro2024 obstawianie</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/url.js"></script>
</head>
<body>
    <header>
        <button onclick="hyper('gamescore.php')">Wyniki meczów</button>
        <button onclick="hyper('typescore.php')">Wyniki typowania</button>
        <?php
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')">Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
    <h1>Euro 2024 Obstawianie</h1>
    <h2>Witaj <?php echo ucfirst($_SESSION["user"]) ?></h2>
    <form  action="php/type.php" method="POST">
            <?php
            $user_id = $_SESSION['id'] ;
            if($user_id!=1){
                require_once("php/connect.php");

                $sql = "SELECT * FROM zaglosowane as z WHERE z.id_osoby=$user_id AND z.data = CURRENT_DATE";

                $result = $conn -> query($sql);

                $num_row = mysqli_num_rows($result);

                if($num_row>0){
                    echo '<h2 style="margin:20px"> Już dziś głosowałeś </h2>'; 
                }
                else{
                    $sql = "SELECT m.id_meczu, d.kraj as kraj1, t.kraj as kraj2, m.data FROM mecze as m join druzyny as d on m.id_druzyna_1=d.id join druzyny as t on t.id=id_druzyna_2 where data = CURRENT_DATE+1";

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
</main>
</body>
</html>