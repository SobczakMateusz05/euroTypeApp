<?php
error_reporting(E_ALL & ~E_WARNING); 
$db_host="euro2024.dwexpert.pl.mysql.dhosting.pl";
$db_user="voe9ci_euro2024";
$db_pass="achah0Ea8eme";
$db_name="ireib4_euro2024";

try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        throw new Exception("Błąd połączenia: " . $conn->connect_error);
    }
}
catch (Exception $e) {
    echo '<h1 style="text-align:center; color:red;">Błąd połączenia z bazą danych lub baza nie istnieje!</h1>';
    exit();
}
