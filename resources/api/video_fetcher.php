<?php
    require_once("../db_credentials.php");
    if(isset($_GET['modalita'])){
        $contents = array();
        $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
        if($_GET['modalita'] == "preferiti"){
            session_start();
            if(isset($_SESSION['hash'])){
                $query = "SELECT v.titolo, v.immagine, v.descrizione, v.src, v.id, v.tipo, c.username FROM video v JOIN creator c ON v.creator=c.hash join preferiti p on v.id=p.video where spettatore=".mysqli_real_escape_string($connection,$_SESSION['hash']);
                $res = mysqli_query($connection, $query);
                while($row=mysqli_fetch_assoc($res)){
                    $contents[] = array('titolo'=>$row['titolo'], 'immagine'=>$row['immagine'], 'src'=>$row['src'],
                        'id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'tipo'=>$row['tipo'],'creator'=>$row['username']);
                }
            }
        } else if($_GET['modalita'] == "recenti"){
            $query = "SELECT v.titolo, v.immagine, v.descrizione, v.src, v.id, v.tipo, c.username, v.pubblicazione FROM video v ".
                        "JOIN creator c ON v.creator=c.hash order by pubblicazione desc limit 6;";
            $res = mysqli_query($connection, $query);
            while($row=mysqli_fetch_assoc($res)){
                $contents[] = array('titolo'=>$row['titolo'], 'immagine'=>$row['immagine'], 'src'=>$row['src'],
                    'id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'tipo'=>$row['tipo'],'creator'=>$row['username']);
            }
        } else if($_GET['modalita'] == "virali"){
            $query = "SELECT h.titolo, h.immagine, h.descrizione, h.src, h.id, h.tipo, c.username, h.likes ".
            "from hot_topic h join creator c on h.creator=c.hash order by h.likes desc limit 6";
            $res = mysqli_query($connection, $query);
            while($row=mysqli_fetch_assoc($res)){
            $contents[] = array('titolo'=>$row['titolo'], 'immagine'=>$row['immagine'], 'src'=>$row['src'],
                'id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'tipo'=>$row['tipo'],'creator'=>$row['username']);
            }
        } else if($_GET['modalita'] == "ricerca" && isset($_GET['value'])){
            $query = "SELECT v.titolo, v.immagine, v.descrizione, v.src, v.id, v.tipo, c.username FROM video v ".
                "JOIN creator c ON v.creator=c.hash where v.titolo like '%".mysqli_real_escape_string($connection, $_GET['value'])."%';";
            $res = mysqli_query($connection, $query);
            while($row=mysqli_fetch_assoc($res)){
                $contents[] = array('titolo'=>$row['titolo'], 'immagine'=>$row['immagine'], 'src'=>$row['src'],
                    'id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'tipo'=>$row['tipo'],'creator'=>$row['username']);
            }
        } else{
            if(isset($_GET['creator']))
                $query = "SELECT v.titolo, v.immagine, v.descrizione, v.id, v.tipo, c.username FROM video v ".
                    "JOIN creator c ON v.creator=c.hash WHERE creator='".mysqli_real_escape_string($connection,$_GET['creator'])."';";
            else
                $query = "SELECT v.titolo, v.immagine, v.descrizione, v.src, v.id, v.tipo, c.username FROM video v ".
                    "JOIN creator c ON v.creator=c.hash;";
            $res = mysqli_query($connection, $query);
            while($row=mysqli_fetch_assoc($res)){
                $contents[] = array('titolo'=>$row['titolo'], 'immagine'=>$row['immagine'], 'src'=>$row['src'],
                    'id'=>$row['id'], 'descrizione'=>$row['descrizione'], 'tipo'=>$row['tipo'],'creator'=>$row['username']);
            }
        }
        echo json_encode($contents);
    }

?>
