<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <link href="../resources/css/join_us.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unisciti a noi</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="img/icons/videotube.svg">
</head>
<body>
    @if($error==null || $error=='no_error')
      <header><a href='../public'><img src='../resources/img/icons/arrow-left.svg'></a></header>
    @else
      <header class='error {{$error}}'>
        <a href='../public'><img src='../resources/img/icons/arrow-left.svg'></a>
          <div><h1>Errore, Password non corretta</h1></div>
      </header>
    @endif
    <article>
        <section>
            <img src="../resources/img/others/coffee.jpg" class="left"/>
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
            <img src="../resources/img/others/cacao.jpg" class="rigth"/>
        </section>
        <section>
            <img src="../resources/img/others/baobab.jpg" class="left"/>
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
            <input name="_token" type="hidden" value="{{csrf_token()}}"/>
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
