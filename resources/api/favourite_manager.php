<?php
    require_once("../db_credentials.php");
    session_start();
    if(isset($_SESSION['hash']) && isset($_POST['azione']) && isset($_POST['video_id'])){
        $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
        if($_POST['azione']=="aggiungi")
            $query='INSERT INTO preferiti (spettatore, video) values ('
            .mysqli_real_escape_string($connection,$_SESSION['hash']).','
            .mysqli_real_escape_string($connection,$_POST['video_id']).')';
        else
            $query="DELETE FROM preferiti WHERE spettatore="
            .mysqli_real_escape_string($connection,$_SESSION['hash'])
            ." AND video=".mysqli_real_escape_string($connection,$_POST['video_id']);
        $res = mysqli_query($connection, $query);
        mysqli_close($connection);
        echo "query ok";
        exit;
    }
    echo "query non completata";
    exit;
?>