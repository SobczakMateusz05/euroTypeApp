<?php
    session_start();
    if($_SESSION["type"]!="admin"){
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
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/url.js"></script>
    <script src="js/admin.js"></script>  
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
                echo '<button onclick="hyper('."'password.php'".')">Zmień hasło</button>';
            }
            if($_SESSION["type"]=="admin")    
            echo '<button onclick="hyper('."'adminpanel.php'".')" class="active">Panel Admina</button>';
        ?>
        <button onclick="hyper('php/logout.php')">Wyloguj się</button>
    </header>
    <main>
        <section class="main">
        <h1>Admin Panel</h1>
        <h2>Witaj <?php echo $_SESSION["user"] ?></h2>
        <nav>
            <button onclick="manage('score')" class="manageBtn active" id="scoreBtn">Zarządzaj wynikami</button>
            <button onclick="manage('game')" class="manageBtn" id="gameBtn">Zarządzaj meczami</button>
            <button onclick="manage('teams')" class="manageBtn" id="teamsBtn">Zarządzaj drużynami</button>
            <button onclick="manage('users')" class="manageBtn" id="usersBtn">Zarządzaj użytkownikami</button>
        </nav>

        <section id="score" class="manage">

            <h3>Dodaj wynik</h3>

            <?php
                if(isset($_GET["score"])&&$_GET["score"]==1){
                    echo '<h3 style="color:green;">Dodano wynik</h3>';
                    echo '<script> url("score");manage("score");</script>';
                }
                else if(isset($_GET["score"])&&$_GET["score"]==2){
                    echo '<h3 style="color:red;">Błąd dodania wyniku</h3>';
                    echo '<script> url("score");manage("score");</script>';
                }
                else if(isset($_GET["score"])&&$_GET["score"]==3){
                    echo '<h3 style="color:red;">Błędna wartość wyniku</h3>';
                    echo '<script> url("score");manage("score");</script>';
                }

            ?>

            <form method="POST" action="php/score/addscore.php" autocomplete="off">
                <a>Mecz: </a>
                <select name="game" >
                    <option value="0"> Wybierz...</option>
                    <?php
                        $sql = "SELECT m.id_meczu, d.kraj as kraj1, t.kraj as kraj2, m.data FROM mecze as m left join wyniki as w on w.id_meczu=m.id_meczu join druzyny as d on m.id_druzyna_1=d.id join druzyny as t on t.id=id_druzyna_2 where w.wynik is null ORDER BY data;";

                        $result = $conn -> query($sql);

                        while($row=$result->fetch_assoc()){
                            echo '<option value="'. $row["id_meczu"]. '">'. $row["kraj1"] . " - ". $row["kraj2"] . " (". $row["data"]. ") </option>";
                        }
                    ?>
                </select>
                <a>Wynik (1, 0, 2):</a>
                <input type="number" name="score" min="0" max="2" step="1" placeholder="Wynik" required />
                <input type="submit" value="Dodaj">
            </form>

            <h3>Zmień wynik</h3>
            
            <?php
                if(isset($_GET["editscore"])&&$_GET["editscore"]==1){
                    echo '<h3 style="color:green;">Zmieniono wynik</h3>';
                    echo '<script> url("editscore"); manage("score");</script>';
                }
                else if(isset($_GET["editscore"])&&$_GET["editscore"]==2){
                    echo '<h3 style="color:red;">Błąd zmiany wyniku</h3>';
                    echo '<script> url("editscore");manage("score");</script>';
                }
            ?>

            <form method="POST" action="php/score/editscore.php" autocomplete="off">
                <a>Mecz:</a>
                <select name="game">
                    <option value="0">Wybierz..</option>
                    <?php
                        $sql = "SELECT m.id_meczu, d.kraj as kraj1 , dd.kraj as kraj2, w.wynik, m.data from mecze as m join druzyny as d on m.id_druzyna_1=d.id join druzyny as dd on m.id_druzyna_2=dd.id join wyniki as w on m.id_meczu=w.id_meczu";
                        $result = $conn -> query($sql);
                        while($row = $result -> fetch_assoc()){
                            echo '<option value="'. $row["id_meczu"] .'">' . $row["kraj1"] ." - " . $row["kraj2"] . " (". $row["data"].", wynik: " . $row["wynik"] . ") ". '</option>'; 
                        }
                    ?>
                </select>
                <a>Nowy wynik (1, 0 , 2)</a>
                <input type="number" name="score" min="0" max="2" step="1" placeholder="Wynik" required />
                <input type="submit" value="Zmien">
            </form>

            <h3>Usuń wynik</h3>

            <?php
                if(isset($_GET["delscore"])&&$_GET["delscore"]==1){
                    echo '<h3 style="color:green;">Usunięto wynik</h3>';
                    echo '<script> url("delscore"); manage("score");</script>';
                }
                else if(isset($_GET["delscore"])&&$_GET["delscore"]==2){
                    echo '<h3 style="color:red;">Błąd usunięcia wyniku</h3>';
                    echo '<script> url("delscore");manage("score");</script>';
                }
            ?>

            <form method="POST" action="php/score/delscore.php" autocomplete="off">
                <a>Mecz:</a>
                <select name="game">
                    <option value="0">Wybierz..</option>
                    <?php
                        $sql = "SELECT m.id_meczu, d.kraj as kraj1 , dd.kraj as kraj2, w.wynik, m.data from mecze as m join druzyny as d on m.id_druzyna_1=d.id join druzyny as dd on m.id_druzyna_2=dd.id join wyniki as w on m.id_meczu=w.id_meczu";
                        $result = $conn -> query($sql);
                        while($row = $result -> fetch_assoc()){
                            echo '<option value="'. $row["id_meczu"] .'">' . $row["kraj1"] ." - " . $row["kraj2"] . " (". $row["data"].", wynik: " . $row["wynik"] . ") ". '</option>'; 
                        }
                    ?>
                </select>
                <input type="submit" value="Usuń">
            </form>
        </section>

        <section id="game" class="disable manage">

            <h3>Dodaj mecz</h3>

            <?php
                if(isset($_GET["game"])&&$_GET["game"]==1){
                    echo '<h3 style="color:green;">Dodano mecz</h3>';
                    echo '<script> url("game"); manage("game");</script>';
                }
                else if(isset($_GET["game"])&&$_GET["game"]==2){
                    echo '<h3 style="color:red;">Błąd dodania meczu</h3>';
                    echo '<script> url("game");manage("game");</script>';
                }
                else if(isset($_GET["game"])&&$_GET["game"]==3){
                    echo '<h3 style="color:red;">Musisz podać dwie różne drużyny</h3>';
                    echo '<script> url("game");manage("game");</script>';
                }
                else if(isset($_GET["game"])&&$_GET["game"]==4){
                    echo '<h3 style="color:red;">Nie możesz dodać meczu, który jest dziś</h3>';
                    echo '<script> url("game");manage("game");</script>';
                }
                else if(isset($_GET["game"])&&$_GET["game"]==5){
                    echo '<h3 style="color:red;">Nie możesz dodać meczu, który już był</h3>';
                    echo '<script> url("game");manage("game");</script>';
                }
            ?>

            <form method="POST" action="php/game/addgame.php" autocomplete="off">
                <a>Drużyna 1:</a> 
                <select name="team1">
                    <option value="0"> Wybierz...</option>
                    <?php
                        $sql="SELECT * FROM druzyny ORDER BY kraj";
                        $result= $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            echo '<option value="'. $row["id"] .'">' . $row["kraj"] . '</option>';
                        }
                    ?>
                </select>
                <a>Druzyna 2:</a>
                <select name="team2">
                    <option value="0"> Wybierz...</option>
                    <?php
                        $sql="SELECT * FROM druzyny ORDER BY kraj";
                        $result= $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            echo '<option value="'. $row["id"] .'">' . $row["kraj"] . '</option>';
                        }
                    ?>
                </select>
                <a>Data: </a>
                <input type="date" name="date" required>
                <input type="submit" value="Dodaj">
            </form>

            <h3>Usuń mecz</h3>
            <?php
                if(isset($_GET["delgame"])&&$_GET["delgame"]==1){
                    echo '<h3 style="color:green;">Usunięto mecz</h3>';
                    echo '<script> url("delgame"); manage("game");</script>';
                }
                else if(isset($_GET["delgame"])&&$_GET["delgame"]==2){
                    echo '<h3 style="color:red;">Błąd usunięcia meczu</h3>';
                    echo '<script> url("delgame");manage("game");</script>';
                }
            ?>
            <form action="php/game/delgame.php" method="POST" autocomplete="off">
                <a>Mecz:</a>
                <select name="game">
                    <option value="0">Wybierz...</option>
                    <?php
                        $sql = "SELECT m.id_meczu, d.kraj as kraj1 , dd.kraj as kraj2, m.data from mecze as m join druzyny as d on m.id_druzyna_1=d.id join druzyny as dd on m.id_druzyna_2=dd.id ORDER BY data";
                        $result = $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            echo '<option value="'. $row["id_meczu"] .'">' . $row["kraj1"] ." - " . $row["kraj2"] . " (" . $row["data"] . ") ". '</option>'; 
                        }
                    ?>
                </select>
                <input type="submit" value="Usuń">
            </form>

        </section> 

        <section id="teams" class="disable manage">
                        
            <h3>Dodaj drużynę</h3>
            
            <?php
                if(isset($_GET["addteam"])&&$_GET["addteam"]==1){
                    echo '<h3 style="color:green;">Dodano drużynę</h3>';
                    echo '<script> url("addteam");manage("teams");</script>';
                }
                else if(isset($_GET["addteam"])&&$_GET["addteam"]==2){
                    echo '<h3 style="color:red;">Błąd dodania drużyny</h3>';
                    echo '<script> url("addteam");manage("teams");</script>';
                }
                else if(isset($_GET["addteam"])&&$_GET["addteam"]==3){
                    echo '<h3 style="color:red;">Taka drużyna już istnieje</h3>';
                    echo '<script> url("addteam");manage("teams");</script>';
                }
            ?>

            <form action="php/team/addteam.php" method="POST" autocomplete="off">
                <a>Nazwa drużyny:</a>
                <input type="text" name="name" placeholder="Nazwa dryżyny" required>
                <input type="submit" value="Dodaj">
            </form>

            <h3>Usuń drużynę</h3>

            <?php
                if(isset($_GET["delteam"])&&$_GET["delteam"]==1){
                    echo '<h3 style="color:green;">Usunięto drużynę</h3>';
                    echo '<script> url("delteam");manage("teams");</script>';
                }
                else if(isset($_GET["delteam"])&&$_GET["delteam"]==2){
                    echo '<h3 style="color:red;">Błąd usunięcia drużyny</h3>';
                    echo '<script> url("delteam");manage("teams");</script>';
                }
            ?>

            <form method="POST" action="php/team/delteam.php" autocomplete="off">
                <a>Wybierz drużynę:</a>
                <select name="id">
                    <option value="0">Wybierz...</option>
                    <?php
                        $sql = "SELECT * FROM druzyny ORDER BY kraj";
                        $result = $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            echo '<option value="'. $row["id"] . '">' . $row["kraj"] . '</option>';
                        }
                    ?>
                </select>
                <input type="submit" value="Usuń">
            </form>
        </section>

        <section id="users" class="disable manage">

            <h3>Dodaj użytkownika</h3>

            <?php
                if(isset($_GET["user"])&&$_GET["user"]==1){
                    echo '<h3 style="color:green;">Dodano uzytkownika</h3>';
                    echo '<script> url("user");manage("users");</script>';
                }
                else if(isset($_GET["user"])&&$_GET["user"]==2){
                    echo '<h3 style="color:red;">Błąd dodania użytkownika</h3>';
                    echo '<script> url("user");manage("users");</script>';
                }
                else if(isset($_GET["user"])&&$_GET["user"]==3){
                    echo '<h3 style="color:red;">Taka nazwa użytkownika już istnieje</h3>';
                    echo '<script> url("user");manage("users");</script>';
                }
            ?>

            <form method="POST" action="php/user/adduser.php" autocomplete="off">
                <a>Nazwa użytkownika:</a>
                <input type="text" name="name" placeholder="Nazwa użytkownika" required>
                <a>Haslo:</a>
                <input type="password" name="pass" placeholder="Hasło" required>
                <a>Typ konta:</a>
                <?php
                    if($_SESSION["id"]==1){
                        echo <<< END
                            <div>
                                <input type="radio" name="type" value="2" id="user" required>
                                <label for="user">Użytkownik</label>
                            </div>
                            <div>
                                <input type="radio" name="type" value="1" id="admin" required>
                                <label for="admin">Administrator</label>
                            </div>
                        END;
                    }
                    else{
                        echo <<< END
                            <div>
                                <input type="radio" name="type" value="2" id="user" required checked>
                                <label for="user">Użytkownik</label>
                            </div>
                        END;
                    }
                ?>
                
                <input type="submit" value="Dodaj">
            </form>

            <h3>Zmień hasło użytkownika</h3>

            <?php
                if(isset($_GET["passuser"])&&$_GET["passuser"]==1){
                    echo '<h3 style="color:green;">Zmieniono hasło</h3>';
                    echo '<script> url("passuser");manage("users");</script>';
                }
                else if(isset($_GET["passuser"])&&$_GET["passuser"]==2){
                    echo '<h3 style="color:red;">Błąd zmiany hasła</h3>';
                    echo '<script> url("passuser");manage("users");</script>';
                }
                else if(isset($_GET["passuser"])&&$_GET["passuser"]==3){
                    echo '<h3 style="color:red;">Nie możesz ustawić takiego samego hasła</h3>';
                    echo '<script> url("passuser");manage("users");</script>';
                }
            ?>

            <form action="php/user/editpasswordadm.php" method="POST" autocomplete="off">
                <a>Nazwa użytkownika:</a>
                <select name="user">
                    <option value="0">Wybierz...</option>
                    <?php
                        if($_SESSION["id"]==1){
                            $sql = "SELECT o.id_osoby, o.login, CASE o.typ when '1' THEN 'Administrator' WHEN '2' THEN 'Użytkownik' END as typ from osoby as o WHERE o.id_osoby!=1";
                        }
                        else{
                        $sql = "SELECT o.id_osoby, o.login, CASE o.typ when '1' THEN 'Administrator' WHEN '2' THEN 'Użytkownik' END as typ from osoby as o WHERE typ!=1";
                        }
                        $result = $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            if($row["id_osoby"]!=0){
                                echo '<option value="' . $row["id_osoby"] . '">'. $row["login"] . ' (' . $row["typ"] . ')</option>';
                            }
                        }
                    ?>
                </select>
                <a>Nowe hasło:</a>
                <input type="password" name="pass" placeholder="Hasło" required>
                <input type="submit" value="Zmień hasło">
            </form>

            <?php
                if($_SESSION["id"]==1){
                    echo <<< END
                            <h3>Zmień typ użytkownika</h3>
                    END;
                    
                        if(isset($_GET["edittype"])&&$_GET["edittype"]==1){
                            echo '<h3 style="color:green;">Zmieniono typ użytkownika</h3>';
                            echo '<script> url("edittype");manage("users");</script>';
                        }
                        else if(isset($_GET["edittype"])&&$_GET["edittype"]==2){
                            echo '<h3 style="color:red;">Błąd zmiany typu użytkownika</h3>';
                            echo '<script> url("edittype");manage("users");</script>';
                        }
                   
                    echo <<< END
                    <form action="php/user/edittype.php" method="POST" autocomplete="off">
                        <a>Nazwa użytkownika:</a>
                        <select name="user">
                            <option value="0">Wybierz...</option>
                    END;
                            
                                $sql = "SELECT o.id_osoby, o.login, CASE o.typ when '1' THEN 'Administrator' WHEN '2' THEN 'Użytkownik' END as typ from osoby as o WHERE o.id_osoby!=1";
                                $result = $conn -> query($sql);
                                while($row=$result->fetch_assoc()){
                                    if($row["id_osoby"]!=0){
                                        echo '<option value="' . $row["id_osoby"] . '">'. $row["login"] . ' (' . $row["typ"] . ')</option>';
                                    }
                                }
                            
                    echo <<< END
                        </select>
                        <a>Nowy typ konta:</a>
                        <div>
                            <input type="radio" name="type" value="2" id="user" required>
                            <label for="user">Użytkownik</label>
                        </div>
                        <div>
                            <input type="radio" name="type" value="1" id="admin" required>
                            <label for="admin">Administrator</label>
                        </div>
                        <input type="submit" value="Zmień typ">
                    </form>
                    END;
                }
            
            ?>

            <h3>Usuń użytkownika</h3>

            <?php
                if(isset($_GET["deluser"])&&$_GET["deluser"]==1){
                    echo '<h3 style="color:green;">Usunięto użytkownika</h3>';
                    echo '<script> url("deluser");manage("users");</script>';
                }
                else if(isset($_GET["deluser"])&&$_GET["deluser"]==2){
                    echo '<h3 style="color:red;">Błąd usuwania użytkownika</h3>';
                    echo '<script> url("deluser");manage("users");</script>';
                }
            ?>
            <form action="php/user/deluser.php" method="POST" autocomplete="off">
                <a>Nazwa użytkownika:</a>
                <select name="user">
                    <option value="0">Wybierz...</option>
                    <?php
                        if($_SESSION["id"]==1){
                            $sql = "SELECT o.id_osoby, o.login, CASE o.typ when '1' THEN 'Administrator' WHEN '2' THEN 'Użytkownik' END as typ from osoby as o WHERE o.id_osoby!=1";
                        }
                        else{
                        $sql = "SELECT o.id_osoby, o.login, CASE o.typ when '1' THEN 'Administrator' WHEN '2' THEN 'Użytkownik' END as typ from osoby as o WHERE typ!=1";
                        }
                        $result = $conn -> query($sql);
                        while($row=$result->fetch_assoc()){
                            if($row["id_osoby"]!=1){
                                echo '<option value="' . $row["id_osoby"] . '">'. $row["login"] . ' (' . $row["typ"] . ')</option>';
                            }
                        }
                    ?>
                </select>
                <input type="submit" value="Usuń">
            </form>

        </section> 
    </section>
    </main>  
</body>
</html>