<?php
    session_start();
    unset($_SESSION['id_user']);
    header("location: systemlogin.cf/index.php");
?>