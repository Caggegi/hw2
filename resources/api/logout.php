<?php
    session_start();
    session_destroy();
    header("Location: ../hw1.php");
    exit;
?>