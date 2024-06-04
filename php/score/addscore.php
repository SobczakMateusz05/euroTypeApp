<?php
if(isset($_POST["game"])&&$_POST["game"]!=0&&isset($_POST["score"])){
    if($_POST["score"]==0||$_POST["score"]==1||$_POST["score"]==2){
        $game = htmlspecialchars($_POST["game"]);
        $score = htmlspecialchars($_POST["score"]);
        require_once("../connect.php");

        $sql = "INSERT INTO wyniki VALUES($game, $score)";
        $result = $conn -> query($sql);
        header("location:../../adminpanel.php?score=1");
    }
    else{
        header("location:../../adminpanel.php?score=3");
    }
}
else{
    header("location:../../adminpanel.php?score=2");
}