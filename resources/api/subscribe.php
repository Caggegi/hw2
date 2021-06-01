<?php
    require_once("../db_credentials.php");
    session_start();
    if(isset($_SESSION['hash']) && isset($_POST['action']) && isset($_POST['creator']) && isset($_POST['tipo'])){
        $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
        if($_POST['tipo']=='segue') $par='spettatore';
        else $par='premium';
        if($_POST['action']=='subscribe'){
            $query = "INSERT INTO ".mysqli_real_escape_string($connection,$_POST['tipo'])
            ." values (".mysqli_real_escape_string($connection,$_SESSION['hash'])
            .",".mysqli_real_escape_string($connection,$_POST['creator']).",'".date('Y-m-d')."');";
        } else{
            $query = "DELETE FROM ".mysqli_real_escape_string($connection,$_POST['tipo'])
            ." WHERE ".$par."=".mysqli_real_escape_string($connection,$_SESSION['hash'])
            ." and creator=".mysqli_real_escape_string($connection,$_POST['creator']);
        }
        $res = mysqli_query($connection, $query);
        mysqli_close($connection);
        exit;
    }
?>