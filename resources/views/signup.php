<?php
    require_once("db_credentials.php");

    session_start();
    function setUserSession(int $hash, string $nome, string $cognome, string $tipo, string $user,
        string $psw, string $mail, int $anno, string $pic){
            $_SESSION['hash'] = $hash;
            $_SESSION['nome'] = $nome;
            $_SESSION['cognome'] = $cognome;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['user'] = $user;
            $_SESSION['psw'] = $psw;
            $_SESSION['mail'] = $mail;
            $_SESSION['anno'] = $anno;
            $_SESSION['pic'] = $pic;
    }

    $errore = "";
    $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
    if(isset($_POST['mode']) && $_POST['mode']==1){
        //sign up
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])){
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $surname = mysqli_real_escape_string($connection, $_POST['surname']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            if($_POST['type']=='spectator'){
                //spectator
                $query = "SELECT * from spettatore where username = '".$username."'";
                $res = mysqli_query($connection, $query);
                if(mysqli_num_rows($res)>0){
                    $errore = "already_registered";
                } else{
                    $query = "INSERT INTO spettatore(name, surname, username, email, password, profile_pic, anno_iscrizione) VALUES ('"
                    .$name."','".$surname."','".$username."','".$email."','".hash('sha256', $password)."','https://raw.githubusercontent.com/Caggegi/mhw3/main/img/icons/account-circle-outline.svg','".date("Y")."');";
                    $res = mysqli_query($connection, $query);
                    $query = "SELECT * from spettatore where username='".$username."' && password='".hash('sha256',$password)."';";
                    $row = mysqli_fetch_object(mysqli_query($connection, $query));
                    setUserSession($row->hash, $_POST['name'],$_POST['surname'],$_POST['type'],$_POST['username'],$_POST['password'],
                        $_POST['email'],date('Y'), $row->profile_pic);
                    header("Location: hw1.php");
                    exit;
                }
            } else if($_POST['type']=='creator'){
                //creator
                $query = "SELECT * from creator where username = '".$username."'";
                $res = mysqli_query($connection, $query);
                if(mysqli_num_rows($res)>0){
                    $errore = "already_registered";
                } else{
                    $image = 'https://raw.githubusercontent.com/Caggegi/mhw3/main/img/icons/account-circle-outline.svg';
                    if($_POST['name']=='Dwayne' && $_POST['surname']=='Johnson')
                      $image = 'img/others/lapietra.jpg';
                    $query = "INSERT INTO creator(name, surname, username, email, password, profile_pic, anno_iscrizione, n_followers) ".
                    "VALUES ('".$name."','".$surname."','".$username."','".$email."','".hash('sha256', $password)."','".$image."','".date("Y")."','0');";
                    $res = mysqli_query($connection, $query);
                    $query = "SELECT * from creator where username='".$username."' && password='".hash('sha256',$password)."';";
                    $row = mysqli_fetch_object(mysqli_query($connection, $query));
                    setUserSession($row->hash, $_POST['name'],$_POST['surname'],$_POST['type'],$_POST['username'],$_POST['password'],
                        $_POST['email'],date('Y'), $row->profile_pic);
                    header("Location: upload.php");
                    exit;
                }
            }
        }
    } else if(isset($_POST['mode']) && $_POST['mode']==0){
        //log in
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])){
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            if($_POST['type'] == 'spectator'){
                //spectator
                $query = "SELECT * from spettatore where username = '".$username."'";
                $res = mysqli_query($connection, $query);
                if(mysqli_num_rows($res) == 0){
                    $errore = "not_registered";
                } else{
                    $ok=1;
                    while($row = mysqli_fetch_object($res)){
                        if($row->password == hash("sha256",$password)){
                            $ok=0;
                        setUserSession($row->hash, $row->name,$row->surname, $_POST['type'],$_POST['username'],$_POST['password'],
                            $row->email,$row->anno_iscrizione, $row->profile_pic);
                    }}
                    if($ok){
                        $errore = "wrong_psw";
                    } else{
                        header("Location: hw1.php");
                        exit;
                    }
                }
            } else if($_POST['type'] == 'creator'){
                //creator
                $query = "SELECT * from creator where username = '".$username."'";
                $res = mysqli_query($connection, $query);
                if(mysqli_num_rows($res) == 0){
                    $errore = "not_registered";
                } else{
                    $ok=1;
                    while($row = mysqli_fetch_object($res)){
                        if($row->password == hash("sha256",$password)){
                            $ok=0;
                            setUserSession($row->hash, $row->name,$row->surname, $_POST['type'],$_POST['username'],
                                $_POST['password'], $row->email,$row->anno_iscrizione,$row->profile_pic);
                    }}
                    if($ok){
                        $errore = "wrong_psw";
                    } else{
                        header("Location: upload.php");
                        exit;
                    }
                }
            }
        }
    }
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="icon" href="img/icons/videotube.svg">
        <link href="css/signup.css" rel="stylesheet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VideoTube Log In</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="js/sign.js" defer></script>
    </head>
    <body>
        <main>
            <div class="left_image">
                <img src="img/GIF/signup.gif">
            </div>
            <div class="form_container">
            <?php
                        if(isset($errore) && $errore!=""){
                            switch ($errore){
                                case "already_registered":
                                    echo "<div class='error'>";
                                    echo "<h3>Già ti conosco!😏</h3>";
                                    echo "<p>Utente già registrato effettua il login</p>";
                                    echo "</div>";
                                    break;
                                case "unknown_mode":
                                    echo "<div class='error'>";
                                    echo "<h3>Qualcuno qui sta barando...</h3>";
                                    echo "<p>Modalità di accesso sconosciuta contattare il supporto</p>";
                                    echo "</div>";
                                    break;
                                case "not_registered":
                                    echo "<div class='error'>";
                                    echo "<h3>Scusa come hai detto che ti chiami? Ah, non lo hai ancora detto...</h3>";
                                    echo "<p>Non sei ancora registrato!</p>";
                                    echo "</div>";
                                    break;
                                case "wrong_psw":
                                    echo "<div class='error'>";
                                    echo "<h3>Oh no... l'hai scritta su qualche bigliettino? vero? VEROO??!?!?</h3>";
                                    echo "<p>La password inserita non è corretta, riprova.</p>";
                                    echo "</div>";
                                    break;
                                default:
                                    echo "<div class='error'>";
                                    echo "<h3>Errore</h3>";
                                    echo "<p>Si è verificato un errore sconosciuto, riprova più tardi</p>";
                                    echo "</div>";
                                    break;
                            }
                        }
                    ?>
                <div id="error" class="error hidden">
                </div>
                <div id="close_div">
                    <h1>Log In</h1>
                    <a href="hw1.php">
                        <img id="close" src="img/icons/close.svg">
                    </a>
                </div>
                <form name="signup_form" method="post">
                    <input type="hidden" name="mode" id="mode"></input>
                    <div id="name_surname" class="hidden">
                        <input id="name" name="name" type="text" placeholder="Name"></input>
                        <input id="surname" name="surname" type="text" placeholder="Surname"></input>
                    </div>
                    <div id="other">
                        <input id="username" name="username" type="text" placeholder="Username"></input>
                        <input id="email" name="email" type="hidden" placeholder="Email"></input>
                        <input id="password" name="password" type="password" autocomplete placeholder="Password">
                        </input>
                        <input id="confirm" name="confirm" type="hidden" autocomplete placeholder="Confirm password">
                        </input>
                        <div id="radio_buttons">
                            <input type="radio" value="spectator" checked="true" name="type" id="inp_spectator"></input><label>Spectator</label>
                            <input type="radio" value="creator" name="type" id="inp_creator"></input><label>Creator</label>
                        </div>
                        <div class="btns">
                        <input type="submit" id="signup" value="Log In"></input>
                        <img id="change_mode" src="img/icons/chevron-down.svg"/>
                 </div>
                </form>
            </div>
        </main>
    </body>
</html>
