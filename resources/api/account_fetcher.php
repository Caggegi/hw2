<?php
    require_once("../db_credentials.php");
    $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $tabella = 'spettatore';
    if($_POST["tipo"]=="creator")
        $tabella = 'creator';
    $res = mysqli_query($connection, "SELECT * FROM ".$tabella." WHERE username='".$username."'");
    if(mysqli_num_rows($res)>0)
        echo "true";
    else
        echo "false";
?>
