<?php
    session_start();
    
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
    <link rel="stylesheet" href="css/login.css">
    <script src="js/url.js"></script>
</head>
<body>
    <main>
    <section class="main">
    <?php
        require_once("php/connectlogin.php");
        $sql = "SELECT * from osoby where id_osoby=1";
        $result = $conn -> query($sql);
        $num_row = mysqli_num_rows($result);

        if($num_row==1){
            echo <<< END
                <h2>Zaloguj się:</h2>
            END;
            if(isset($_POST["log"])){
                $variable=0;
                if($_POST["login"]!=""){
                    $variable+=1;
                    $login= $_POST["login"];
                }
                else{
                    echo '<h4 class="missed"> Nie wprowadziłeś loginu!</h4>';
                    $erloglog=7;
                }
                if($_POST["password"]!=""){
                    $variable+=1;
                    $pass=$_POST["password"];
                }
                else{
                    echo '<h4 class="missed"> Nie wprowadziłeś hasła!</h4>';
                    $erlogpass=7;
                }
                if($variable==2){
                        
                    $sql = "SELECT * from osoby as u join typy_osoby as t on u.typ=t.id where u.login='$login'";
                    if($result = $conn->query($sql)){
                        $user_number=$result->num_rows;
                    if($user_number>0){
                        $row=$result->fetch_assoc();
                            if(password_verify($pass, $row["haslo"])){
                            $_SESSION['user']=$row['login'];
                            $_SESSION['type']=$row['typ'];
                            $_SESSION["id"]=$row["id_osoby"];
                            $result->free_result();
                            echo '<script> hyper("typing.php");</script>';
                        }
                        else{
                            echo '<h4 class="missed">Błedny login lub/i hasło!</h4>';
                        }
                    }
                    else{
                        echo '<h4 class="missed">Błedny login lub/i hasło!</h4>';
                    }
                    }
                    @$conn->close();

                }
                
            }
            echo 
                '<form method="POST" action="index.php">';

            if(isset($erloglog)){
                echo '<p class="missed" >';
            }
            else{
                echo "<p>";
            }
            echo 
                'Nazwa użytkownia:</p>
                <input type="text" name="login" placeholder="Login" ';
            
            if(isset($login)){
                echo 'value="'. $login . '"';
            }
            echo ">";
            if(isset($erlogpass)){
                echo '<p class="missed" >';
            }
            else{
                echo "<p>";
            }
            echo <<< END
            
            Hasło:</p>
            <input type="password" name="password" placeholder="Hasło">
            <div class="sub">
            <div class="bottom">
                <input type="submit" value="Zaloguj się" class="button" name="log">
            </div>
            </div>
            </form>
            END;
        }
        else{
            echo <<< END
                <h2> Utwórz hasło dla użytkownika sa (SuperAdmin) <h2>
                <form action = "php/sapass.php" method="POST" autocomplete="off" id="sa">
                    <p> Wprowadź hasło (nie będzie można go zmienić) </p>
                    <input type="password" name="pass" placeholder="Hasło" required>
                    <input type="submit" value="Utwórz">
                </form>
            END;
        }
    ?>
    </section>
</main>
</body>
</html>