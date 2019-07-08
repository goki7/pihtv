<?php

if (!isset($_SESSION['username'])) {
    header("location: /admin/autenticazione/login.php");
    die();
}
