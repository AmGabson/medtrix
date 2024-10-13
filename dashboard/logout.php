<?php

session_start();

$_SESSION = array($_SESSION["user_os"], $_SESSION["user_login"]);

session_destroy();

header("location:index.php");
