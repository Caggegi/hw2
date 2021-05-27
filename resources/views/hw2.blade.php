<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link href="css/hw1.css" rel="stylesheet"/>
        <link href="css/user_btn.css" rel="stylesheet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VideoTube o46002042</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
        <script src="js/contents.js " defer></script>
        <script src="js/script.js" defer></script>
        <script src="js/sub_loader.js" defer></script>
        <link rel="icon" href="img/icons/videotube.svg">
    </head>
    <body>
        <div class="menu_priority hide"></div>
        <div class="icon_menu hide">
            <div class="m_header">
                <div class="window_buttons">
                    <div class="close_button"></div>
                    <div class="save_button"></div>
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
                        <?php
                          @if (Session::get("hash", "default") === "default")
                            //reindirizza al login
                          @else
                            //reindirizza al logout
                            @if ($premium === "settimanale")
                              //disdice il settimanale e stampa tasto con il caffè
                            @elseif ($premium === "mensile")
                              //disdice il mensile e stampa tasto con la cioccolata
                            @elseif ($premium === "annuale")
                              //disdice l'annuale e stampa tasto con l'avocado
                            @else
                              //reindirizza alla creazione dell'abbonamento
                            @endif
                          @endif
                        ?>
                    </div>
                </div>
                <h2 class="desktop">Seleziona</h2>
                <div class="pick desktop">

                </div>
            </div>
        </div>
        <header>
            <div id="background"></div>
            <div id="overlay"></div>
            <div id="search">
                <input type="text" placeholder="Cerca" id="search">
                </input>
                <div>
                    <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/magnify.svg"/>
                    <img id="mobile_pic" class="mobile" src="{{$profile_pic}}"/> <!--stampo la foto profilo-->
                </div>
            </div>
            <div id="info">
                <div id="account">
                  <div> <!--stampo il profilo-->
                    <h3>{{$nome}} {{$cognome}}</h3>
                    <p>{{$email}}</p>
                  </div>
                  <img src="{{$profile_pic}}"/>
                </div>
            </div>
        </header>
        <div id="main">
            <nav>
                    <div class="nav_button" id="home">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Dark/home-outline.svg" class="desktop">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/home-outline.svg" class="mobile">
                        <h4>Home</h4>
                    </div>
                    <div class="nav_button" id="recenti">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Dark/clock-time-four-outline.svg" class="desktop">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/clock-time-four-outline.svg" class="mobile">
                        <h4>Recenti</h4>
                    </div>
                    <div class="nav_button" id="tendenze">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Dark/trending-up.svg" class="desktop">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/trending-up.svg" class="mobile">
                        <h4>Tendenze</h4>
                    </div>
                    <div class="nav_button" id="preferiti">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Dark/heart-outline.svg" class="desktop">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/heart-outline.svg" class="mobile">
                        <h4>Preferiti</h4>
                    </div>
                    <div class="nav_button" id="titolo_iscrizioni">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Dark/account-multiple-check-outline.svg" class="desktop">
                        <img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/account-multiple-check-outline.svg" class="mobile">
                        <h4>Iscrizioni</h4>
                    </div>
                <div>
                    <div id="sub_container">
                    </div>
                </div>
            </nav>
            <article id="video-frame">
                <section class="genre hide" id="ricerca">
                    <h2>Ricerca</h2>
                    <div class="show-case"></div>
                </section>
                <section class="genre hide" id="preferiti">
                    <h2>Preferiti</h2>
                    <div class="show-case"></div>
                </section>
                <section class='genre' id='film'>
                    <h2>Film</h2>
                    <div class='show-case'></div>
                </section>
                <section class='genre' id='musica'>
                    <h2>Musica</h2>
                    <div class='show-case'></div>
                </section>
                <section class='genre' id='gameplay'>
                    <h2>Gameplay</h2>
                    <div class='show-case'></div>
                </section>
                <section class='genre' id='altro'>
                    <h2>Altro</h2>
                    <div class='show-case'></div>
                </section>
            </article>
        </div>
        <footer>
            <div id="social">
                <a href="https://www.facebook.com/rosario.caggegi.142" target="about:blank"><img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/facebook.svg"></a>
                <a href="https://www.instagram.com/rosario.caggegi/" target="about:blank"><img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/instagram.svg"></a>
                <a href="https://github.com/Caggegi/hw1" target="about:blank"><img src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/github.svg"></a>
            </div>
            <div>
                <p>Questo sito web è stato adattato al framework Laravel da Rosario Caggegi o46002042</p>
            </div>
        </footer>
    </body>
</html>
