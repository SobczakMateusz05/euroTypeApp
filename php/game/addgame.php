<?php

if(isset($_POST["team1"])&&isset($_POST["team2"])&&isset($_POST["date"])&&$_POST["team1"]!=0&&$_POST["team2"]!=0){
    require_once("../connect.php");

    $team1 = $_POST["team1"];
    $team2 = $_POST["team2"];
    $date = $_POST["date"];
    
    if($team1!=$team2){
        if($date>date("Y-m-d")){
            $sql="INSERT INTO mecze(id_druzyna_1, id_druzyna_2, data) VALUES($team1, $team2, '$date')";

            $result = $conn -> query($sql);

            header("location: ../../adminpanel.php?game=1");   
        }
        else if($date==date("Y-m-d")){
            header("location:../../adminpanel.php?game=4");
        }
        else{
            header("location:../../adminpanel.php?game=5");
        }
    }
    else{
        header("location:../../adminpanel.php?game=3");
    }
}
else{
    header("location: ../../adminpanel.php?game=2");
}
