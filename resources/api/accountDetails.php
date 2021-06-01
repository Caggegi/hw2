<?php
    require_once("../db_credentials.php");
    session_start();
    if(isset($_SESSION['hash']) && isset($_SESSION['tipo'])){
        $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
        if($_SESSION['tipo']=='spectator'){
            $n_c = explode(" ",$_POST['nome']);
            $query = "UPDATE spettatore SET name='".mysqli_real_escape_string($connection, $n_c[0])
            ."', surname='".mysqli_real_escape_string($connection,$n_c[1])
            ."', email='".mysqli_real_escape_string($connection,$_POST['email'])
            ."', profile_pic='".mysqli_real_escape_string($connection,$_POST['image'])
            ."' where hash='".mysqli_real_escape_string($connection,$_SESSION['hash'])."';";
        } else if($_SESSION['tipo']=='creator'){
            $n_c = explode(" ",$_POST['nome']);
            $query = "UPDATE creator SET name='".mysqli_real_escape_string($connection,$n_c[0])
            ."', surname='".mysqli_real_escape_string($connection,$n_c[1])
            ."', email='".mysqli_real_escape_string($connection,$_POST['email'])
            ."', profile_pic='".mysqli_real_escape_string($connection,$_POST['image'])
            ."' where hash='".mysqli_real_escape_string($connection,$_SESSION['hash'])."';";
        }
        $res = mysqli_query($connection, $query);
        mysqli_close($connection);
        echo json_encode("{'query' : 'done'}");
    } else{
        echo json_encode("{'query' : 'unknown user'}");
    }
?>