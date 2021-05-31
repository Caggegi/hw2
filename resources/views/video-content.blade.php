<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
        <link href="css/video_content.css" rel="stylesheet"/>
        <link rel="icon" href="img/icons/videotube.svg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            require_once("db_credentials.php");
            $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
            $query = "SELECT * from video where id=".mysqli_real_escape_string($connection,$_GET['id']);
            $res = mysqli_query($connection, $query);
            $row = mysqli_fetch_object($res);
            $creator = $row->creator;
            echo "<title>".$row->titolo."</title>";
        ?>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="js/video_content.js" defer></script>
    </head>
    <body>
        <main>
            <div id="video_frame">
            <?php
                echo "<iframe src='https://www.youtube.com/embed/".$_GET['src']."?autoplay=1&controls=0' frameborder='0'>";
                echo "</iframe>";
            ?>
            <div class="controls">
                <div id="page_controls">
                    <a href="hw1.php"><img id="home" src="https://raw.githubusercontent.com/Caggegi/mhw1/master/img/Light/home-outline.svg"></a>
                </div>
                <div id="interact">
                    <div id="feedback">
                        <?php
                            $cquery = "SELECT username, profile_pic FROM creator where hash=".$creator;
                            $cname = mysqli_query($connection, $cquery);
                            $name = mysqli_fetch_object($cname);
                            echo "<h3>".$name->username."</h3>";
                            echo "<img id='little_ppic' src='".$name->profile_pic."'/>";
                        ?>
                    </div>
                    <div id="sub_buttons">
                        <?php
                        session_start();
                        if(!isset($_SESSION['hash'])){
                            session_destroy();
                            echo "<a href='signup.php'><div class='subscribe'><p>iscriviti</p></div></a>";
                            echo "<a href='signup.php'><div class='support'><p>abbonati</p></div></a>";
                        } else{
                            $subscribed = "SELECT * FROM segue where spettatore=".$_SESSION['hash']." and creator=".$creator;
                            $SubResponse = mysqli_query($connection, $subscribed);
                            if(mysqli_fetch_object($SubResponse)){
                                echo "<div id='subscribe' class='subscribed' data-creator='".$creator."'><p>iscritto</p></div>";
                                $isPremium = "SELECT * FROM premium where hash=".$_SESSION['hash'];
                                $PremiumResponse = mysqli_query($connection, $isPremium);
                                if(mysqli_num_rows($PremiumResponse)>0){
                                    $isSupporter = "SELECT * FROM abbonamento where premium=".$_SESSION['hash'];
                                    $SuppResponse = mysqli_query($connection, $isSupporter);
                                    if(mysqli_num_rows($SuppResponse)>0){
                                        $SuppRow = mysqli_fetch_assoc($SuppResponse);
                                        $SCreator = $SuppRow['creator'];
                                        if($SCreator == $creator)
                                            echo "<div id='support' class='supporting' data-creator='".$creator."'><p>abbonato</p></div>";
                                        else
                                            echo "<div class='no-support' data-creator='".$creator."'><p>Abbonato altrove</p></div>";
                                    }
                                    else echo "<div id='support' class='support' data-creator='".$creator."'><p>abbonati</p></div>";
                                } else
                                    echo "<div class='no-support'><p>abbonati</p></div>";
                            } else{
                                echo "<div id='subscribe' class='subscribe' data-creator='".$creator."'><p>iscriviti</p></div>";
                                $isPremium = "SELECT * FROM premium where hash=".$_SESSION['hash'];
                                $PremiumResponse = mysqli_query($connection, $isPremium);
                                if(mysqli_num_rows($PremiumResponse)>0){
                                    $isSupporter = "SELECT * FROM abbonamento where premium=".$_SESSION['hash'];
                                    $SuppResponse = mysqli_query($connection, $isSupporter);
                                    if(mysqli_num_rows($SuppResponse)>0){
                                        $SuppRow = mysqli_fetch_assoc($SuppResponse);
                                        $SCreator = $SuppRow['creator'];
                                        if($SCreator == $creator)
                                        echo "<div id='support' class='supporting' data-creator='".$creator."'><p>abbonato</p></div>";
                                    else
                                        echo "<div class='no-support' data-creator='".$creator."'><p>Abbonato altrove</p></div>";
                                    }
                                    else echo "<div id='support' class='support' data-creator='".$creator."'><p>abbonati</p></div>";
                                } else
                                    echo "<div class='no-support'><p>abbonati</p></div>";
                            }

                        }
                        ?>
                    </div>
                </div>
            </div>
            </div>
            <div id="info">
                <?php
                    echo "<h1>".$row->titolo."</h1>";
                    echo "<section> ";
                    echo "<div class='description'>";
                    echo "<h3>Descrizione</h3> ";
                    echo "<p>".$row->pubblicazione."</p>";
                    echo "</div> ";
                    echo "<p>".$row->descrizione;
                    echo "</p> ";
                    echo "</section>";
                ?>
            </div>
        </main>
    </body>
</html>
<?php
    mysqli_close($connection);
?>
