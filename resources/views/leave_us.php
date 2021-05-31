<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <link href="css/join_us.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mollare è da mollaccioni</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="img/icons/videotube.svg">
</head>
<body>
    <?php
        require_once("db_credentials.php");
        session_start();
        if(isset($_SESSION['hash'])){
            $connect = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
            $query = "select hash from premium where hash=".$_SESSION['hash'];
            $res = mysqli_query($connect, $query);
            if(mysqli_num_rows($res)>0){
                $query1 = "DELETE FROM abbonamento where premium=".$_SESSION['hash'];
                mysqli_query($connect, $query1);
                $query2 = "DELETE FROM abbonamenti_precedenti where premium=".$_SESSION['hash'];
                mysqli_query($connect, $query2);
                $query3 = "DELETE FROM premium where hash=".$_SESSION['hash'];
                mysqli_query($connect, $query3);
                echo "<div class='leave_message'><h2>Abbonamento cancellato!</h2>".
                     "<p>Il tuo abbonamento è stato cancellato 😪. Ti consideravo migliore di così😒😢<br>".
                     "<br><br>Beh, perlomeno puoi riabbonarti quando vuoi 😙🤭</p>".
                     "<a href='hw1.php'>Torna alla home🏡👈🏾</a></div>";
            } else{
                header("Location: hw1.php");
                exit;
            }
        }
    ?>
</body>
</html>