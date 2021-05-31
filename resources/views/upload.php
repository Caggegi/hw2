<?php
    require_once("db_credentials.php");
    session_start();
    if(!isset($_SESSION['tipo']) || $_SESSION['tipo']=='spectator'){
        session_destroy();
        header("Location: signup.php");
        exit;
    } else{
        if($_SESSION['tipo']=='creator'){
            echo "<input type='hidden' value='".$_SESSION['nome']." ".$_SESSION['cognome']."' id='name_surname'></input>";
            echo "<input type='hidden' value='".$_SESSION['pic']."' id='pic'></input>";
            echo "<input type='hidden' value='".$_SESSION['mail']."' id='email'></input>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
        <link rel="icon" href="img/icons/videotube.svg">
        <link href="css/upload.css" rel="stylesheet"/>
        <link href="css/user_btn.css" rel="stylesheet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VideoTube Upload</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="js/upload.js" defer></script>
    </head>
    <body>
        <div class="menu_priority hidden"></div>
        <div class="upload hidden">
            <div id="popup_topbar">
                <div id="buttons">
                    <div class="close_button" id="closeUploadMenu"></div>
                    <div class="upload_button"></div>
                </div>
            </div>
            <form name="upload_form" method="post">
                <div id="upload_form">
                    <div class="text_input">
                        <h2>Compila i seguenti campi</h2>
                        <input type='text' placeholder='Titolo' name='titolo'></input>
                        <input type='text' placeholder='Immagine Copertina' name='copertina'></input>
                        <input type='text' placeholder='Descrizione' name='descrizione'></input>
                        <input type='text' placeholder='sorgente video' name='src'></input>
                    </div>
                    <div class="other">
                        <h4>Scegli il tipo del tuo contenuto:</h4>
                        <div class="radio_container">
                            <div><input type="radio" value="film" name="type"></input><label>Film</label></div>
                            <div><input type="radio" value="musica" name="type"></input><label>Musica</label></div>
                            <div><input type="radio" value="gameplay" name="type"></input><label>Gameplay</label></div>
                            <div><input type="radio" value="other" checked="true" name="type"></input><label>Altro</label></div>
                        </div>
                    </div>
                </div>    
            </form>
            <p id="errore_upload" class="hidden">Si è verificato un errore, controlla i dati immessi</p>
        </div>
        <div class="icon_menu hidden">
            <div class="m_header">
                <div class="window_buttons">
                    <div class="close_button" id="closePicMenu"></div>
                    <div class="save_button" id="savePicMenu"></div>
                </div>
                <div class="form_container">
                    <form id="choose_category">
                        <input type="text" placeholder="Categoria" id="category">
                        <input type="submit" id="send" value="Cerca">
                    </form>
                </div>
            </div>
            <div class="m_body">
                <div class="current">
                    <img id="current_picture">
                    <div>
                        <input type='text' placeholder='Name' id='current_name'></input>
                        <input type='text' placeholder='Email' id='current_description'></input>
                    </div>
                </div>
                <h2 class="desktop">Seleziona</h2>
                <div class="pick desktop">
                    
                </div>
            </div>
        </div>
        <header class="header">
            <div class="relative">
                <div>
                    <a href="php/logout.php"><img src="img/icons/arrow-left.svg"/></a>
                    <?php
                        echo "<img id='profile' src='".$_SESSION['pic']."'/>";
                    ?>
                    <h2>VideoTube Upload</h2>
                </div>
                <div>
                    <img id="plus_button" src="img/icons/plus.svg"/>
                </div>
            </div>
        </header>
        <main>
            <h2 class="mobile riepilogo">Riepilogo contenuti:</h2>
            <?php
                $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
                $query = "SELECT titolo, immagine, descrizione FROM video where creator =".$_SESSION['hash'].";";
                $res = mysqli_query($connection, $query);
                while($row = mysqli_fetch_object($res)){
                    echo "<div class='row'> <img src='".$row->immagine."'>";
                    echo "<div><h2>".$row->titolo."</h2>";
                    echo "<p>".$row->descrizione."</p></div></div>";
                }
            ?>
        </main>
    </body>
</html>