<?php
    session_start();
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
    }
?>