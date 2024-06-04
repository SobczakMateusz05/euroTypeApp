<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
session_start();
$user_id = $_SESSION["id"];

require_once("connect.php");

$sql = "SELECT m.id_meczu FROM mecze as m WHERE m.data = CURRENT_DATE + 1";

$result = $conn -> query($sql);

while($row=$result->fetch_assoc()){
    $mecz = $row["id_meczu"];
    $typ = htmlspecialchars($_POST["type-$mecz"]);
    $sql2="INSERT INTO typy VALUES($mecz,$user_id, $typ)";

    $result2= $conn -> query($sql2);
}

$sql3 = "INSERT INTO zaglosowane(id_osoby) VALUES($user_id)";
$result3 = $conn -> query($sql3);

header("location:../typing.php");
}
else{
    header("location:../typing.php?false=1"); 
}