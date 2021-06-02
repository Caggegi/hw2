<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="icon" href="../resources/img/icons/videotube.svg">
        <link href="../resources/css/signup.css" rel="stylesheet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VideoTube Log In</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="../resources/js/sign.js" defer></script>
    </head>
    <body>
        <main>
            <div class="left_image">
                <img src="../resources/img/GIF/signup.gif">
            </div>
            <div class="form_container">
            @if (isset($errore) && $errore!="")
            @switch($errore)
              @case("already_registered")
                  <div class='error'>
                  <h3>Già ti conosco!😏</h3>
                  <p>Utente già registrato effettua il login</p>
                  </div>
              @break
              @case("unknown_mode")
                  <div class='error'>
                  <h3>Qualcuno qui sta barando...</h3>
                  <p>Modalità di accesso sconosciuta contattare il supporto</p>
                  </div>
              @break
              @case("not_registered")
                  <div class='error'>
                  <h3>Scusa come hai detto che ti chiami? Ah, non lo hai ancora detto...</h3>
                  <p>Non sei ancora registrato!</p>
                  </div>
              @break
              @case("wrong_psw")
                  <div class='error'>
                  <h3>Oh no... l'hai scritta su qualche bigliettino? vero? VEROO??!?!?</h3>
                  <p>La password inserita non è corretta, riprova.</p>
                  </div>
              @break
              @default
                  <div class='error'>
                  <h3>Errore</h3>
                  <p>Si è verificato un errore sconosciuto, riprova più tardi</p>
                  </div>
              @endswitch
            @endif
                <div id="error" class="error hidden">
                </div>
                <div id="close_div">
                    <h1>Log In</h1>
                    <a href="/hw2/public">
                        <img id="close" src="../resources/img/icons/close.svg">
                    </a>
                </div>
                <form name="signup_form" method="post">
                    <input type='hidden' name='_token' value='{{$_token}}'></input>
                    <input type="hidden" name="mode" id="mode" value="spectator"></input>
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
                        <img id="change_mode" src="../resources/img/icons/chevron-down.svg"/>
                 </div>
                </form>
            </div>
        </main>
    </body>
</html>
