<?php
require_once "../../assets/config/config.php";

$username = mysqli_real_escape_string($db, $_POST['username'] ?? '');
$password = hash("sha256", mysqli_real_escape_string($db, $_POST['password'] ?? ''));

$sql = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
$rs = mysqli_query($db, $sql);
$count = mysqli_num_rows($rs);

if ($count == 1) {
    mysqli_query($db, "UPDATE utenti SET ultimo_accesso=CURRENT_TIMESTAMP() WHERE username='$username'");
    $ultimo_accesso = mysqli_query($db, "SELECT ultimo_accesso FROM utenti WHERE username='$username'");
    $_SESSION['username'] = $username;
    $_SESSION['ultimo_accesso'] = $ultimo_accesso;
    unset($_SESSION['login_error']);
    header("location: ../dashboard.php");
} else {
    $_SESSION['login_error'] = "username or password incorrect";
    header("location: login.php");
    die();
}
