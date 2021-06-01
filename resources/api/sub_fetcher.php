<?php
    require_once("../db_credentials.php");
    session_start();
    if(isset($_SESSION['hash']) && isset($_SESSION['tipo'])){
        if($_SESSION['tipo']=="spectator"){
            $lista = array();
            $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
            $query = "call chi_segue(".mysqli_real_escape_string($connection,$_SESSION['hash']).");";
            $res = mysqli_query($connection, $query);
            while($row = mysqli_fetch_object($res)){
                $lista[] = array('hash'=>$row->hash, 'username'=>$row->username, 'profile_pic'=>$row->profile_pic);
            }
            echo json_encode($lista);
            mysqli_close($connection);
        }
    }
?>