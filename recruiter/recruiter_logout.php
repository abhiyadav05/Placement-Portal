<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: recruiter_login.php");
?>