<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
        <link href="http://localhost/hw2/resources/css/video_content.css" rel="stylesheet"/>
        <link rel="icon" href="../resources/img/icons/videotube.svg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$titolo}}</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="http://localhost/hw2/resources/js/video_content.js" defer></script>
    </head>
    <body>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <main>
            <div id="video_frame">
            <iframe src='https://www.youtube.com/embed/{{$videosrc}}?autoplay=1&controls=0' frameborder='0'></iframe>
            <div class="controls">
                <div id="page_controls">
                    <a href="../../"><img id="home" src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/home-outline.svg"></a>
                </div>
                <div id="interact">
                    <div id="feedback">
                        <h3>{{$creator}}</h3>
                        <img id='little_ppic' src='{{$creator_pic}}'/>
                    </div>
                    <div id="sub_buttons">
                        @if(Session::get('id') == null)
                          <div id='common' class='subscribe no-session'><p>iscriviti</p></div></a>
                          <div id='premium' class='support no-session'><p>abbonati</p></div></a>
                        @else
                          @if($is_subscribed == 'true')
                            <div id='common' class='subscribed' data-creator='{{$creator_id}}'><p>iscritto</p></div></a>
                          @else
                            <div id='common' class='subscribe' data-creator='{{$creator_id}}'><p>iscriviti</p></div></a>
                          @endif
                          @if($is_premium == 'true')
                            @if($support == $creator_id)
                              <div id='premium' class='supporting' data-creator='{{$creator_id}}'><p>abbonato</p></div></a>
                            @else
                              @if($support == null)
                                <div id='premium' class='support' data-creator='{{$creator_id}}'><p>abbonati</p></div></a>
                              @else
                                <div id='premium' class='no-support'><p>abbonato altrove</p></div></a>
                              @endif
                            @endif
                          @else
                            <div id='premium' class='no-premium'><p>abbonati</p></div></a>
                          @endif
                        @endif
                    </div>
                </div>
            </div>
            </div>
            <div id="info">
              <h1>{{$titolo}}</h1>
              <section>
                <div class='description'>
                  <h3>Descrizione</h3>
                  <p>{{$pubblicazione}}</p>
                </div>
                <p>{{$descrizione}}</p>
                </section>
            </div-->
        </main>
    </body>
</html>
