<?php
    require_once("php/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Euro2024 Logowanie</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main>
    <?php
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
                        
                    $sql = "SELECT * from osoby as u join typy_osoby as t on u.typ=t.id where u.login='$login' and u.haslo='$pass'";

                    if($result = $conn->query($sql)){
                        $user_number=$result->num_rows;
                    if($user_number>0){
                        $row=$result->fetch_assoc();
                            if($row["haslo"]==$pass){
                            $_SESSION['user']=$row['login'];
                            $_SESSION['type']=$row['typ'];
                            $_SESSION["id"]=$row["id_osoby"];
                            $result->free_result();
                            header("location: typing.php");
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
                <input type="text" name="login"';
            
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
            <input type="password" name="password">
            <div class="sub">
            <input type="submit" value="Zaloguj się" class="button" name="log">
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
</main>
</body>
</html>