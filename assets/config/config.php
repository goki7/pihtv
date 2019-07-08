<?php
date_default_timezone_set("Europe/Rome");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = mysqli_connect('localhost', 'id8991969_root', 'rootroot', 'id8991969_pihtv');

if (!$db) {
    echo mysqli_connect_error();
    die;
}
