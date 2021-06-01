<?php
    require_once("../db_credentials.php");
    session_start();
    $json_=array("risposta"=>"errore");
    $titolo = "";
    $copertina = "";
    $descrizione = "";
    if(isset($_SESSION['hash']) && isset($_POST['titolo']) && isset($_POST['copertina']) 
        && isset($_POST['descrizione']) && isset($_POST['src'])){
        if(strpos($_POST['src'],"youtube") != ""){
            $id="";
            $url = $_POST['src'];
            $titolo = $_POST['titolo'];
            $copertina = $_POST['copertina'];
            $descrizione = $_POST['descrizione'];
            $tipo = $_POST['tipo'];
            $creator = $_SESSION['hash'];
            $start_id = strpos($url,"v=");
            if($start_id == "") $json_["risposta"]='url_esterno';
            else{
                $start_id = $start_id + 2;
                $end_id = strpos($url,"&");
                if($end_id == "") $end_id = 11;
                else $end_id = $end_id-$start_id;
                for($i=0; $i<$end_id; $i++)
                    $id.=$url[$start_id+$i];
                $connection = mysqli_connect($mydb_connect['server'], $mydb_connect['user'], $mydb_connect['psw'], $mydb_connect['db']) or die(mysqli_connect_error);
                $query = "INSERT INTO video(titolo, immagine, creator, descrizione, tipo, src, pubblicazione)".
                "VALUES ('".$titolo."','"
                .mysqli_real_escape_string($connection,$copertina)."','"
                .mysqli_real_escape_string($connection,$creator)."','"
                .mysqli_real_escape_string($connection,$descrizione)."','"
                .mysqli_real_escape_string($connection,$tipo)."','"
                .mysqli_real_escape_string($connection,$id)."','".
                date('Y-m-d')."');";
                $res = mysqli_query($connection, $query);
                mysqli_close($connection);
                $json_["risposta"]='video_caricato';
                $json_["titolo"]=$titolo;
                $json_["copertina"]=$copertina;
                $json_["descrizione"]=$descrizione;
            } 
        } else $json_["risposta"]='url_esterno';
        echo json_encode($json_);
    } else{
        $json_["risposta"]='errore';
        echo json_encode($json_);
    }
    exit;
?>