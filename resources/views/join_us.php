<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <link href="css/join_us.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unisciti a noi</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="img/icons/videotube.svg">
</head>
<body>
        <?php
        require_once("db_credentials.php");
        session_start();
        if(isset($_POST['tipo_abbonamento']) && isset($_SESSION['hash']) && isset($_POST['pass'])){
            $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
            $pass = mysqli_real_escape_string($connection, $_POST['pass']);
            $query = "select * from spettatore where hash=".$_SESSION['hash']." and password='".hash('sha256', $pass)."';";
            if(mysqli_num_rows(mysqli_query($connection, $query))==1){
                if($_POST['tipo_abbonamento'] == "settimanale"){
                    $prezzo = 2.99;
                    $mensile = $prezzo*4;
                }
                else if($_POST['tipo_abbonamento'] == "annuale"){
                    $prezzo = 96;
                    $mensile = $prezzo/12;
                }
                else {
                    $prezzo=8.99;
                    $mensile=$prezzo;
                }
                $tipo = mysqli_real_escape_string($connection, $_POST['tipo_abbonamento']);
                $query = "INSERT INTO PREMIUM value (".$_SESSION['hash'].",".$prezzo.",".$mensile.",'".$tipo."')";
                mysqli_query($connection, $query);
                $query = "select tipo from premium where hash=".$_SESSION['hash'];
                $res = mysqli_query($connection, $query);
                $row = mysqli_fetch_object($res);
                if(mysqli_num_rows($res)>0){
                    $abb = $row->tipo;
                    if($abb=="settimanale")
                        echo "<header class='settimanale'><a href='hw1.php'><img src='img/icons/arrow-left.svg'></a></header>";
                    else if($abb=="mensile")
                        echo "<header class='mensile'><a href='hw1.php'><img src='img/icons/arrow-left.svg'></a></header>";
                    else if($abb=="annuale")
                        echo "<header class='annuale'><a href='hw1.php'><img src='img/icons/arrow-left.svg'></a></header>";
                    header("Location: hw1.php");
                    exit;
                } else echo "<header><a href='hw1.php'><img src='img/icons/arrow-left.svg'></a></header>";
            }
            else echo "<header><a href='hw1.php'><img src='img/icons/arrow-left.svg'></a></header>";
            mysqli_close($connection);
        } else{
            echo "<header><a href='hw1.php'><img src='img/icons/arrow-left.svg'></a></header>";
        }
        ?>
    <article>
        <section>
            <img src="img/others/coffee.jpg" class="left"/>
            <div class="rigth">
                <h2>Buongiornissimo, KAFFE??1!?!1?☕☕</h2>
                <h4>L'abbonamento settimanale permette di supportare un creator pagando, al prezzo di un caffè, i contenuti
                    per i soli abbonati che egli pubblica.🥇<br>
                    Scegli bene a chi abbonarti, il tempo stringe! ⏲<br><br>
                    NB: Questo tipo di abbonamento non contempla collaborazioni con treedom.
                </h4>
            </div>
        </section>
        <section class="left">
            <div class="left">
                <h2>Per fare un albero...🌳🌲</h2>
                <h4>Sapevi che il cacao in realtà è amaro? Beh senza di esso comunque non potremmo avere un
                    prodotto così dolce come il cioccolato (😋🍫). Grazie all'abbonamento mensile puoi piantare un
                    albero di cacao grazie a Treedom ogni due mesi di abbonamento! L'intera natura ti ringrazia e ti
                    ringrazia anche il creator a cui deciderai di abbonarti, ricordati il tuo supporto è fondamentale
                    per garantire una buona qualità del servizio.🤩
                </h4>
            </div>
            <img src="img/others/cacao.jpg" class="rigth"/>
        </section>
        <section>
            <img src="img/others/baobab.jpg" class="left"/>
            <div class="rigth">
                <h2>Cosa dice un 🥑Avocado ad un 🌳Baobab?</h2>
                <h4>Onestamente non lo so nemmeno io, sicuramente però tra i loro discorsi non mancherà un elogio
                    alla persona meravigliosa che sei!🌟<br>Se scegli questo abbonamento non solo potrai usufruire
                    del servizio premium ad un prezzo scontato, ma aiuterai l'ambiente piantando non uno ma ben due alberi:
                    un Baobab e un albero di Avocado,🥑EVVIVA🥑!!<br><br>
                    Fossi in te ne approfitterei. 😉
                </h4>
            </div>
        </section>
    </article>
    <div id="div_abbonamento">
        <h3>🤗Scegli il tuo abbonamento: </h3>
        <form method="post">
            <label><input type="radio" name="tipo_abbonamento" value="settimanale"></input>⏳Settimanale 2.99€</label>
            <label><input type="radio" name="tipo_abbonamento" value="mensile" checked="true"></input>⌚Mensile 8.99€</label>
            <label><input type="radio" name="tipo_abbonamento" value="annuale"></input>📅Annuale 96.00€</label>
            <div>
                <input name="pass" type="password" placeholder="Conferma Password" autocomplete></input>
                <input type="submit" value=""></input>
            </div>
        </form>
    </div>
</body>
</html>